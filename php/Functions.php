<?php

function performRedirect($url) {
  header("Location: " . $url);
}

function performError($message, $url) {
  $location = $url . "?message_type=error&message=" . urlencode($message);
  header("Location: " . $location);
}

function performSuccess($message, $url) {
  $location = $url . "?message_type=success&message=" . urlencode($message);
  header("Location: " . $location);
}

function utf8_urldecode($str) {
  return html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str)), null, 'UTF-8');
}

?>
