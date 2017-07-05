<?php

class RecaptchaHandler {
  function __construct() {
    $secret = "6Lde7ycUAAAAACn_TbRTm35O35wDysvvLb8uNhQ8";
    $remoteip = $_SERVER["REMOTE_ADDR"];
    $url = "https://www.google.com/recaptcha/api/siteverify";

    // Form info
    $first = $_POST["first"];
    $last = $_POST["last"];
    $response = $_POST["g-recaptcha-response"];

    // Curl Request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        'secret' => $secret,
        'response' => $response,
        'remoteip' => $remoteip
        ));
    $curlData = curl_exec($curl);
    curl_close($curl);

    // Parse data
    $recaptcha = json_decode($curlData, true);
    if ($recaptcha["success"])
        return true;
    else
        return false;
  }
}

?>
