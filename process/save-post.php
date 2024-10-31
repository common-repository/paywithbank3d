<?php


function pwb3d_save_post_admin($post_id, $post){


    if (!wp_verify_nonce(@$_POST['eventmeta_noncename'], plugin_basename(PWB3D_PLUGIN_URL))) {

        return $post->ID;
    }
    //pwb3d_write_log(!current_user_can('edit_post', $post->ID));
    // Is the user allowed to edit the post or page?
    if (!current_user_can('edit_post', $post->ID)) {

        return $post->ID;
    }

    //$pwb3d_data            =   get_post_meta( $post_id, 'pwb3d_data', true );
    //$pwb3d_data            =   empty($pwb3d_data) ? [] : $pwb3d_data;

    $pwb3d_data['pwb3d_amount'] = sanitize_text_field($_POST['pwb3d_amount']);
    $pwb3d_data['pwb3d_hidetitle'] = sanitize_text_field($_POST['pwb3d_hidetitle']);
    $pwb3d_data['pwb3d_minimum'] = sanitize_text_field($_POST['pwb3d_minimum']);

    $pwb3d_data['pwb3d_paybtn'] = sanitize_text_field($_POST['pwb3d_paybtn']);
    $pwb3d_data['pwb3d_currency'] = sanitize_text_field($_POST['pwb3d_currency']);
    $pwb3d_data['pwb3d_successmsg'] = sanitize_text_field($_POST['pwb3d_successmsg']);
    $pwb3d_data['pwb3d_loggedin'] = sanitize_text_field($_POST['pwb3d_loggedin']);
    $pwb3d_data['pwb3d_redirect'] = sanitize_text_field($_POST['pwb3d_redirect']);

    $pwb3d_data['pwb3d_subject'] = sanitize_text_field($_POST['pwb3d_subject']);
    $pwb3d_data['pwb3d_merchant'] = sanitize_text_field($_POST['pwb3d_merchant']);
    $pwb3d_data['pwb3d_heading'] = sanitize_text_field($_POST['pwb3d_heading']);
    $pwb3d_data['pwb3d_message'] = sanitize_text_field($_POST['pwb3d_message']);
    $pwb3d_data['pwb3d_sendreceipt'] = sanitize_text_field($_POST['pwb3d_sendreceipt']);
    $pwb3d_data['pwb3d_sendinvoice'] = sanitize_text_field($_POST['pwb3d_sendinvoice']);

    $pwb3d_data['pwb3d_useagreement'] = sanitize_text_field($_POST['pwb3d_useagreement']);
    $pwb3d_data['pwb3d_agreementlink'] = sanitize_text_field($_POST['pwb3d_agreementlink']);
    $pwb3d_data['pwb3d_color'] = sanitize_text_field($_POST['pwb3d_color']);



    //$pwb3d_data['rating'] = isset($pwb3d_data['rating']) ? absint($pwb3d_data['rating']) : 0;
    //$pwb3d_data['rating_count'] = isset($pwb3d_data['rating_count']) ? absint($pwb3d_data['rating_count']) : 0;

    foreach ($pwb3d_data as $key => $value) { // Cycle through the $form_meta array!
        //pwb3d_write_log($pwb3d_data);
        if ($post->post_type == 'revision') {
            return; // Don't store custom data twice
        }
        $value = implode(',', (array) $value); // If $value is an array, make it a CSV (unlikely)
        if (get_post_meta($post->ID, $key, false)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key); // Delete if blank
        }
    }

        //update_post_meta($post_id, 'pwb3d_data', $pwb3d_data);
}


