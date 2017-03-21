<?
session_start();
error_log(-1);
define("DOCROOT", $_SERVER["DOCUMENT_ROOT"]);
require_once DOCROOT . '/config/errors.php';
require_once DOCROOT . '/initializers/referrer.php';

$title = "Piano Lessons in Dublin City";
$description = "Private Piano Lessons in Dublin for all ages and levels with professional teacher/concert pianist. Fulfill your dreams - it's never too late! Learn to play, phone today!";

if (empty($_GET["page"])) {
  $page = "index";
} else {
  $page = trim($_GET["page"]);
  $pagename = ucwords(strtr($page, "-", " "));
  $title = $pagename . ' - ' . $title;
  $description = $pagename . ' - ' . $description;
}

if ($page == 'reviewsadmin') {
  require_once DOCROOT . '/config/secrets.php';
  if (!(@$_SERVER['PHP_AUTH_USER'] == ADMIN_NAME && @$_SERVER['PHP_AUTH_PW'] == ADMIN_PASS)) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Restricted Area';
    exit;
  }
}

if (file_exists(DOCROOT . "/views/pages/$page.php")) {
  $curent_file = DOCROOT . "/views/pages/$page.php";
} elseif(file_exists(DOCROOT . "/views/pages/lessons/$page.php")) {
  $curent_file = DOCROOT . "/views/pages/lessons/$page.php";
} elseif(file_exists(DOCROOT . "/views/pages/events/$page.php")) {
  $curent_file = DOCROOT . "/views/pages/events/$page.php";
} else {
  header("HTTP/1.0 404 Not Found");
  $curent_file = DOCROOT . "/views/pages/404.php";
}

require_once DOCROOT . '/helpers/javascripts.php';
$Java = new Javascripts();

require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/navigation.php";
$Navig = new Navigation();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>"/>
    <link rel='shortcut icon' type='image/vnd.microsoft.icon' href='/favicon.ico'/>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/js/slick-1.5.9/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/js/slick-1.5.9/slick/slick-theme.css"/>
  </head>
  <body>
    <div id="container">
      <div id="wrapper">
        <div id="head">
          <div id="authorname">Anastasiya Stukalova</div>
          <div id="prof">Piano Lessons in Dublin, Ireland</div>
        </div>
        <div id="hat">
          <div id="topnav">
            <div id="navmid">
              <div id="nav">
                <? $Navig->printNavigation($page); ?>
              </div>
            </div>
          </div>
          <? include $curent_file; ?>
        </div>
      </div>
      <div id="footer">
        <span class="copyright">&copy;
          <?= date("Y"); ?>
          Anastasiya Stukalova
        </span>
        <div>
          <a href="/">Home</a>&nbsp; | &nbsp;
          <a href="/contact">Contact</a>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="/js/turbolinks.js"></script>
    <script type="text/javascript" src="/js/jquery.hoverIntent.minified.js"></script>
    <script type="text/javascript">
      <? echo file_get_contents($_SERVER["DOCUMENT_ROOT"]."/js/menu.js"); ?>
    </script>
    <? $Java->echoAll(); ?>

    <? include DOCROOT . "/views/layouts/google_analytics.html"; ?>
  </body>
</html>