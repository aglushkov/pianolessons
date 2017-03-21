<?
$Java->add("/js/contacts.js","code");

require_once DOCROOT . '/lib/emails/contact.php';

if (!empty($_POST)) {
  $name = trim(stripslashes($_POST["username"]));
  $email = trim(stripslashes($_POST["useremail"]));
  $message = trim(stripslashes($_POST["usermessage"]));
  $phone = trim(stripslashes($_POST["userphone"]));

  $Contact = new ContactEmail($name, $email, $message, $phone);

  if (!$Contact->isError()) {
    $Contact->send();
  }
} else {
  $Contact = new ContactEmail();
}
?>

<div id="mainimg">
  <img src="/images/new/piano-lessons-in-dublin-contacts.jpg" width="720" height="720" alt="Contacts" title="Contacts"/>

  <div id="header" style="margin-top:10px;">
    <a name="start"></a>
    <h1>Contact</h1>

    <div class="bodytext">
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
      <fieldset>
        <legend>Contact form</legend>
        <? if (!empty($_POST) && !empty($Contact->errorMessage))
        {
          ?><div id="contact_error"><?= $Contact->errorMessage ?></div><? }
        ?>
        <? if (!empty($_POST) && !empty($Contact->successMessage))
        {
          ?><div id="contact_success"><?= $Contact->successMessage ?></div><? }
        ?>
        <form id="contact" method="post" action="/contact#start" name="contact">
          <ul>
            <li>
              <label for="username">Name <span>*</span></label>
              <div>
                <input id="username" name="username" value="<?= $Contact->user_name ?>" size="30" type="text"/>
              </div>
            </li>
            <li>
              <label for="useremail">Email <span>*</span></label>
              <div>
                <input id="useremail" name="useremail" value="<?= $Contact->user_email ?>" size="30" type="text"/>
              </div>
            </li>
            <li>
              <label for="usermessage">Message <span>*</span></label>
              <div>
                <textarea id="usermessage" name="usermessage" cols="60" rows="10"><?= $Contact->user_message ?></textarea>
              </div>
            </li>
            <li>
              <label for="userphone">Phone <span>*</span></label>
              <div>
                <input id="userphone" name="userphone" value="<?= $Contact->user_phone ?>" size="30" type="text"/>
              </div>
            </li>
            <li id="contact_submit">
              <input value="Send email" type="submit"/>
            </li>
          </ul>
        </form>
      </fieldset>
    </div>
  </div>
</div>