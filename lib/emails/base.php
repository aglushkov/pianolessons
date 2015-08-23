<?php
require_once DOCROOT . '/config/secrets.php';
require_once DOCROOT . '/inc/PHPMailer_5.2.1/class.phpmailer.php';

abstract class BaseEmail {
  abstract protected function constructMessage();

  protected $successMessageDefault = 'Your message has been sent. Thank you for your message.';

  public $errorMessage = "";
  public $successMessage = "";

  public function send() {
    $mail = new PHPMailer();  // create a new object
    $mail->SetFrom(NASTYA_EMAIL, $this->subject);
    $mail->Subject = $this->subject;
    $mail->Body = $this->constructMessage();
    $mail->IsHTML(true);

    $mail->AddAddress(ANDREY_EMAIL);
    $mail->AddAddress(NASTYA_EMAIL);


    // $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    // $mail->Port = 587;
    // $mail->SMTPSecure = 'tls';
    // $mail->SMTPAuth = true;
    // $mail->Username = "anvamp@gmail.com";
    // https://security.google.com/settings/security/apppasswords
    // $mail->Password = "";

    if ($mail->Send()) {
       $this->successMessage = $this->successMessageDefault;
    } else {
      $this->errorMessage = 'Mail error: ' . $mail->ErrorInfo;
    }
  }

  protected function full_html_message($message = '') {
    $message .= "</br><hr/>";
    if(!empty($_SESSION['REF'])) {
        $message .= '<b>Referer</b>: <a href="'.$_SESSION["REF"].'">'.$_SESSION["REF"].'</a><br/>';
    }
    $message .= '<b>IP Address</b>: <a href="http://www.infosniper.net/index.php?lang=1&ip_address='.$_SERVER["REMOTE_ADDR"].'">'.$_SERVER["REMOTE_ADDR"].'</a><br/>';

    return sprintf($this->layout(), $message);
  }

  protected function layout() {
    file_get_contents(DOCROOT . '/views/layouts/email.html');
  }
}

?>
