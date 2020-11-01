<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once 'vendor/autoload.php';

    MercadoPago\SDK::setAccessToken("APP_USR-158fff95-0bdf-4149-9abc-c8b0ac7f289f");
    
    $payment = new MercadoPago\Payment();
    $payment->transaction_amount = (float)$_POST['transactionAmount'];
    $payment->token = $_POST['token'];
    $payment->description = $_POST['description'];
    $payment->installments = (int)$_POST['installments'];
    $payment->payment_method_id = $_POST['paymentMethodId'];
    $payment->issuer_id = (int)$_POST['issuer'];

 

    $payer = new MercadoPago\Payer();
    $payer->email = $_POST['email'];
    /*$payer->identification = array( 
        "type" => $_POST['docType'],
        "number" => $_POST['docNumber']
    );*/
    $payment->payer = $payer;

    $payment->save();

    var_dump($payment);
    die();

    $response = array(
        'status' => $payment->status,
        'status_detail' => $payment->status_detail,
        'id' => $payment->id
    );
    echo json_encode($response);

?>