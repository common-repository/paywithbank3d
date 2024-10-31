<?php

function pwb3d_enqueue_scripts(){
    wp_register_script('PayWithBank3D', 'https://parkwaycdnstorage.blob.core.windows.net/bank3d/bank3d.min.js', false, '1');

    wp_register_script('blockUI', plugins_url('/assets/js/jquery.blockUI.min.js', PWB3D_PLUGIN_URL), ['jquery'], PWB3D_VERSION, true);
    wp_register_script('jQuery_UI', plugins_url('/assets/js/jquery.ui.min.js', PWB3D_PLUGIN_URL), ['jquery'], PWB3D_VERSION, true);
    wp_register_script('PayWithBank3D_Main', plugins_url('/assets/js/main.js', PWB3D_PLUGIN_URL), ['jquery'], PWB3D_VERSION, true);

    wp_localize_script('PayWithBank3D_Main', 'pwb3d_settings', [
        'key' => pwb3d_getMerchantKey(),
        'mode' => esc_attr(get_option('pwb3d_mode')),
        'ajax_url' => admin_url('admin-ajax.php')
    ], PWB3D_VERSION, true, true);

    wp_enqueue_script('PayWithBank3D');
    wp_enqueue_script('blockUI');
    wp_enqueue_script('jQuery_UI');
    wp_enqueue_script('PayWithBank3D_Main');
    wp_enqueue_style( ' add_open_sans_fonts ', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600', false );
    wp_enqueue_style( ' add_noto_sans_fonts ', 'http://fonts.googleapis.com/css?family=Noto+Sans:400,700', false );
    wp_enqueue_style('PayWithBank3DForm', plugins_url('/assets/css/pwb3d_form.css', PWB3D_PLUGIN_URL), [], PWB3D_VERSION, 'all');
    wp_enqueue_style('PayWithBank3DFont', plugins_url('/assets/css/font-awesome.min.css', PWB3D_PLUGIN_URL), [], PWB3D_VERSION, 'all');

}

function pwb3d_getMerchantKey()
{
    $mode =  esc_attr(get_option('pwb3d_mode'));
    if ($mode == 'test') {
        $key = esc_attr(get_option('pwb3d_mtk'));
    } else {
        $key = esc_attr(get_option('pwb3d_mlk'));
    }
    return $key;
}


function mw_enqueue_color_picker($hook_suffix){
    //if($hook_suffix === 'post-new.php' ){
    if(get_post_type() === 'paywithbank3d'){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'my-script-handle', plugins_url('/assets/js/color.js', PWB3D_PLUGIN_URL), ['wp-color-picker'], PWB3D_VERSION, true );
    }

    wp_enqueue_script( 'admin-global-js', plugins_url('/assets/js/admin-global.js', PWB3D_PLUGIN_URL), [], PWB3D_VERSION, true );
    wp_enqueue_style( 'admin-global-css', plugins_url('/assets/css/admin-global.css', PWB3D_PLUGIN_URL), [], PWB3D_VERSION, 'all' );
    //}

}

/**
 * force plugins to load styles with SSL if page is SSL
 */
function pwb3d_enqueueStylesHttpHttpsFix() {
    if (!is_admin()) {
        if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != "off")) {
            global $wp_styles;
            foreach ((array) $wp_styles->registered as $script) {
                if (stripos($script->src, 'http://', 0) !== false) {
                    $script->src = str_replace('http://', 'https://', $script->src);
                }
            }
        }
    }
}


function pwb3d_enqueueScriptsFix()
{
    if (!is_admin()) {
        if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != "off")) {
            global $wp_scripts;
            foreach ((array) $wp_scripts->registered as $script) {
                if (stripos($script->src, 'http://', 0) !== false) {
                    $script->src = str_replace('http://', 'https://', $script->src);
                }
            }
        }
    }
}
