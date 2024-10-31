<?php

function pwb3d_editor_add_email_data(){
    global $post;

// Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
        wp_create_nonce(plugin_basename(PWB3D_PLUGIN_URL)) . '" />';

    $subject = get_post_meta($post->ID, 'pwb3d_subject', true);
    $merchant = get_post_meta($post->ID, 'pwb3d_merchant', true);
    $heading = get_post_meta($post->ID, 'pwb3d_heading', true);
    $message = get_post_meta($post->ID, 'pwb3d_message', true);
    $sendreceipt = get_post_meta($post->ID, 'pwb3d_sendreceipt', true);

    if ($subject === "") {
        $subject = 'Thank you for your payment';
    }
    if ($sendreceipt == "") {
        $sendreceipt = 'yes';
    }
    if ($heading == "") {
        $heading = "We've received your payment";
    }
    if ($message == "") {
        $message = 'Your payment was received and we appreciate it.';
    }

    echo '<p>Send Email Receipt:</p>';
    echo '<select class="form-control" name="pwb3d_sendreceipt" id="parent_id" style="width:100%;">
							<option value="no" ' . pwb3d_check('no', $sendreceipt) . '>Don\'t send</option>
							<option value="yes" ' . pwb3d_check('yes', $sendreceipt) . '>Send</option>
						</select>';
    echo '<p>Email Subject:</p>';
    echo '<input type="text" name="pwb3d_subject" value="' . $subject  . '" class="widefat" />';
    echo '<p>Merchant Name on Receipt:</p>';
    echo '<input type="text" name="pwb3d_merchant" value="' . $merchant  . '" class="widefat" />';
    echo '<p>Email Heading:</p>';
    echo '<input type="text" name="pwb3d_heading" value="' . $heading  . '" class="widefat" />';
    echo '<p>Email Body/Message:</p>';
    echo '<textarea rows="6"  name="pwb3d_message"  class="widefat" >' . $message . '</textarea>';
}
