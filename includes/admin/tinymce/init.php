<?php

function pwb3d_setup_tinymce(){
    // Check if the logged in WordPress User can edit Posts or Pages
    // If not, don't register our TinyMCE plugin
    if (! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
        return;
    }

    // Check if the logged in WordPress User has the Visual Editor enabled
    // If not, don't register our TinyMCE plugin
    if (get_user_option('rich_editing') !== 'true' ) {
        return;
    }
    //var_dump(plugin_dir_url(__FILE__) . 'tinymce-custom-class.js');
    //die(plugins_url('/assets/js/tinymce-custom-class.js', PWB3D_PLUGIN_URL));
    // Setup some filters
    add_filter('mce_external_plugins', 'pwb3d_add_tinymce_plugin');
    add_filter('mce_buttons', 'pwb3d_add_tinymce_toolbar_button');
}


function pwb3d_add_tinymce_plugin( $plugin_array )
{

    //var_dump($plugin_array);

    $plugin_array['custom_class'] = plugins_url('/assets/js/tinymce-custom-class.js', PWB3D_PLUGIN_URL);
    return $plugin_array;

}


function pwb3d_add_tinymce_toolbar_button( $buttons )
{

    array_push($buttons, 'custom_class');
    return $buttons;

}