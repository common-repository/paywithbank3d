<?php

function pwb3d_dashboard_widget(){
    wp_add_dashboard_widget(
        'pwb3d_form_stat_widget',
        'PayWithBank3D Stats',
        'pwb3d_stats_display',
        null

    );
}

function pwb3d_stats_display(){
    global $wpdb;
    $table = $wpdb->prefix . PWB3D_DB_TABLE;
    $MonthlySales = $wpdb->get_results(
        "SELECT MONTHNAME(created_at) as month_tag, SUM(amount) as amount FROM`".$table."` WHERE paid=1 GROUP BY YEAR(created_at), MONTH(created_at) ORDER BY created_at DESC LIMIT 1"
    );
    echo "<ul class='wc_status_list'>";
        echo "<li class='sales-this-month'> <strong> <span class='woocommerce-Price-amount amount'> <span class='woocommerce-Price-currencySymbol'>₦ </span>".number_format($MonthlySales[0]->amount)."</span></strong>  net sales this month	</li>";
    echo "</ul>";
}