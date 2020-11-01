

<?php

//header("HTTP/1.1 200 OK");
header('Content-type: application/json');
require __DIR__ .  '/vendor/autoload.php';
   MercadoPago\SDK::setAccessToken("APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181");
   $fp = fopen("notification.log","w");
   $json = file_get_contents('php://input');

   // Converts it into a PHP object
   chmod("notification.log", 0777);
   fwrite($fp, $json);
   fclose($fp);
   switch(isset($json["type"])) {
       case "payment":
           $payment = MercadoPago\Payment.find_by_id($json["id"]);
           break;
       case "plan":
           $plan = MercadoPago\Plan.find_by_id($json["id"]);
           break;
       case "subscription":
           $plan = MercadoPago\Subscription.find_by_id($json["id"]);
           break;
       case "invoice":
           $plan = MercadoPago\Invoice.find_by_id($json["id"]);
           break;
   }

?>
