<?php

function pwb3d_send_receipts($id, $currency, $amount, $name, $email, $code, $metadata, $merchantRef){
    $user_email = stripslashes($email);
    $subject = get_post_meta($id, 'pwb3d_subject', true);
    //$merchant = get_post_meta($id, 'pwb3d_merchant', true);
    $heading = get_post_meta($id, 'pwb3d_heading', true);
    $siteMessage = get_post_meta($id, 'pwb3d_message', true);
    ob_start();
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="date=no">
        <meta name="format-detection" content="address=no">
        <meta name="format-detection" content="email=no">
        <title></title>
        <style type="text/css">body{Margin:0;padding:0;min-width:100%}a,#outlook a{display:inline-block}a,a span{text-decoration:none}img{line-height:1;outline:0;border:0;text-decoration:none;-ms-interpolation-mode:bicubic;mso-line-height-rule:exactly}table{border-spacing:0;mso-table-lspace:0;mso-table-rspace:0}td{padding:0}.email_summary{display:none;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden}.font_default,h1,h2,h3,h4,h5,h6,p,a{font-family:Helvetica,Arial,sans-serif}small{font-size:86%;font-weight:normal}.pricing_box_cell small{font-size:74%}.font_default,p{font-size:15px}p{line-height:23px;Margin-top:16px;Margin-bottom:24px}.lead{font-size:19px;line-height:27px;Margin-bottom:16px}.header_cell .column_cell{font-size:20px;font-weight:bold}.header_cell p{margin-bottom:0}h1,h2,h3,h4,h5,h6{Margin-left:0;Margin-right:0;Margin-top:16px;Margin-bottom:8px;padding:0}.line-through{text-decoration:line-through}h1,h2{font-size:26px;line-height:36px;font-weight:bold}.pricing_box h1,.pricing_box h2,.primary_pricing_box h1,.primary_pricing_box h2{line-height:20px;Margin-top:16px;Margin-bottom:0}h3,h4{font-size:22px;line-height:30px;font-weight:bold}h5{font-size:18px;line-height:26px;font-weight:bold}h6{font-size:16px;line-height:24px;font-weight:bold}.primary_btn td,.secondary_btn td{font-size:16px;mso-line-height-rule:exactly}.primary_btn a,.secondary_btn a{font-weight:bold}.email_body{padding:32px 6px;text-align:center}.email_container,.row,.col-1,.col-13,.col-2,.col-3{display:inline-block;width:100%;vertical-align:top;text-align:center}.email_container{width:100%;margin:0 auto}.email_container{max-width:588px}.row,.col-3{max-width:580px}.col-1{max-width:190px}.col-2{max-width:290px}.col-13{max-width:390px}.row{margin:0 auto}.column{width:100%;vertical-align:top}.column_cell{padding:16px;text-align:center;vertical-align:top}.col-bottom-0 .column_cell{padding-bottom:0}.col-top-0 .column_cell{padding-top:0}.email_container,.header_cell,.jumbotron_cell,.content_cell,.footer_cell,.image_responsive{font-size:0!important;text-align:center}.header_cell,.footer_cell{padding-bottom:16px}.header_cell .column_cell,.footer_cell .col-13 .column_cell,.footer_cell .col-1 .column_cell{text-align:left;padding-top:16px}.header_cell img{max-width:156px;height:auto}.footer_cell{text-align:center}.footer_cell p{Margin:16px 0}.invoice_cell .column_cell{text-align:left;padding-top:0;padding-bottom:0}.invoice_cell p{margin-top:8px;margin-bottom:16px}.pricing_box{border-collapse:separate;padding:10px 16px}.primary_pricing_box{border-collapse:separate;padding:18px 16px}.text_quote .column_cell{border-left:4px solid;text-align:left;padding-right:0;padding-top:0;padding-bottom:0}.primary_btn,.secondary_btn{clear:both;margin:0 auto}.primary_btn td,.secondary_btn td{text-align:center;vertical-align:middle;padding:12px 24px}.primary_btn a,.primary_btn span,.secondary_btn a,.secondary_btn span{text-align:center;display:block}.label .font_default{font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:2px;padding:3px 7px;white-space:nowrap}.icon_holder,.hruler{width:62px;margin-left:auto;margin-right:auto;clear:both}.icon_holder{width:48px}.hspace,.hruler_cell{font-size:0;height:8px;overflow:hidden}.hruler_cell{height:4px;line-height:4px}.icon_cell{font-size:0;line-height:1;padding:8px;height:48px}.product_row{padding:0 0 16px}.product_row .column_cell{padding:16px 16px 0}.product_row .col-13 .column_cell{text-align:left}.product_row h6{Margin-top:0}.product_row p{Margin-top:8px;Margin-bottom:8px}.order_total_right .column_cell{text-align:right}.order_total_left .column_cell{text-align:left}.order_total p{Margin:8px 0}.order_total h2{Margin:8px 0}.image_responsive img{display:block;width:100%;height:auto;max-width:580px;margin-left:auto;margin-right:auto}body,.email_body,.header_cell,.content_cell,.footer_cell{background-color:#fff}.secondary_btn td,.icon_primary .icon_cell,.primary_pricing_box{background-color:#2f68b4}.jumbotron_cell,.pricing_box{background-color:#f2f2f5}.primary_btn td,.label .font_default{background-color:#22aaa0}.icon_secondary .icon_cell{background-color:#e1e3e7}.label_1 .font_default{background-color:#62a9dd}.label_2 .font_default{background-color:#8965ad}.label_3 .font_default{background-color:#df6164}.primary_btn a,.primary_btn span,.secondary_btn a,.secondary_btn span,.label .font_default,.primary_pricing_box,.primary_pricing_box h1,.primary_pricing_box small{color:#fff}h2,h4,h5,h6{color:#383d42}.column_cell{color:#888}.header_cell .column_cell,.header_cell a,.header_cell a span,h1,h3,a,a span,.text-secondary,.column_cell .text-secondary,.content_cell h2 .text-secondary{color:#2f68b4}.footer_cell a,.footer_cell a span{color:#7a7a7a}.text-muted,.footer_cell .column_cell,.content h4 span,.content h3 span{color:#b3b3b5}.header_cell,.footer_cell{border-top:4px solid;border-bottom:4px solid}.header_cell,.footer_cell,.jumbotron_cell,.content_cell{border-left:4px solid;border-right:4px solid}.footer_cell,.product_row,.order_total{border-top:1px solid}.header_cell,.footer_cell,.jumbotron_cell,.content_cell,.product_row,.order_total,.icon_secondary .icon_cell,.footer_cell,.content .product_row,.content .order_total,.pricing_box,.text_quote .column_cell{border-color:#d8dde4}@media screen{h1,h2,h3,h4,h5,h6,p,a,.font_default{font-family:"Noto Sans",Helvetica,Arial,sans-serif!important}.primary_btn td,.secondary_btn td{padding:0!important}.primary_btn a,.secondary_btn a{padding:12px 24px!important}}@media screen and (min-width:631px) and (max-width:769px){.col-1,.col-2,.col-3,.col-13{float:left!important}.col-1{width:200px!important}.col-2{width:300px!important}}@media screen and (max-width:630px){.jumbotron_cell{background-size:cover!important}.row,.col-1,.col-13,.col-2,.col-3{max-width:100%!important}}</style>
    </head>

    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin:0;padding:0;min-width:100%;background-color:#fff">
    <div class="email_body" style="padding:32px 6px;text-align:center;background-color:#fff">

        <div class="email_container" style="display:inline-block;width:100%;vertical-align:top;text-align:center;margin:0 auto;max-width:588px;font-size:0!important">
            <table class="header" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="header_cell col-bottom-0" align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;border-top:4px solid;border-bottom:0 solid;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="content" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="content_cell" align="center" valign="top" style="padding:0;text-align:center;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">

                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">

                            <div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888">
                                            <p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:16px;margin-bottom:24px">&nbsp; </p>
                                            <h5 style="font-family:Helvetica,Arial,sans-serif;margin-left:0;margin-right:0;margin-top:16px;margin-bottom:8px;padding:0;font-size:18px;line-height:26px;font-weight:bold;color:#383d42"><?php echo $heading; ?></h5>
                                            <p align="left" style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:16px;margin-bottom:24px">Hello <?php echo strstr($name . " ", " ", true); ?>,</p>
                                            <p align="left" style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:16px;margin-bottom:24px"><?php echo $siteMessage; ?></p>
                                            <p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:16px;margin-bottom:24px">&nbsp; </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="jumbotron" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="jumbotron_cell invoice_cell" align="center" valign="top" style="padding:0;text-align:center;background-color:#fafafa;font-size:0!important">

                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">

                            <div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:left">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#888;padding-top:0;padding-bottom:0">
                                            <table class="label" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                                                <tbody>
                                                <tr>
                                                    <td class="hspace" style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="hspace" style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="font_default" style="padding:3px 7px;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:2px;-webkit-border-radius:2px;border-radius:2px;white-space:nowrap;background-color:#666;color:#fff">Your Details</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:8px;margin-bottom:16px">
                                                Amount <strong> : <?php echo $currency . ' ' . number_format($amount); ?></strong><br>
                                                Email <strong> : <?php echo $user_email; ?></strong><br>
                                                <?php
                                                $new = json_decode($metadata);
                                                if (array_key_exists("0", $new)) {
                                                    foreach ($new as $key => $item) {
                                                        if ($item->type == 'text') {
                                                            echo $item->display_name . "<strong>  :" . $item->value . "</strong><br>";
                                                        } else {
                                                            echo $item->display_name . "<strong>  : <a target='_blank' href='" . $item->value . "'>link</a></strong><br>";
                                                        }
                                                    }
                                                } else {
                                                    $text = '';
                                                    if (count($new) > 0) {
                                                        foreach ($new as $key => $item) {
                                                            echo $key . "<strong>  :" . $item . "</strong><br />";
                                                        }
                                                    }
                                                } ?>
                                                Transaction code: <strong> <?php echo $code; ?></strong><br>
                                                Invoice No: <strong> <?php echo $merchantRef; ?></strong><br>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="jumbotron" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="jumbotron_cell product_row" align="center" valign="top" style="padding:0 0 16px;text-align:center;background-color:#f2f2f5;border-left:4px solid;border-right:4px solid;border-top:1px solid;border-color:#d8dde4;font-size:0!important">

                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">

                            <div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px 16px 0;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888">
                                            <small style="font-size:86%;font-weight:normal"><strong>Notice</strong><br>
                                                You're getting this email because you've made a payment of <?php echo $currency . ' ' . number_format($amount); ?> to <a href="<?php echo get_bloginfo('url') ?>" style="display:inline-block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#2f68b4"><?php echo get_option('blogname'); ?></a>.</small>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="footer" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="footer_cell" align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;border-top:1px solid;border-bottom:4px solid;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">
                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                            <div class="col-13 col-bottom-0" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:390px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
                                            <strong><?php echo get_option('blogname'); ?></strong><br>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-1 col-bottom-0" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:190px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </body>

    </html>


    <?php
    $message = ob_get_contents();
    ob_end_clean();
    $admin_email = get_option('admin_email');
    $website = get_option('blogname');
    $headers = array('Reply-To: ' . $admin_email, "From: $website <$admin_email>" . "\r\n");
    $headers = "From: " . $website . "<$admin_email>" . "\r\n";
    wp_mail($user_email, $subject, $message, $headers);
}

