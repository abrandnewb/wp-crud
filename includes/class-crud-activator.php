<?php

class Crud_Activator {
    public static function activate() {
        global $wpdb;
        $table_name = $wpdb->prefix.'crud_plugin_table';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        age int(2) NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}