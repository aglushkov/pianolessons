<?php
require_once DOCROOT . '/lib/emails/base.php';

class ErrorEmail extends BaseEmail {
  protected $subject = "Pianolessonsindublin.ie - Error";

  public function __construct($message) {
    $this->error_message = $message;
  }

  protected function constructMessage() {
    $message = "";
    $message .= "<b>Message</b>:</br>";
    $message .= "<pre style='font-size:14px;'>";
    $message .= $this->error_message;
    $message .= "</pre>";

    $message .= "<b>SERVER</b>:</br>";
    $message .= "<pre style='font-size:14px;'>";
    $message .= print_r($_SERVER, true);
    $message .= "</pre>";

    return sprintf($this->layout(), $message);
  }

}
?>
