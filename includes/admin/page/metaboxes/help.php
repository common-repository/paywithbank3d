<?php

function pwb3d_editor_help_metabox($post){
    do_meta_boxes(null, 'meta-box-holder', $post);
}

function pwb3d_editor_help_data(){
echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
    wp_create_nonce(plugin_basename(PWB3D_PLUGIN_URL)) . '" />'; ?>

<div class="awesome-meta-admin">
    Email, Full Name field is added automatically, no need to include that in the textbox below.<br /><br />
    To make an input field compulsory add <code> required="required" </code> to the shortcode <br /><br />
    It should look like this <code> [text name="Full Name" required="required" ]</code><br /><br />

</div>
    <?php
}

function pwb3d_editor_help_shortcode($post){
    ?>
    <p class="description">
        <label for="wpcf7-shortcode">Copy this shortcode and paste it into your post, page, or text widget content:</label>
        <span class="shortcode wp-ui-highlight">
                            <input
                                type="text"
                                id="wpcf7-shortcode"
                                onfocus="this.select();"
                                readonly="readonly"
                                class="large-text code"
                                value="[pwb3d-payment id=&quot;<?php echo $post->ID; ?>&quot;]">
        </span>
    </p>

    <?php
}