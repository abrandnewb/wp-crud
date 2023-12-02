<?php

class Crud_Uninstaller {
    public static function uninstall() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'crud_plugin_table';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    }
}