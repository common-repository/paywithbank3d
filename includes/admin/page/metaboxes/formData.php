<?php

function pwb3d_editor_add_form_data(){
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
        wp_create_nonce(plugin_basename(PWB3D_PLUGIN_URL)) . '" />';


    $amount = get_post_meta($post->ID, 'pwb3d_amount', true);
    $paybtn = get_post_meta($post->ID, 'pwb3d_paybtn', true);
    $successmsg = get_post_meta($post->ID, 'pwb3d_successmsg', true);
    $loggedin = get_post_meta($post->ID, 'pwb3d_loggedin', true);
    $currency = get_post_meta($post->ID, 'pwb3d_currency', true);
    $redirect = get_post_meta($post->ID, 'pwb3d_redirect', true);
    $minimum = get_post_meta($post->ID, 'pwb3d_minimum', true);
    $hidetitle = get_post_meta($post->ID, 'pwb3d_hidetitle', true);


    if ($amount == "") {
        $amount = 0;
    }
    if ($paybtn == "") {
        $paybtn = 'Pay';
    }
    if ($successmsg == "") {
        $successmsg = 'Thank you for paying!';
    }
    if ($currency == "") {
        $currency = 'NGN';
    }

    if ($minimum == "") {
        $minimum = 0;
    }

    if ($hidetitle == "") {
        $hidetitle = 0;
    }

    if ($hidetitle == 1) {
        echo '<label><input name="pwb3d_hidetitle" type="checkbox" value="1" checked> Hide the form title </label>';
    } else {
        echo '<label><input name="pwb3d_hidetitle" type="checkbox" value="1" > Hide the form title </label>';
    }

    echo "<br>";
    echo '<p>Currency:</p>';
    echo '<select class="form-control" name="pwb3d_currency" style="width:100%;">
						<option value="NGN" ' . pwb3d_check('NGN', $currency) . '>Nigerian Naira</option>
				  </select>';
    echo '<p>Amount to be paid(Set 0 for customer input):</p>';
    echo '<input type="number" name="pwb3d_amount" value="' . $amount  . '" class="widefat pf-number" />';
    if ($minimum == 1) {
        echo '<br><label><input name="pwb3d_minimum" type="checkbox" value="1" checked> Make amount minimum payable </label>';
    } else {
        echo '<br><label><input name="pwb3d_minimum" type="checkbox" value="1"> Make amount minimum payable </label>';
    }
    echo '<p>User logged In:</p>';
    echo '<select class="form-control" name="pwb3d_loggedin" id="parent_id" style="width:100%;">
								<option value="no" ' . pwb3d_check('no', $loggedin) . '>User must not be logged in</option>
								<option value="yes"' . pwb3d_check('yes', $loggedin) . '>User must be logged In</option>
							</select>';
    echo '<p>Pay button Description:</p>';
    echo '<input type="text" name="pwb3d_paybtn" value="' . $paybtn  . '" class="widefat" />';
    echo '<p>Success Message after Payment</p>';
    echo '<textarea rows="3"  name="pwb3d_successmsg"  class="widefat" >' . $successmsg . '</textarea>';
    echo '<p>Redirect to page link after payment(keep blank to use normal success message):</p>';
    echo '<input ttype="text" name="pwb3d_redirect" value="' . $redirect  . '" class="widefat" />';

}
//add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );

function pwb3d_editor_add_color_data(){
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
        wp_create_nonce(plugin_basename(PWB3D_PLUGIN_URL)) . '" />';

    $color = get_post_meta($post->ID, 'pwb3d_color', true);

    if ($color == "") {
        $color = '#aa0066';
    }

    echo '<p>Color</p>';
    echo '<input type="text" name="pwb3d_color" value="' . $color  . '"class="my-color-field"  />';
}

