<?php
header("Content-Type:application/json");
$stkCallbackResponse=file_get_contents('php://input');
$logFile="Mpesastkresponse.json";
$log=fopen($logFile,"a");
fwrite($log,$stkCallbackResponse);
fclose($log);

$data=json_decode($stkCallbackResponse);

$MerchantRequestID=$data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID=$data->Body->stkCallback->CheckoutRequestID;
$ResultCode=$data->Body->stkCallback->ResultCode;
$ResultDesc=$data->Body->stkCallback->ResultDesc;
$Amount= $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionId=$data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$PhoneNumber=$data->Body->stkCallback->CallbackMetadata->Item[4]->Value;

//CONNECT TO DATABASE
$host = "localhost";
$user = "bentecso_revos20";
$pass = "Eduzeerevos@20"; // Double check if your hosting provided a password!
$dbname = "bentecso_ticketing_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}