<?php

use Inc\Database\Db;

$db = new Db();
$keys = $db->selectAll();

if(array_key_exists('submit', $_POST)){
   
    if($_POST['api_url'] != null && $_POST['api_ck'] != null && $_POST['api_cs'] != null 
    && $_POST['host'] != null && $_POST['email'] != null && $_POST['port'] != null &&
    $_POST['password'] != null){
        $tablename = 'wp_mailer_plugin';
        $api_url = $_POST['api_url'];
        $api_ck = $_POST['api_ck'];
        $api_cs = $_POST['api_cs']; 
        $host = $_POST['host'];
        $port = $_POST['port'];
        $email = $_POST['email']; 
        $password = $_POST['password']; 

        $db->insert($api_url,$api_ck,$api_cs,$host,$port,$email,$password);
 
        
        echo "<div class='notice notice-success is-dismissible'> 
        <p><strong>Keys sucessfully saved!</strong></p>
            <button type='button' class='notice-dismiss'>
                <span class='screen-reader-text'>Fechar</span>
            </button>
        </div>";
        
    }else{
        echo "<div class='notice notice-error is-dismissible'> 
        <p><strong>Fill in the fields! Empty values are not accepted.</strong></p>
            <button type='button' class='notice-dismiss'>
                <span class='screen-reader-text'>Fechar</span>
            </button>
        </div>";
    }
}


?>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="wrap">
    <form method="post">
        <h3>Api Keys - Woocommerce</h3>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Api URL</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="api_url" aria-describedby="emailHelp" placeholder="<?=$keys[0]->api_url;?>">
            <small id="emailHelp" class="form-text text-muted">generate your keys in woocommerce->settings->Advanced.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Api CK</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="api_ck" aria-describedby="emailHelp" placeholder="<?=$keys[0]->api_ck;?>">
            <small id="emailHelp" class="form-text text-muted">generate your keys in woocommerce->settings->Advanced.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Api CS</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="api_cs" aria-describedby="emailHelp" placeholder="<?=$keys[0]->api_cs;?>">
            <small id="emailHelp" class="form-text text-muted">generate your keys in woocommerce->settings->Advanced.</small>
        </div>
        </br>
        <hr>
        </br>
        <h3>SMTP - Mail Configuration</h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Mail Host</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="host" aria-describedby="emailHelp" placeholder="<?=$keys[0]->host;?>">
            <small id="emailHelp" class="form-text text-muted">be sure your mail host is correct.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Port</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="port" aria-describedby="emailHelp" placeholder="<?=$keys[0]->port;?>">
            <small id="emailHelp" class="form-text text-muted">be sure your mail port exist.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="<?=$keys[0]->email;?>">
            <small id="emailHelp" class="form-text text-muted">enter your e-mail.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" name="password" aria-describedby="emailHelp" placeholder="*******">
            <small id="emailHelp" class="form-text text-muted">enter your e-mail password.</small>
        </div>
 


        <input type="submit" name="submit" value="Submit">
    </form>

    <img src="<?=MP_URL . 'assets/mail.png'?>" style="width: 200px; margin: 5%">
    Desenvolvido por <a href='https://mlovi.com.br/'>Mlovi - Desenvolvimento e Soluções Web</a>.
</div>
</body>