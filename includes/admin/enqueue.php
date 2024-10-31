<?php

function pwb3d_admin_enqueue(){
    if(!isset($_GET['page']) || $_GET['page'] != 'settings.php'){
        return;
    }

    wp_register_style('pwb3d_bootstrap', plugins_url('/assets/css/bootstrap.css', PWB3D_PLUGIN_URL), [], PWB3D_VERSION);
    wp_enqueue_style('pwb3d_bootstrap');
}



