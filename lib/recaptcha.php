<?php
require_once DOCROOT . '/config/secrets.php';

class Recaptcha {
  public function validate($client_response, $remoteip) {
    $data = array(
      'secret' => GOOGLE_RECAPTCHA_SERVER_KEY,
      'response' => $client_response,
      'remoteip' => $remoteip
    );

    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    $captcha_result = json_decode($response);

    return (($captcha_result->success == true) && ($captcha_result->score > 0.5));
  }
}
?>
