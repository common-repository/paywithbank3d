<?php

// If this is done, we can access it later
// This example checks very early in the process:
// if the variable is set, we include our page and stop execution after it
//function pwb3d2_parse_request()
//{
//    $pwb3d_id = strip_tags( get_query_var( 'pwb3d_id' ) );
//    //var_dump($pwb3d_id);
//    //var_dump($wp);
//    if ($pwb3d_id) {
//        include plugin_dir_path(__FILE__) . '/page/pwb3d-invoice.php';
//        exit();
//    }
//}

// But WordPress has a whitelist of variables it allows, so we must put it on that list
function pwb3d_query_vars($query_vars)
{
    $query_vars[] = 'pwb3d_id';
    return $query_vars;
}



function pwb3d_parse_request( &$wp )
{
    if ( array_key_exists( 'pwb3d_id', $wp->query_vars ) ) {
        include plugin_dir_path(__FILE__) . '/page/pwb3d-invoice.php';
        //var_dump($wp->query_vars);
        //include 'my-api.php';
        exit();
    }
    return;
}