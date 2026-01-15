<?php
//INCLUDE ACCESS TOKEN FILE
include 'accessToken.php';
date_default_timezone_set("Africa/Nairobi");
$processrequestUrl="https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$callbackUrl="https://www.bluehost.com/darajaapp/callback.php";
$passkey= "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BussinessShortCode= "174379";
$Timstamp = date('YmdHis');
//ENCRIPTING DATA TO GET PASSWORD 
$password= base64_encode($BussinessShortCode.$passkey.$Timstamp);
$phone="254116609873";
$money="1";
$PartyA=$phone;
$PartyB='0116609873';
$AccountReference="UMESKIA SOFWARES";
$TransactionDesc="stk push test";
$Amount=$money;
$stkpushheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];    
// initiating the curl request
$curl=curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader);
$curl_post_data=array(
  'BusinessShortCode'=>$BussinessShortCode,
  'Password'=>$password,
  'Timestamp'=>$Timstamp,
  'TransactionType'=>'CustomerPayBillOnline',
  'Amount'=>$Amount,
  'PartyA'=>$PartyA,
  'PartyB'=>$BussinessShortCode,
  'PhoneNumber'=>$PartyA,
  'CallBackURL'=>$callbackUrl,
  'AccountReference'=>$AccountReference,
  'TransactionDesc'=>$TransactionDesc
); 
$data_string=json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response=curl_exec($curl);
//ECHO THE RESPONSE
echo $curl_response;



?>