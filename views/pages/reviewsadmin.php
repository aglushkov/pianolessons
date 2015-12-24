<?
require_once DOCROOT . '/model/reviews.php';

define("NEWREVIEW","Send review");
define("APPROVE","Update &amp; Show");
define("HIDE","Hide");
define("DELETE","Delete");

$message = "";
$Reviews = new Reviews();
if (!empty($_POST)) {
  $name = trim(strip_tags($_POST["name"]));
  $mes = trim(strip_tags($_POST["message"]));

  $message = "Some Error happened";

  switch (htmlentities($_POST["submit"])) {
    case NEWREVIEW: {
        $res = $Reviews->addReview($name, $mes);
        if ($res) {
          $message = "Review succesfully added. Please know, while adinistrator not approve it, it will be hidden.";
        }
    } case APPROVE: {
      $res = $Reviews->updateAndApproveReview(trim($_POST["id"]), $name, $mes);
      if ($res) {
        $message = "Review succesfully showed.";
      }
      break;
    } case HIDE: {
      $res = $Reviews->disApproveReview(trim($_POST["id"]));
      if ($res) {
        $message = "Review succesfully hided.";
      }
      break;
    } case DELETE: {
      $res = $Reviews->deleteReview(trim($_POST["id"]));
      if ($res) {
        $message = "Review succesfully deleted.";
      }
      break;
    } default: {
      break;
    }
  }
  //echo "<script type='text/javascript'>alert('$message')</script>";
} else {
  if(!isset($_POST["name"])) {
    $name = '';
  }

  if(!isset($_POST["message"])) {
    $mes = '';
  }

  $message='';
}

$reviews = $Reviews->getAllReviews();
?>

<div id="mainimg">
  <div id="header" style="margin-top:10px;">
    <div align="justify">
      <img width="346" height="260" align="left" style="margin: 11px; border:2px solid #FFF" src="/images/black_and_white_foto_asanstasiya.jpg" alt="Black and White Foto Asanstasiya" title="Asanstasiya"/>
      <div class="bodytext">
        <fieldset>
          <legend>Add New Review</legend>
          <form method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
            <label for="name">Name</label><br/>
            <input name="name" id="name" type="text" value="<?= $name ?>"/><br/>
            <label for="message">Review</label><br/>
            <textarea name="message" id="message" cols="30" rows="6"><?= $mes ?></textarea><br/>
            <input type="hidden" name="action" value="new"/>
            <input type="submit" value="<?= NEWREVIEW?>"/>
          </form>
        </fieldset>
        <?
        foreach ($reviews as $review) {
          if ($review["approve"] === "1") {
            $visible = true;
            $vistext = "Visible";
            $visClass = "reviewVisible";
          }
          else {
            $visible = false;
            $vistext = "Hidden";
            $visClass = "reviewHidden";
          }?>
          <form method="post" action="/reviewsadmin">
            <dl class="review">
              <dt class="reviewName">
                <div>
                  <label>Name: <input name="name" style="width:300px" type="text" value="<?= $review["name"] ?>"/></label>
                </div>
                <div><label>Review:<textarea data- name="message" style="width:90%" rows="5"><?= $review["message"] ?></textarea></label></div>
              </dt>
              <dd class="reviewButtons">
                  <div class="reviewDate"><?= date("j F Y \a\\t G:i", $review["date"]) ?></div>
                  <div class="<?= $visClass ?>"><?= $vistext ?></div>
                  <input class="submit" type="submit" name="submit" value="<?= APPROVE?>">
                  <input class="submit" type="submit" name="submit" value="<?= HIDE?>">
                  <input class="submit" type="submit" name="submit" value="<?= DELETE?>">
                  <input type="hidden" name="id" value='<?= $review["id"] ?>'>
              </dd>
             </dl>
          </form>
        <?
        }?>
      </div>
    </div>
  </div>
</div>