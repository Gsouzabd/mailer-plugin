<?php

namespace Inc\Database;

class KeysTable{
    public static function create_mp_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . "mailer_plugin";
        $charset_collate = $wpdb->get_charset_collate();
        
        //Table definition
        $sql =  "CREATE TABLE $table_name (
        id int(10) unsigned NOT NULL AUTO_INCREMENT,
        api_url varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        api_ck varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        api_cs varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        host varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        port varchar(5) COLLATE utf8_unicode_ci NOT NULL,
        email varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        pass varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 
        PRIMARY KEY  (id)
        ) $charset_collate;";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
        $res = dbDelta($sql);
        
    }


}