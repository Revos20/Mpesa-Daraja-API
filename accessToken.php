<?php
//YOUR MPESA API KEYS
$consumerKey = '3KmUYvQrIJjRF6qMVDjgV58nxoRggHPX3XWkZQT0iRPNAFWl'; 
$consumerSecret = 'hZUv4PJ4QVMFu1iBe71gKTAK4GxJ9JKU2acuIzIgCJUEjGXkZ93OzP6WvWwFYCzc';

// ACCESS TOKEN URL
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

// 3. Initialize cURL
$curl = curl_init($access_token_url);
$headers = ['Content-Type: application/json; charset=utf8'];


curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret); // Only for sandbox/local testing

// 5. Execute and decode response
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result= json_decode($result) ;
$access_token = $result->access_token;
curl_close($curl);
?>