function pwb3d_submit_action(){
    if (trim(sanitize_email($_POST['pwb3d-email'])) == '') {
        $response['result'] = 'failed';
        $response['message'] = 'Email is required';

        // Exit here, for not processing further because of the error
        exit(json_encode($response));
    }

    // Hookable location. Allows other plugins use a fresh submission before it is saved to the database.
    // Such a plugin only needs do
    // add_action( 'pwb3d_before_save', 'your function to save' );
    // somewhere in their code;
    do_action('pwb3d_before_save');
    //include('emails/invoice.php');
    global $wpdb;
    $code = pwb3d_generate_code();
    $table = $wpdb->prefix . PWB3D_DB_TABLE;
    $metadata = array_map( 'sanitize_text_field', wp_unslash( $_POST) );
    $fullname = sanitize_text_field($_POST['pwb3d-fname']);
    unset($metadata['action']);
    unset($metadata['pwb3d-id']);
    unset($metadata['pwb3d-email']);
    unset($metadata['pwb3d-amount']);
    unset($metadata['pwb3d-user_id']);

    $unTouchedMetaData = pwb3d_generate_metadata_custom_fields($metadata);

    $currency = get_post_meta(sanitize_text_field($_POST["pwb3d-id"]), 'pwb3d_currency', true);
    $formAmount = get_post_meta(sanitize_text_field($_POST["pwb3d-id"]), 'pwb3d_amount', true);
    $minimum = get_post_meta(sanitize_text_field($_POST["pwb3d-id"]), 'pwb3d_minimum', true);
    $color = get_post_meta(sanitize_text_field($_POST["pwb3d-id"]), 'pwb3d_color', true);
    $amount = (int) str_replace(' ', '', sanitize_text_field($_POST["pwb3d-amount"]));
    $originalAmount = $amount;
    if ($minimum == 1 && $formAmount != 0) {
        if ($originalAmount < $formAmount) {
            $amount = $formAmount;
        } else {
            $amount = $originalAmount;
        }
    }
    $fixedMetaData[] =  array(
        'display_name' => 'Unit Price',
        'variable_name' => 'Unit_Price',
        'type' => 'text',
        'value' => $currency . number_format($amount)
    );
    $fixedMetaData = json_decode(json_encode($fixedMetaData, JSON_NUMERIC_CHECK), true);
    $fixedMetaData = array_merge($unTouchedMetaData, $fixedMetaData);

    $inserted =  array(
        'pwb3d_id' => intval($_POST["pwb3d-id"]),
        'email' => sanitize_email($_POST["pwb3d-email"]),
        'user_id' => intval($_POST["pwb3d-user_id"]),
        'amount' => strip_tags($amount, ""),
        'ip' => pwb3d_get_user_ip(),
        'txn_code' => $code,
        'metadata' => json_encode($fixedMetaData)
    );
    $exist = $wpdb->get_results(
        "SELECT * FROM $table WHERE (pwb3d_id = '" . $inserted['pwb3d_id'] . "'
			AND email = '" . $inserted['email'] . "'
			AND user_id = '" . $inserted['user_id'] . "'
			AND amount = '" . $inserted['amount'] . "'
			AND ip = '" . $inserted['ip'] . "'
			AND paid = '0'
			AND metadata = '" . $inserted['metadata'] . "')"
    );
    //pwb3d_write_log($exist);
    if (count($exist) > 0) {
        $wpdb->update($table, array('txn_code' => $code), array('id' => $exist[0]->ID));
    } else {
        $wpdb->insert(
            $table,
            $inserted
        );

        //send Invoice
        wp_schedule_single_event( time() + 60, 'b3d_send_invoice', array( $currency, $inserted['amount'], $fullname, $inserted['email'], $code ) );

        //pwb3d_send_invoice($currency, $inserted['amount'], $fullname, $inserted['email'], $code);
    }
    $amount = floatval($inserted['amount']) * 100;
    $response = array(
        'result' => 'success',
        'code' => $inserted['txn_code'],
        'email' => $inserted['email'],
        'name' => $fullname,
        'total' => round($amount),
        'currency' => $currency,
        'custom_fields' => $fixedMetaData,
        'color' => $color
    );
    echo json_encode($response);
    die();
}


function pwb3d_write_log($log) {
    if (true === WP_DEBUG) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

function pwb3d_generate_metadata_custom_fields($metadata)
{
    $custom_fields = array();
    foreach ($metadata as $key => $value) {
        if (is_array($value)) {
            $value = implode(', ', $value);
        }
        if ($key == 'pwb3d-fname') {
            $custom_fields[] =  array(
                'display_name' => 'Full Name',
                'variable_name' => 'Full_Name',
                'type' => 'text',
                'value' => $value
            );
        }   else {
            $custom_fields[] =  array(
                'display_name' => ucwords(str_replace("_", " ", $key)),
                'variable_name' => $key,
                'type' => 'text',
                'value' => (string) $value
            );
        }
    }
    return $custom_fields;
}





