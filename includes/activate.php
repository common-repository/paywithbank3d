<?php

function pwb3d_activate_plugin(){
    if(version_compare(get_bloginfo('version'), '5.0', '<')){
        wp_die(__("You Must Update Wordpress To Use This Plugin", 'paywithbank3d'));
    }
    paywithbank3d_init();
    flush_rewrite_rules();

    global $wpdb;
    $table_name = $wpdb->prefix . PWB3D_DB_TABLE;
    $charset_collate = $wpdb->get_charset_collate();

    $createSql = "
    CREATE TABLE IF NOT EXISTS `" . $table_name . "` (
            ID BIGINT(20) NOT NULL AUTO_INCREMENT,
			pwb3d_id int(11) NOT NULL,
		  	user_id int(11) NOT NULL,
			email varchar(255) DEFAULT '' NOT NULL,
		  	metadata text,
		  	txn_code varchar(255) DEFAULT '' NOT NULL,
		  	paid int(1) NOT NULL DEFAULT '0',
			amount varchar(255) DEFAULT '' NOT NULL,
		  	ip varchar(255) NOT NULL, 
			deleted_at varchar(255) DEFAULT '' NULL,
			created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	modified timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  	UNIQUE KEY id (ID),
		  	PRIMARY KEY  (ID)
    ) ENGINE=InnoDB ".$charset_collate.";";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($createSql);
}

function pwb3d_plugin_save_error()
{
    update_option('pwb3d_plugin_error',  ob_get_contents());
}

/* Then to display the error message: */
echo get_option('pwb3d_plugin_error');
