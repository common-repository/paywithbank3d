<?php


function pwb3d_register_newpage(){
    add_menu_page('paywithbank3d', 'paywithbank3d', 'administrator', 'pwb3d_view_payment', 'pwb3d_payment_list');
    remove_menu_page('pwb3d_view_payment');
}


function pwb3d_payment_list(){
    $id = sanitize_key($_GET['form']);
    $obj = get_post($id);
    if ($obj->post_type == 'paywithbank3d') {

//        $amount = get_post_meta($id, 'pwb3d_amount', true);
//        $thankyou = get_post_meta($id, 'pwb3d_successmsg', true);
//        $paybtn = get_post_meta($id, 'pwb3d_paybtn', true);
//        $loggedin = get_post_meta($id, 'pwb3d_loggedin', true);

        $paymentData  = new paymentTable();
        $data = $paymentData->prepare_items(); ?>
        <div id="welcome-panel" class="welcome-panel" style="background-image: url('<?php echo plugins_url('../../assets/images/Paywithbank3D.png', __FILE__); ?>'); background-repeat: no-repeat; background-position: right; ">
            <div class="welcome-panel-content">
            <h1 style="margin: 0px;"><?php echo ucwords($obj->post_title); ?> Payments </h1>
            <p class="about-description">All payments made for this form</p>
            <?php if ($data > 0) {
                ?>

                <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                    <input type="hidden" name="action" value="pwb3d_export_to_excel">
                    <input type="hidden" name="form_id" value="<?php echo $id; ?>">
                    <button type="submit" class="button button-primary button-hero load-customize">Export Data to Excel</button>
                </form>
                <?php
            } ?>
            <br><br>
        </div>
        </div>
        <div class="wrap">
            <div id="icon-users" class="icon32"></div>
            <?php $paymentData->display(); ?>
        </div>

<?php
    }
}