function pwb3d_send_receipts_owner($id, $currency, $amount, $name, $email, $code, $metadata){
    $user_email = stripslashes($email);
    $email_subject = "You just received a payment";
    $heading = get_post_meta($id, 'pwb3d_heading', true);
    $siteMessage = get_post_meta($id, 'pwb3d_message', true);


    ob_start();
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="date=no">
        <meta name="format-detection" content="address=no">
        <meta name="format-detection" content="email=no">
        <title></title>
        <style type="text/css">
            body {
                Margin: 0;
                padding: 0;
                min-width: 100%
            }

            a,
            #outlook a {
                display: inline-block
            }

            a,
            a span {
                text-decoration: none
            }

            img {
                line-height: 1;
                outline: 0;
                border: 0;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
                mso-line-height-rule: exactly
            }

            table {
                border-spacing: 0;
                mso-table-lspace: 0;
                mso-table-rspace: 0
            }

            td {
                padding: 0
            }

            .email_summary {
                display: none;
                font-size: 1px;
                line-height: 1px;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden
            }

            .font_default,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            a {
                font-family: Helvetica, Arial, sans-serif
            }

            small {
                font-size: 86%;
                font-weight: normal
            }

            .pricing_box_cell small {
                font-size: 74%
            }

            .font_default,
            p {
                font-size: 15px
            }

            p {
                line-height: 23px;
                Margin-top: 16px;
                Margin-bottom: 24px
            }

            .lead {
                font-size: 19px;
                line-height: 27px;
                Margin-bottom: 16px
            }

            .header_cell .column_cell {
                font-size: 20px;
                font-weight: bold
            }

            .header_cell p {
                margin-bottom: 0
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                Margin-left: 0;
                Margin-right: 0;
                Margin-top: 16px;
                Margin-bottom: 8px;
                padding: 0
            }

            .line-through {
                text-decoration: line-through
            }

            h1,
            h2 {
                font-size: 26px;
                line-height: 36px;
                font-weight: bold
            }

            .pricing_box h1,
            .pricing_box h2,
            .primary_pricing_box h1,
            .primary_pricing_box h2 {
                line-height: 20px;
                Margin-top: 16px;
                Margin-bottom: 0
            }

            h3,
            h4 {
                font-size: 22px;
                line-height: 30px;
                font-weight: bold
            }

            h5 {
                font-size: 18px;
                line-height: 26px;
                font-weight: bold
            }

            h6 {
                font-size: 16px;
                line-height: 24px;
                font-weight: bold
            }

            .primary_btn td,
            .secondary_btn td {
                font-size: 16px;
                mso-line-height-rule: exactly
            }

            .primary_btn a,
            .secondary_btn a {
                font-weight: bold
            }

            .email_body {
                padding: 32px 6px;
                text-align: center
            }

            .email_container,
            .row,
            .col-1,
            .col-13,
            .col-2,
            .col-3 {
                display: inline-block;
                width: 100%;
                vertical-align: top;
                text-align: center
            }

            .email_container {
                width: 100%;
                margin: 0 auto
            }

            .email_container {
                max-width: 588px
            }

            .row,
            .col-3 {
                max-width: 580px
            }

            .col-1 {
                max-width: 190px
            }

            .col-2 {
                max-width: 290px
            }

            .col-13 {
                max-width: 390px
            }

            .row {
                margin: 0 auto
            }

            .column {
                width: 100%;
                vertical-align: top
            }

            .column_cell {
                padding: 16px;
                text-align: center;
                vertical-align: top
            }

            .col-bottom-0 .column_cell {
                padding-bottom: 0
            }

            .col-top-0 .column_cell {
                padding-top: 0
            }

            .email_container,
            .header_cell,
            .jumbotron_cell,
            .content_cell,
            .footer_cell,
            .image_responsive {
                font-size: 0 !important;
                text-align: center
            }

            .header_cell,
            .footer_cell {
                padding-bottom: 16px
            }

            .header_cell .column_cell,
            .footer_cell .col-13 .column_cell,
            .footer_cell .col-1 .column_cell {
                text-align: left;
                padding-top: 16px
            }

            .header_cell img {
                max-width: 156px;
                height: auto
            }

            .footer_cell {
                text-align: center
            }

            .footer_cell p {
                Margin: 16px 0
            }

            .invoice_cell .column_cell {
                text-align: left;
                padding-top: 0;
                padding-bottom: 0
            }

            .invoice_cell p {
                margin-top: 8px;
                margin-bottom: 16px
            }

            .pricing_box {
                border-collapse: separate;
                padding: 10px 16px
            }

            .primary_pricing_box {
                border-collapse: separate;
                padding: 18px 16px
            }

            .text_quote .column_cell {
                border-left: 4px solid;
                text-align: left;
                padding-right: 0;
                padding-top: 0;
                padding-bottom: 0
            }

            .primary_btn,
            .secondary_btn {
                clear: both;
                margin: 0 auto
            }

            .primary_btn td,
            .secondary_btn td {
                text-align: center;
                vertical-align: middle;
                padding: 12px 24px
            }

            .primary_btn a,
            .primary_btn span,
            .secondary_btn a,
            .secondary_btn span {
                text-align: center;
                display: block
            }

            .label .font_default {
                font-size: 10px;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 2px;
                padding: 3px 7px;
                white-space: nowrap
            }

            .icon_holder,
            .hruler {
                width: 62px;
                margin-left: auto;
                margin-right: auto;
                clear: both
            }

            .icon_holder {
                width: 48px
            }

            .hspace,
            .hruler_cell {
                font-size: 0;
                height: 8px;
                overflow: hidden
            }

            .hruler_cell {
                height: 4px;
                line-height: 4px
            }

            .icon_cell {
                font-size: 0;
                line-height: 1;
                padding: 8px;
                height: 48px
            }

            .product_row {
                padding: 0 0 16px
            }

            .product_row .column_cell {
                padding: 16px 16px 0
            }

            .product_row .col-13 .column_cell {
                text-align: left
            }

            .product_row h6 {
                Margin-top: 0
            }

            .product_row p {
                Margin-top: 8px;
                Margin-bottom: 8px
            }

            .order_total_right .column_cell {
                text-align: right
            }

            .order_total_left .column_cell {
                text-align: left
            }

            .order_total p {
                Margin: 8px 0
            }

            .order_total h2 {
                Margin: 8px 0
            }

            .image_responsive img {
                display: block;
                width: 100%;
                height: auto;
                max-width: 580px;
                margin-left: auto;
                margin-right: auto
            }

            body,
            .email_body,
            .header_cell,
            .content_cell,
            .footer_cell {
                background-color: #fff
            }

            .secondary_btn td,
            .icon_primary .icon_cell,
            .primary_pricing_box {
                background-color: #2f68b4
            }

            .jumbotron_cell,
            .pricing_box {
                background-color: #f2f2f5
            }

            .primary_btn td,
            .label .font_default {
                background-color: #22aaa0
            }

            .icon_secondary .icon_cell {
                background-color: #e1e3e7
            }

            .label_1 .font_default {
                background-color: #62a9dd
            }

            .label_2 .font_default {
                background-color: #8965ad
            }

            .label_3 .font_default {
                background-color: #df6164
            }

            .primary_btn a,
            .primary_btn span,
            .secondary_btn a,
            .secondary_btn span,
            .label .font_default,
            .primary_pricing_box,
            .primary_pricing_box h1,
            .primary_pricing_box small {
                color: #fff
            }

            h2,
            h4,
            h5,
            h6 {
                color: #383d42
            }

            .column_cell {
                color: #888
            }

            .header_cell .column_cell,
            .header_cell a,
            .header_cell a span,
            h1,
            h3,
            a,
            a span,
            .text-secondary,
            .column_cell .text-secondary,
            .content_cell h2 .text-secondary {
                color: #2f68b4
            }

            .footer_cell a,
            .footer_cell a span {
                color: #7a7a7a
            }

            .text-muted,
            .footer_cell .column_cell,
            .content h4 span,
            .content h3 span {
                color: #b3b3b5
            }

            .header_cell,
            .footer_cell {
                border-top: 4px solid;
                border-bottom: 4px solid
            }

            .header_cell,
            .footer_cell,
            .jumbotron_cell,
            .content_cell {
                border-left: 4px solid;
                border-right: 4px solid
            }

            .footer_cell,
            .product_row,
            .order_total {
                border-top: 1px solid
            }

            .header_cell,
            .footer_cell,
            .jumbotron_cell,
            .content_cell,
            .product_row,
            .order_total,
            .icon_secondary .icon_cell,
            .footer_cell,
            .content .product_row,
            .content .order_total,
            .pricing_box,
            .text_quote .column_cell {
                border-color: #d8dde4
            }

            @media screen {

                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                p,
                a,
                .font_default {
                    font-family: "Noto Sans", Helvetica, Arial, sans-serif !important
                }

                .primary_btn td,
                .secondary_btn td {
                    padding: 0 !important
                }

                .primary_btn a,
                .secondary_btn a {
                    padding: 12px 24px !important
                }
            }

            @media screen and (min-width:631px) and (max-width:769px) {

                .col-1,
                .col-2,
                .col-3,
                .col-13 {
                    float: left !important
                }

                .col-1 {
                    width: 200px !important
                }

                .col-2 {
                    width: 300px !important
                }
            }

            @media screen and (max-width:630px) {
                .jumbotron_cell {
                    background-size: cover !important
                }

                .row,
                .col-1,
                .col-13,
                .col-2,
                .col-3 {
                    max-width: 100% !important
                }
            }
        </style>
    </head>

    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin:0;padding:0;min-width:100%;background-color:#fff">
    <div class="email_body" style="padding:32px 6px;text-align:center;background-color:#fff">

        <div class="email_container" style="display:inline-block;width:100%;vertical-align:top;text-align:center;margin:0 auto;max-width:588px;font-size:0!important">
            <table class="header" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="header_cell col-bottom-0" align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;border-top:4px solid;border-bottom:0 solid;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="content" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="content_cell" align="center" valign="top" style="padding:0;text-align:center;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">

                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">

                            <div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888">
                                            <p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:16px;margin-bottom:24px">&nbsp; </p>
                                            <h5 style="font-family:Helvetica,Arial,sans-serif;margin-left:0;margin-right:0;margin-top:16px;margin-bottom:8px;padding:0;font-size:18px;line-height:26px;font-weight:bold;color:#383d42">You just received a payment</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="jumbotron" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="jumbotron_cell invoice_cell" align="center" valign="top" style="padding:0;text-align:center;background-color:#fafafa;font-size:0!important">

                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">

                            <div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:left">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#888;padding-top:0;padding-bottom:0">
                                            <table class="label" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                                                <tbody>
                                                <tr>
                                                    <td class="hspace" style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="hspace" style="padding:0;font-size:0;height:8px;overflow:hidden">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="font_default" style="padding:3px 7px;font-family:Helvetica,Arial,sans-serif;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:2px;-webkit-border-radius:2px;border-radius:2px;white-space:nowrap;background-color:#666;color:#fff">Payment Details</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p style="font-family:Helvetica,Arial,sans-serif;font-size:15px;line-height:23px;margin-top:8px;margin-bottom:16px">
                                                Amount <strong> : <?php echo $currency . ' ' . number_format($amount); ?></strong><br>
                                                Email <strong> : <?php echo $user_email; ?></strong><br>
                                                <?php
                                                $new = json_decode($metadata);
                                                if (array_key_exists("0", $new)) {
                                                    foreach ($new as $key => $item) {
                                                        if ($item->type == 'text') {
                                                            echo $item->display_name . "<strong>  :" . $item->value . "</strong><br>";
                                                        } else {
                                                            echo $item->display_name . "<strong>  : <a target='_blank' href='" . $item->value . "'>link</a></strong><br>";
                                                        }
                                                    }
                                                } else {
                                                    $text = '';
                                                    if (count($new) > 0) {
                                                        foreach ($new as $key => $item) {
                                                            echo $key . "<strong>  :" . $item . "</strong><br />";
                                                        }
                                                    }
                                                } ?>
                                                Transaction code: <strong> <?php echo $code; ?></strong><br>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="jumbotron" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="jumbotron_cell product_row" align="center" valign="top" style="padding:0 0 16px;text-align:center;background-color:#f2f2f5;border-left:4px solid;border-right:4px solid;border-top:1px solid;border-color:#d8dde4;font-size:0!important">

                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">

                            <div class="col-3" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px 16px 0;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:center;vertical-align:top;color:#888">
                                            <small style="font-size:86%;font-weight:normal"><strong>Notice</strong><br>
                                                You're getting this email because someone made a payment of <?php echo $currency . ' ' . number_format($amount); ?> to <a href="<?php echo get_bloginfo('url') ?>" style="display:inline-block;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#2f68b4"><?php echo get_option('blogname'); ?></a>.</small>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="footer" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                <tbody>
                <tr>
                    <td class="footer_cell" align="center" valign="top" style="padding:0;text-align:center;padding-bottom:16px;border-top:1px solid;border-bottom:4px solid;background-color:#fff;border-left:4px solid;border-right:4px solid;border-color:#d8dde4;font-size:0!important">
                        <div class="row" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:580px;margin:0 auto">
                            <div class="col-13 col-bottom-0" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:390px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
                                            <strong><?php echo get_option('blogname'); ?></strong><br>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-1 col-bottom-0" style="display:inline-block;width:100%;vertical-align:top;text-align:center;max-width:190px">
                                <table class="column" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;width:100%;vertical-align:top">
                                    <tbody>
                                    <tr>
                                        <td class="column_cell font_default" align="center" valign="top" style="padding:16px;font-family:Helvetica,Arial,sans-serif;font-size:15px;text-align:left;vertical-align:top;color:#b3b3b5;padding-bottom:0;padding-top:16px">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </body>

    </html>
    <?php
    $message = ob_get_contents();
    ob_end_clean();
    $admin_email = get_option('admin_email');
    $website = get_option('blogname');
    // $headers = array("From: $website <$admin_email>" . "\r\n");
    $headers = "From: " . $website . "<$admin_email>" . "\r\n";
    wp_mail($admin_email, $email_subject, $message, $headers);
}
