<?php


namespace Inc\Classes;


use Automattic\WooCommerce\Client;
use Inc\Database\Db;

class Sender{

  public function send($order_id, $urlSite, $nameSite, $adminEmail){
    
    $db = new Db;
    $keys = $db->selectAll();

    $woocommerce = new Client(
      $keys[0]->api_url,
      $keys[0]->api_ck,
      $keys[0]->api_cs,
      [
        'version' => 'wc/v3',
        'wp_api' => true,
        'timeout' => 300
      ]
    );
    
  
    $order = $woocommerce->get("orders/{$order_id}");
    $name = $order->billing->first_name . " " . $order->billing->last_name;
    $email = $order->billing->email;
    $cpf = $order->billing->cpf;
    $total = $order->total;

    $mail = new Mail;
    $mail->newOrderCustomer($email, $name, $cpf, $total, $adminEmail, $nameSite, $order_id);
    $mail->newOrderAdmin($email, $name, $cpf, $total, $adminEmail, $nameSite, $order_id);
  }

}
