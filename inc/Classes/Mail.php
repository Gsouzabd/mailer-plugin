<?php

namespace Inc\Classes;

use Inc\Database\Db;
use PHPMailer\PHPMailer\ExceptionMP;
use PHPMailer\PHPMailer\PHPMailerMP;

class Mail{
 
    public function newOrderCustomer($customerEmail, $customerName, $cpf, $total,$adminEmail, $nameSite, $orderId){
        $db = new Db();
        $keys = $db->selectAll();
        $mail = new PHPMailerMP(true);
        //Server settings
        $mail->isSMTP();
        $mail->Host = $keys[0]->host;
        $mail->SMTPAuth = true;
        $mail->Port = intval($keys[0]->port);
        $mail->CharSet = "UTF-8";
        $mail->Username = $keys[0]->email;
        $mail->Password = $keys[0]->pass;                       //SMTP password


        try {
            $message = file_get_contents(TEMPLATE_PATH . 'new-order.php');
            $message = str_replace('%customerName%', $customerName, $message); 
            $message = str_replace('%orderId%', $orderId, $message);
            $message = str_replace('%cpf%', $cpf, $message);
            $message = str_replace('%total%', $total, $message);
            $message = str_replace('%nameSite%', $nameSite, $message); 
 
 
            //Recipients
            $mail->setFrom($keys[0]->email, $nameSite);
            $mail->addAddress($customerEmail);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Pedido confirmado - {$orderId}";
            $mail->Body    =  $mail->MsgHTML($message);
            $mail->AltBody = " Olá, {$customerName}!
                Recebemos a confirmação do seu pedido.
                Nome Completo: {$customerName}
                Pedido: #{$orderId}. 
                Valor Pago: {$total} .
                
                Até Breve!"
            ;

            $mail->send();
            echo 'Message has been sent';
        } catch (ExceptionMP $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }



    public function newOrderAdmin($customerEmail, $customerName, $cpf, $total,$adminEmail, $nameSite, $orderId){

        $db = new Db();
        $keys = $db->selectAll();
        $mail = new PHPMailerMP(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = $keys[0]->host;
        $mail->SMTPAuth = true;
        $mail->Port = intval($keys[0]->port);
        $mail->CharSet = "UTF-8";
        $mail->Username = $keys[0]->email;
        $mail->Password = $keys[0]->pass;       



        try {
            $message = file_get_contents(TEMPLATE_PATH . 'new-order-admin.php');
            $message = str_replace('%customerName%', $customerName, $message); 
            $message = str_replace('%orderId%', $orderId, $message);
            $message = str_replace('%cpf%', $cpf, $message);
            $message = str_replace('%total%', $total, $message);
            $message = str_replace('%nameSite%', $nameSite, $message); 
 
 
            //Recipients
            $mail->setFrom($keys[0]->email, "Site - {$nameSite}");
            $mail->addAddress($adminEmail);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Pedido confirmado - {$orderId}";
            $mail->Body    =  $mail->MsgHTML($message);
            $mail->AltBody = " Olá, {$nameSite}!
                Você recebeu uma nova confirmação de pedido no site.
                Cliente: {$customerName}
                Pedido: #{$orderId}. 
                Valor Pago: {$total} .
                
                Para mais informação acesse seu painel administrativo e busque pelo número do pedido.
                Até Breve!"
            ;

            $mail->send();
            echo 'Message has been sent';
        } catch (ExceptionMP $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }

    


}