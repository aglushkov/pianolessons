<?
$Java->add("/js/contacts.js","code");

require_once DOCROOT . '/lib/emails/contact.php';
require_once DOCROOT . '/lib/recaptcha.php';

if (!empty($_POST)) {
  $name = trim(stripslashes($_POST["username"]));
  $email = trim(stripslashes($_POST["useremail"]));
  $message = trim(stripslashes($_POST["usermessage"]));
  $phone = trim(stripslashes($_POST["userphone"]));

  $Contact = new ContactEmail($name, $email, $message, $phone);

  if (!$Contact->isError()) {
    $Recaptcha = new Recaptcha();

    if ($Recaptcha->validate($_POST["g-recaptcha-response"], $_SERVER['REMOTE_ADDR'])) {
      $Contact->send();
    }
  }
} else {
  $Contact = new ContactEmail();
}
?>

<div id="mainimg">
  <div id="header" style="margin-top:10px;">
    <a name="start"></a>
    <h1>Contact</h1>
    <div class="fl-40">
      <h2>Anastasiya Stukalova</h2>
      <table>
        <tr>
          <td><b>Telephone:</b></td>
          <td>087 759 67 31</td>
        </tr>
        <tr>
          <td><b>E-mail:</b></td>
          <td>nastyast@yahoo.com</td>
        </tr>
      </table>
    </div>
    <div class="fr-60">
      <img src="/images/new/piano-lessons-in-dublin-contacts-4.jpg" width="408" height="272" alt="Contacts" title="Contacts" style="border-color: #FFF"/>
    </div>
    <div id="contact-box" class="clear">
      <? if (!empty($_POST) && !empty($Contact->errorMessage))
      {
        ?><div id="contact_error"><?= $Contact->errorMessage ?></div><? }
      ?>
      <? if (!empty($_POST) && !empty($Contact->successMessage))
      {
        ?><div id="contact_success"><?= $Contact->successMessage ?></div><? }
      ?>
      <form id="contact" method="post" action="/contact#start" name="contact">
        <label for="username">Name <span>*</span></label>
        <div>
          <input id="username" name="username" value="<?= $Contact->user_name ?>" size="30" type="text"/>
        </div>
        <label for="useremail">Email <span>*</span></label>
        <div>
          <input id="useremail" name="useremail" value="<?= $Contact->user_email ?>" size="30" type="text"/>
        </div>
        <label for="usermessage">Message <span>*</span></label>
        <div>
          <textarea id="usermessage" name="usermessage" cols="60" rows="10"><?= $Contact->user_message ?></textarea>
        </div>
        <label for="userphone">Phone <span>*</span></label>
        <div>
          <input id="userphone" name="userphone" value="<?= $Contact->user_phone ?>" size="30" type="text"/>
        </div>
        <div id="contact_submit">
           <input
              type="submit"
              class="submit g-recaptcha"
              data-sitekey="6Ld0R4wbAAAAABDFOAnfbkfOZ5MHriGFFZzisqfv"
              data-callback='onSubmitContact'
              data-action='submit'
              value="Send email"
            />
        </div>
        </ul>
      </form>
    </div>
  </div>
</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function onSubmitContact(token) {
    document.getElementById("g-recaptcha-response").value = token;
    document.getElementById("contact").submit();
  }
</script>
