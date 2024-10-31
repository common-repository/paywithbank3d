<?php

function pwb3d_editor_add_agreement_data(){
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
        wp_create_nonce(plugin_basename(PWB3D_PLUGIN_URL)) . '" />';

    // Get the location data if its already been entered
    $useagreement = get_post_meta($post->ID, 'pwb3d_useagreement', true);
    $agreementlink = get_post_meta($post->ID, 'pwb3d_agreementlink', true);

    if ($useagreement == "") {
        $useagreement = 'no';
    }
    if ($agreementlink  == "") {
        $agreementlink = '';
    }

    // Echo out the field
    echo '<p>Use agreement checkbox:</p>';
    echo '<select class="form-control" name="pwb3d_useagreement" style="width:100%;">
					<option value="no" ' . pwb3d_check('no', $useagreement) . '>No</option>
					<option value="yes" ' . pwb3d_check('yes', $useagreement) . '>Yes</option>
			</select>';
    echo '<p>Agreement Page Link:</p>';
    echo '<input type="text" name="pwb3d_agreementlink" value="' . $agreementlink  . '" class="widefat" />';
}
