<?php

session_start();
$url = "../";
require_once ($url . "php/SessionHandlerAuthorized.php");
require_once ($url . "php/Functions.php");
if(isset($_POST["name"]) && isset($_POST["paste"]) && isset($_POST["type"])) {
  require_once ($url . "php/DatabaseHandler.php");
  require_once ($url . "php/PasteHandler.php");
  require_once ($url . "php/PasteTypes.php");
  require_once ($url . "php/CensorWords.php");
  $paste_handler = new PasteHandler($conn, $paste_types);
  $censor = new CensorWords();
  $paste = array(
    "name" => $censor->censorString($_POST["name"])["clean"],
    "paste" => $censor->censorString($_POST["paste"])["clean"],
    "type" => $_POST["type"],
    "author" => $_SESSION["username"]
  );
  $validation = $paste_handler->validate_paste($paste);
  if($validation["response"]) {
    $paste = $paste_handler->escape_paste($paste);
    $exec = $paste_handler->create_paste($paste);
    if($exec["response"]) {
      performRedirect($url . "app/paste.php?id=" . $exec["id"]);
    } else {
      performError($exec["message"], $url . "app/index.php");
    }
  } else {
    performError($validation["message"], $url . "app/index.php");
  }
} else {
  performError("Please fill all fields in.", $url . "app/index.php");
}

?>
