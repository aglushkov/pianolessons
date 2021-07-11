<?
require_once DOCROOT . '/model/reviews.php';
require_once DOCROOT . '/inc/PHPMailer_5.2.25/PHPMailerAutoload.php';
require_once DOCROOT . '/lib/emails/reviews.php';
require_once DOCROOT . '/lib/recaptcha.php';

$Reviews = new Reviews();

if(!empty($_POST)) {
  $Recaptcha = new Recaptcha();
  if ($Recaptcha->validate($_POST["g-recaptcha-response"], $_SERVER['REMOTE_ADDR'])) {
    $name = trim(strip_tags($_POST["name"]));
    $message = trim(strip_tags($_POST["message"]));
    switch ($_POST["action"]) {
      case "new": {
        $res = $Reviews->addReview(trim($name), trim($message));

        if ($res) {
          $success_message = "<div style='background-color:greenyellow'>Rewiew succesfully added. Please note, it will remain hidden until approved by administrator.</div>";

          $Email = new ReviewsEmail(trim($name), trim($message));
          if (!empty($_POST)) {
            $Email->send();
          }
        } else {
          $success_message = "<div style='background-color:pink'>Some Error Happened. Review was not added.</div>";
        }
      }
    }
  }
  $postname = $_POST["name"];
  $postmessage = $_POST["message"];
} else {
  if(!isset($_POST["name"])) {
     $postname = '';
   }

  if(!isset($_POST["message"])) {
    $postmessage = '';
  }

  $success_message='';
}

$reviews = $Reviews->getApprovedReviews();
?>

<div id="mainimg">
  <div id="header" style="margin-top:10px;">
    <div align="justify">
      <img width="346" height="260" align="left" style="margin: 11px; border:2px solid #FFF" src="/images/black_and_white_foto_asanstasiya.jpg" alt="Black and White Foto Asanstasiya" title="Asanstasiya"/>
      <div class="bodytext">
        <fieldset style="margin-top:5px;">
          <legend>Add New Review</legend>
           <form method="post" id="testimonial" action="<?= $_SERVER["REQUEST_URI"]?>">
            <label for="name">Name</label><br/>
            <input name="name" id="name" type="text" value="<?= $postname?>"/><br/>
            <label for="message">Review</label><br/>
            <textarea name="message" id="message" cols="30" rows="6"><?=$postmessage;?></textarea><br/>
            <input type="hidden" name="action" value="new"/>
            <input
              type="submit"
              class="submit g-recaptcha"
              data-sitekey="<?= GOOGLE_RECAPTCHA_SITE_KEY; ?>"
              data-callback="onSubmitReview"
              data-action="submit"
              value="Send review"
            />
          </form>
          <?= $success_message?>
        </fieldset>
        <table id="reviews">
          <caption class="h1"><h1>Reviews</h1></caption>
          <?
          foreach ($reviews as $review) {
             ?><tr><?
             ?><td class="reviewName"><?= $review["name"]?></td><td class="reviewDate"><?= date("j F Y \a\\t G:i",$review["date"])?></td><?
             ?></tr><?
             ?><tr><?
             ?><td class="reviewMessage" colspan="2"><div><?= str_replace("\n", "<br/>", $review["message"]);?></div></td><?
             ?></tr><?
          }?>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function onSubmitReview(token) {
    document.getElementById("g-recaptcha-response").value = token;
    document.getElementById("testimonial").submit();
  }
</script>
