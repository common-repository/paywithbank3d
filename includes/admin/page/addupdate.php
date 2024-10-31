<?php


function pwb3d_editor_add_extra_metaboxes(){
        include('metaboxes/emailData.php');
        include('metaboxes/formData.php');
        include('metaboxes/agreement.php');
        include('metaboxes/help.php');

        add_action('edit_form_after_title', 'pwb3d_editor_help_metabox');
        if (isset($_GET['action']) == 'edit') {
            add_meta_box('pwb3d_editor_help_shortcode', __('Paste shortcode on preferred page', 'paywithbank3d'), 'pwb3d_editor_help_shortcode', 'paywithbank3d', 'meta-box-holder');
        }
        add_meta_box('pwb3d_editor_help_data', __('Note', 'paywithbank3d'), 'pwb3d_editor_help_data', 'paywithbank3d', 'meta-box-holder');
        add_meta_box('pwb3d_editor_add_form_data', __('Form Settings', 'paywithbank3d'), 'pwb3d_editor_add_form_data', 'paywithbank3d', 'normal', 'default');
        add_meta_box('pwb3d_editor_add_email_data', __('Email Receipt Settings', 'paywithbank3d'), 'pwb3d_editor_add_email_data', 'paywithbank3d', 'normal', 'default');
        add_meta_box('pwb3d_editor_add_agreement_data', 'Agreement checkbox', 'pwb3d_editor_add_agreement_data', 'paywithbank3d', 'side', 'default');
        add_meta_box('pwb3d_editor_add_color_data', 'Color', 'pwb3d_editor_add_color_data', 'paywithbank3d', 'side', 'default');

}



