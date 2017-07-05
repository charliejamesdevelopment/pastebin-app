<?php

session_start();
$url = "../";
require_once ($url . "php/SessionHandlerAuthorized.php");
require_once ($url . "php/Functions.php");
if(isset($_GET["id"])) {
  require_once ($url . "php/DatabaseHandler.php");
  require_once ($url . "php/PasteTypes.php");
  require_once ($url . "php/PasteHandler.php");
  $paste = new PasteHandler($conn, $paste_types);
  $verify = $paste->verify_paste($_GET["id"]);
  if(!$verify["response"]) {
    performError("Please specify a correct id!", "../app/all_pastes.php");
  } else {
    $res = $verify["result"];
    //var_dump($res);
    if($res["author"] === $_SESSION["username"]) {
      $delete = $paste->delete_paste($res["id"]);
      if($delete["response"]) {
        performSuccess("Paste has been deleted.", "../app/all_pastes.php");
      } else {
        performError($delete["message"], "../app/all_pastes.php");
      }
    } else {
      performError("You do not own this paste, please don't try to delete it.", "../app/all_pastes.php");
    }
  }
} else {
  performError("Please specify a correct id!", "../app/all_pastes.php");
}

?>
