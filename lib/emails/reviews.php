<?php
require_once DOCROOT . '/lib/emails/base.php';

class ReviewsEmail extends BaseEmail {
  protected $subject = "Pianolessonsindublin.ie - New Review";

  public function __construct($name = '', $message = '') {
    $this->user_name = $name;
    $this->user_message = $message;
  }

  protected function constructMessage() {
    $message = "";
    $message .= "<b>Name:</b> $this->user_name<br/>";
    $message .= "<b>Review</b>:</br>";
    $message .= "<pre style='font-size:14px;'>";
    $message .= $this->user_message;
    $message .= "</pre>";

    return $this->full_html_message($message);
  }

}
?>
