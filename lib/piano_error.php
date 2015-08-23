<?
require_once DOCROOT . '/lib/emails/error.php';

class PianoError extends Exception {
  public function __construct($message, $code=0, Exception $previous = null) {

    $error_email = new ErrorEmail($message);
    $error_email->send();

    parent::construct();
  }
}
?>