<?
if (empty($_SESSION["REF"]) && !empty($_SERVER["HTTP_REFERER"])) {
  $ps = strpos($_SERVER["HTTP_REFERER"], str_replace('www.', '', $_SERVER["HTTP_HOST"]));
  if ($ps === false || $ps > 11) {
    $_SESSION["REF"] = $_SERVER["HTTP_REFERER"];
  }
}
?>