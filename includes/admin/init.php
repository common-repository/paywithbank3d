<?php

function pwb3d_admin_init(){
    include('columns.php');
    include('excel.php');
    include ('page/addupdate.php');
    include ('enqueue.php');
    include ('page/editor/wysiwyg.php');

    add_filter('manage_paywithbank3d_posts_columns', 'pwb3d_add_new_form_column');

    add_action('manage_paywithbank3d_posts_custom_column', 'pwb3d_manage_form_columns', 10, 2);
    add_action('admin_post_pwb3d_export_to_excel', 'pwb3d_export_to_excel');
    add_action('admin_enqueue_scripts', 'pwb3d_admin_enqueue');

    add_filter('page_row_actions', 'pwb3d_manage_form_column_option', 10, 2);
    add_filter('user_can_richedit', 'pwb3d_disable_wyswyg');

    add_action('add_meta_boxes', 'pwb3d_editor_add_extra_metaboxes');

    register_setting('pwb3d-settings-group', 'pwb3d_mode');
    register_setting('pwb3d-settings-group', 'pwb3d_mtk');
    register_setting('pwb3d-settings-group', 'pwb3d_mlk');
    register_setting('pwb3d-settings-group', 'pwb3d_mlsi');
    register_setting('pwb3d-settings-group', 'pwb3d_mtsi');

}
