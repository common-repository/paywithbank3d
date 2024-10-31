<?php

function pwb3d_export_to_excel()
{
    global $wpdb;
    $post_id = intval($_POST['form_id']);
    $obj = get_post($post_id);
    $csv_output = "";
    $currency = get_post_meta($post_id, 'pwb3d_currency', true);
    if ($currency == "") {
        $currency = 'NGN';
    }
    $table = $wpdb->prefix . PWB3D_DB_TABLE;
    $data = array();
    $alldbdata = $wpdb->get_results("SELECT * FROM $table WHERE (pwb3d_id = '" . $post_id . "' AND paid = '1')  ORDER BY `id` ASC");
    $i = 0;
    if (count($alldbdata) > 0) {
        $header = $alldbdata[0];
        $csv_output .= "#,";
        $csv_output .= "Email,";
        $csv_output .= "Amount,";
        $csv_output .= "Date Paid,";
        $csv_output .= "Reference,";
        $new = json_decode($header->metadata);
        $text = '';
        if (array_key_exists("0", $new)) {
            foreach ($new as $key => $item) {
                $csv_output .= pwb3d_prep_csv_data($item->display_name) . ",";
            }
        } else {
            if (count($new) > 0) {
                foreach ($new as $key => $item) {
                    $csv_output .= pwb3d_prep_csv_data($key) . ",";
                }
            }
        }
        $csv_output .= "\n";
        foreach ($alldbdata as $key => $dbdata) {
            $newkey = $key + 1;
            $csv_output .= pwb3d_prep_csv_data($newkey) . ",";
            $csv_output .= pwb3d_prep_csv_data($dbdata->email) . ",";
            $csv_output .= pwb3d_prep_csv_data($currency . ' ' . $dbdata->amount) . ",";
            $csv_output .= pwb3d_prep_csv_data(substr($dbdata->created_at, 0, 10)) . ",";
            $csv_output .= pwb3d_prep_csv_data($dbdata->txn_code) . ",";
            $new = json_decode($dbdata->metadata);
            $text = '';
            if (array_key_exists("0", $new)) {
                foreach ($new as $key => $item) {
                    $csv_output .= pwb3d_prep_csv_data($item->value) . ",";
                }
            } else {
                if (count($new) > 0) {
                    foreach ($new as $key => $item) {
                        $csv_output .= pwb3d_prep_csv_data($item) . ",";
                    }
                }
            }
            $csv_output .= "\n";
        }
        $filename = $obj->post_title . "_payments_" . date("Y-m-d_H-i", time());
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: csv" . date("Y-m-d") . ".csv");
        header("Content-disposition: filename=" . $filename . ".csv");
        print $csv_output;
        exit;
    }
}

function pwb3d_prep_csv_data($item)
{
    return '"' . str_replace('"', '""', $item) . '"';
}