<?php

function pwb3d_add_new_form_column($columns){

    $new_columns = [];
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Title', 'paywithbank3d');
    $new_columns['shortcode'] = __('Shortcode', 'paywithbank3d');
    $new_columns['payments'] = __('Payment Count', 'paywithbank3d');
    $new_columns['date'] = __('Date', 'paywithbank3d');

    return $new_columns;

}


function pwb3d_manage_form_columns($column, $post_id){
    global $post, $wpdb;
    $table = $wpdb->prefix . PWB3D_DB_TABLE;
    switch ($column){
        case 'shortcode':
            echo '<span class="shortcode">
					<input type="text" class="large-text code" value="[pwb3d-payment id=&quot;' . $post_id . '&quot;]"
					readonly="readonly" onfocus="this.select();"></span>';
            break;
        case 'payments':
            $count_query = 'select count(*) from ' . $table . ' WHERE pwb3d_id = "' . $post_id . '" AND paid = "1"';
            $num = $wpdb->get_var($count_query);

            echo '<u><a href="' . admin_url('admin.php?page=pwb3d_view_payment&form=' . $post_id) . '">' . $num . '</a></u>';
            break;
        default:
            break;
    }
}

function pwb3d_manage_form_column_option($actions, $post){
    if (get_post_type() === 'paywithbank3d') {
        unset($actions['view']);
        unset($actions['inline hide-if-no-js']);
        $actions['export'] = '<a href="' . admin_url('admin.php?page=pwb3d_view_payment&form=' . $post->ID) . '" >View Payments</a>';
    }

    return $actions;
}

