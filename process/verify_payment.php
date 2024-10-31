<?php

function pwb3d_verify_payment(){
    if (trim($_POST['code']) == '') {
        $response['error'] = true;
        $response['error_message'] = "Did you make a payment?";

        exit(json_encode($response));
    }
    global $wpdb;
    $table = $wpdb->prefix . PWB3D_DB_TABLE;
    $code = sanitize_key($_POST['code']);
    $record = $wpdb->get_results("SELECT * FROM $table WHERE (txn_code = '" . $code . "')");
    if (array_key_exists("0", $record)) {
        $payment_array = $record[0];
        //print_r($payment_array);
        $amount = get_post_meta($payment_array->pwb3d_id, 'pwb3d_amount', true);
        $currency = get_post_meta($payment_array->pwb3d_id, 'pwb3d_currency', true);
        $redirect = get_post_meta($payment_array->pwb3d_id, 'pwb3d_redirect', true);
        //print_r($amount);

        $mode =  esc_attr(get_option('pwb3d_mode'));
        if ($mode == 'test') {
            $MerchantKey = esc_attr(get_option('pwb3d_mtk'));
            $url = 'https://staging.paywithbank3d.com/api/payment/verify/';
            $MerchantSecretId = esc_attr(get_option('pwb3d_mtsi'));
        } else {
            $key = esc_attr(get_option('pwb3d_mlk'));
            $url = 'https://paywithbank3d.com/api/payment/verify/';
            $MerchantSecretId = esc_attr(get_option('pwb3d_mlsi'));
        }
        $pwb3d_url = $url . $code;
        $headers = array(
            'Authorization' => 'Basic ' . base64_encode( $MerchantKey . ':' . $MerchantSecretId )
        );
        $args = array(
            'headers'    => $headers,
            'timeout'    => 60
        );
        $request = wp_remote_get($pwb3d_url, $args);
        if (!is_wp_error($request) && 200 == wp_remote_retrieve_response_code($request)) {
            $paywithbank3d_response = json_decode(wp_remote_retrieve_body($request));
            if ('00' === $paywithbank3d_response->code) {
                $merchantRef = $paywithbank3d_response->merchantRef;
                $amount_paid    = $paywithbank3d_response->amount / 100;
                $paymentRef     = $paywithbank3d_response->paymentRef;
                $option     = $paywithbank3d_response->option;

                if ($amount == 0){
                    $wpdb->update($table, array('paid' => 1, 'amount' => $amount_paid), array('txn_code' => $merchantRef));
                    $message = get_post_meta($payment_array->pwb3d_id, 'pwb3d_successmsg', true);
                    $result = "success";
                }else {
                    if ($amount !=  $amount_paid) {
                        $message = "Invalid amount Paid. Amount required is " . $currency . "<b>" . number_format($amount) . "</b>";
                        $result = "failed";
                    }else {
                        $wpdb->update($table, array('paid' => 1), array('txn_code' => $merchantRef));
                        $message = get_post_meta($payment_array->pwb3d_id, 'pwb3d_successmsg', true);
                        $result = "success";
                    }
                }

                if ($result == 'success') {
                    $sendReceipt = get_post_meta($payment_array->pwb3d_id, 'pwb3d_sendreceipt', true);
                    if($sendReceipt == 'yes') {
                        $decoded = json_decode($payment_array->metadata);
                        $fullName = $decoded[1]->value;
                        wp_schedule_single_event( time() + 60, 'b3d_send_receipts', array( $payment_array->pwb3d_id, $currency, $amount_paid, $fullName, $payment_array->email, $paymentRef, $payment_array->metadata, $merchantRef ) );
//                        pwb3d_send_receipts($payment_array->pwb3d_id, $currency, $amount_paid, $fullName, $payment_array->email, $paymentRef, $payment_array->metadata);
                        wp_schedule_single_event( time() + 70, 'b3d_send_receipts_owner', array( $payment_array->pwb3d_id, $currency, $amount_paid, $fullName, $payment_array->email, $paymentRef, $payment_array->metadata ) );
//                        pwb3d_send_receipts_owner($payment_array->pwb3d_id, $currency, $amount_paid, $fullName, $payment_array->email, $paymentRef, $payment_array->metadata);
                    }
                }
            //print_r($paywithbank3d_response);

            } else{
                $message = "Payment Verification Failed.";
                $result = "failed";
            }
        } else {
            $message = "Payment Verification Failed.";
            $result = "failed";
        }





    } else {
        $message = "Payment Verification Failed.";
        $result = "failed";
    }

    $response = array(
        'result' => $result,
        'message' => $message,
    );
    if ($result == 'success' && $redirect != '') {
        $response['result'] = 'success2';
        $response['link'] = $redirect;
    }


    echo json_encode($response);

    die();
}

