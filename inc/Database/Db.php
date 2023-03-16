<?php

namespace Inc\Database;


class Db{



    public function selectAll(){
            global $wpdb;
            $max_id = $wpdb->get_var( 'SELECT MAX(id) FROM ' . $wpdb->prefix . 'mailer_plugin' );
            $result = $wpdb->get_results( "SELECT * FROM  wp_mailer_plugin WHERE id =  '". $max_id ."'");

            return $result;
        }


    public function insert($api_url, $api_ck, $api_cs, $host, $port, $email, $password){
        global $wpdb;
        $tablename = 'wp_mailer_plugin';
        $sql = $wpdb->prepare(
            "INSERT INTO $tablename (`api_url`, `api_ck`, `api_cs`, `host`, `port`, `email`, `pass`) values (%s, %s,%s, %s, %s,%s, %s)", $api_url, $api_ck, $api_cs, $host, $port, $email, $password
        );
        
        $wpdb->query($sql);
        
        if($wpdb->last_error){
            echo $wpdb->last_error;
        }      
    }
}