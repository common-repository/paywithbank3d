<?php

$code = sanitize_key(@$_GET['pwb3d_id']);
function pwb3d_format_meta($data)
{
    $new = json_decode($data);

    $text = '';
    if (array_key_exists("0", $new)) {
        foreach ($new as $key => $item) {

            if($item->display_name === 'Pwb3d-currency') {
                $display_name = 'Currency';
            } else if($item->display_name == 'Pwb3d-minimum-hidden'){
                $display_name ='Minimun';

            } else if($item->display_name == 'Pwb3d Agreement'){
                $display_name = 'Agreement';
            } else {
                $display_name = $item->display_name;
            }
            if ($item->type == 'text') {
                $text.= '<tr>
								<td>'.$display_name.':</td>
								<td>'.$item->value.'</td>
							</tr>';
            }else{
                $text.= '<tr>
								<td>'.$display_name.':</label>
								<td> <a target="_blank" href="'.$item->value.'">link</a></td>
							</tr>';
            }

        }
    }else{
        $text = '';
        if (count($new) > 0) {
            foreach ($new as $key => $item) {
                $text.= '<tr>
								<td>'.$key.':</td>
								<td>'.$item.'</td>
							</tr>';
            }
        }
    }
    //
    return $text;
}
global $wpdb;
$table = $wpdb->prefix.PWB3D_DB_TABLE;
$record = $wpdb->get_results("SELECT * FROM $table WHERE (txn_code = '".$code."')");
if (array_key_exists("0", $record)) {
    get_header();
    $pwb3d_data = $record[0];
    $currency = get_post_meta($pwb3d_data->pwb3d_id, 'pwb3d_currency', true);

    ?>
    <div id="pwb3d-invoice-page">
    <h3>Payment Invoice For <?php echo $code ?></h3>
    <hr class="style-seven">
    <table id="pwb3d_invoice">
        <tr>
            <th>Company</th>
            <th>Contact</th>
        </tr>



                            <tr>
                                <td>Email</td>
                                <td><?php echo $pwb3d_data->email; ?></td>

                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td><?php echo $currency.number_format($pwb3d_data->amount); ?></td>
                            </tr>
                            <?php echo pwb3d_format_meta($pwb3d_data->metadata); ?>
                            <tr>
                                <td>Date:</td>
                                <td><?php echo $pwb3d_data->created_at; ?></td>
                            </tr>
                            <?php if($pwb3d_data->paid == 1) {?>
                            <tr>
                                        <td>Payment Status:</td>
                                        <td> Successful</td>

                            </tr>
                            <?php } ?>


    </table>

    </div>

    <?php
    get_footer();
} else {
    die('Invoice code invalid');
}
