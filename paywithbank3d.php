<?php
/**
 * Plugin Name: PayWithBank3D
 * Plugin URI: https://paywithbank3d.com
 * Description: Accept Payment With PayWithBank3D On Your Wordpress Page Or Post
 * Version: 1.0.0
 * Author: Edward Paul
 * Author URI: https://medium.com/@infinitypaul
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: paywithbank3d
 * Domain Path: /lang
 */

if(!function_exists('add_action')){
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define('PWB3D_DB_TABLE', 'pwb3d_forms_payments');
define('PWB3D_PLUGIN_URL', __FILE__);
define('PWB3D_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('PWB3D_PLUGIN_NAME', 'paywithbank3d');
define('PWB3D_VERSION', '1.0.0');

//Setup



//Includes
include('includes/activate.php');
include('includes/deactivate.php');
include('includes/init.php');
include('includes/notice.php');
include('includes/textdomain.php');

include('includes/front/enqueue.php');
include('includes/front/request.php');
include('process/emails/invoice.php');
include('process/emails/receipts.php');

include('includes/admin/init.php');
include('includes/admin/tinymce/init.php');
include('includes/admin/settings.php');
include('includes/admin/view_payment.php');


include('includes/shortcode/generate.php');

include('process/emails/config.php');

include('process/save-post.php');
include('process/save-options.php');
include('process/verify_payment.php');
include('process/paymentTable.php');




//Hooks
register_activation_hook(__FILE__, 'pwb3d_activate_plugin');
register_deactivation_hook(__FILE__, 'pwb3d_deactivate_plugin');
add_action('init', 'paywithbank3d_init');
add_action('init', 'pwb3d_setup_tinymce');
add_action( 'init', 'pwb3d_init_internal' );


add_filter( 'query_vars', 'pwb3d_query_vars' );
add_action( 'parse_request', 'pwb3d_parse_request' );

add_action('save_post_paywithbank3d', 'pwb3d_save_post_admin', 1, 2);
add_action('wp_enqueue_scripts', 'pwb3d_enqueue_scripts', 100);

add_action('admin_post_pwb3d_save_options', 'pwb3d_save_options');

add_action('admin_init', 'pwb3d_admin_init');
add_action('admin_menu', 'pwb3d_add_settings_page');
add_action('admin_menu', 'pwb3d_register_newpage');
add_action('admin_notices', 'pwb3d_admin_notice');
add_action('admin_enqueue_scripts', 'mw_enqueue_color_picker' );

add_action('activated_plugin', 'pwb3d_plugin_save_error');

add_action('wp_ajax_pwb3d_submit_action', 'pwb3d_submit_action');
add_action('wp_ajax_nopriv_pwb3d_submit_action', 'pwb3d_submit_action');
add_action('wp_ajax_pwb3d_verify_payment', 'pwb3d_verify_payment');
add_action('wp_ajax_nopriv_pwb3d_verify_payment', 'pwb3d_verify_payment');



add_action('wp_print_scripts', 'pwb3d_enqueueScriptsFix', 100);
add_action('wp_print_styles', 'pwb3d_enqueueStylesHttpHttpsFix', 100);


add_action( 'b3d_send_invoice', 'pwb3d_send_invoice', 10, 5 );
add_action( 'b3d_send_receipts_owner', 'pwb3d_send_receipts_owner', 10, 7 );
add_action( 'b3d_send_receipts', 'pwb3d_send_receipts', 10, 8 );

add_filter("wp_mail_content_type", "pwb3d_mail_content_type");
add_filter("wp_mail_from_name", "pwb3d_mail_from_name");

add_filter('plugin_action_links_paywithbank3d/paywithbank3d.php', 'pwb3d_action_links', 10, 2);



//ShortCodes
add_shortcode('pwb3d-payment', 'pwb3d_generate_form');


