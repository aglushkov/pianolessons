<?php
require_once DOCROOT . '/lib/emails/base.php';

class ContactEmail extends BaseEmail {
    protected $subject = "Pianolessonsindublin.ie - New Message";

    public function __construct($name = '', $email = '', $message = '', $phone = '') {
        $this->user_name = $name;
        $this->user_email = $email;
        $this->user_message = $message;
        $this->user_phone = $phone;
    }

    protected function constructMessage() {
        $message = "";
        $message .= "<b>Name:</b> $this->user_name<br/>";
        $message .= "<b>Email</b>: <a href='mailto:$this->user_email'>$this->user_email</a><br/>";
        $message .= "<b>Phone</b>: $this->user_phone<br/>";

        $message .= "<b>Message</b>:</br>";
        $message .= "<pre style='font-size:14px;'>";
        $message .= $this->user_message;
        $message .= "</pre>";

        return $message;
    }

    public function isError() {
        $this->errorMessage = "";
        if (empty($this->user_name)) {
            $this->errorMessage = "Please enter your name";
        } elseif (empty($this->user_email)) {
            $this->errorMessage = "Please enter your email";
        } elseif (!$this->validEmail($this->user_email)) {
            $this->errorMessage = "Please enter valid email";
        } elseif (empty($this->user_message)) {
            $this->errorMessage = "Please enter your message";
        } elseif (empty($this->user_phone)) {
            $this->errorMessage = "Please enter your phone";
        } elseif (!$this->validPhone($this->user_phone)) {
            $this->errorMessage = "Please enter valid phone";
        }
        return (bool) $this->errorMessage;
    }

    private function validEmail($strInputValue) {
        // The allowable e-mail address format accepted by the SagePay gateway must be RFC 5321/5322 compliant (see RFC 3696)
        $sEmailRegExpPattern = '/^[a-z0-9\xC0-\xFF\!#$%&amp;\'*+\/=?^_`{|}~\*-]+(?:\.[a-z0-9\xC0-\xFF\!#$%&amp;\'*+\/=?^_`{|}~*-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2,3}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum|at|coop|travel)$/';
        return preg_match($sEmailRegExpPattern, $strInputValue);
    }

    private function validPhone($strInputValue) {
        $sEmailRegExpPattern = '/^[0-9+\(\)\.\s-]{6,}$/';
        return preg_match($sEmailRegExpPattern, $strInputValue);
    }
}
?>
