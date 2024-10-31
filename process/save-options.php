<?php

function pwb3d_save_options(){
    if(!current_user_can('edit_posts')){
        wp_die(__('You are not allowed to be on this page ', 'paywithbank3d'));
    }

    check_admin_referer('pwb3d_options_verify');

    $pwb3d_mode = sanitize_text_field($_POST['pwb3d_mode']);
    $pwb3d_mtk = sanitize_text_field($_POST['pwb3d_mtk']);
    $pwb3d_mtsi = sanitize_text_field($_POST['pwb3d_mtsi']);
    $pwb3d_mlk= sanitize_text_field($_POST['pwb3d_mlk']);
    $pwb3d_mlsi= sanitize_text_field($_POST['pwb3d_mlsi']);

    update_option('pwb3d_mode',$pwb3d_mode);
    update_option('pwb3d_mtk',$pwb3d_mtk);
    update_option('pwb3d_mtsi',$pwb3d_mtsi);
    update_option('pwb3d_mlk',$pwb3d_mlk);
    update_option('pwb3d_mlsi',$pwb3d_mlsi);

    wp_redirect(admin_url('edit.php?post_type=paywithbank3d&page=settings.php&status=1'));
}