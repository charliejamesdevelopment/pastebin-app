<?php

session_start();
$url = "../";
require_once ($url . "php/SessionHandler.php");
require_once ($url . "php/Functions.php");

if(isset($_POST["username"]) && isset($_POST["password"])) {
  if($_POST["username"] != "" && $_POST["password"] != "") {
    require_once "DatabaseHandler.php";
    require_once "UserHandler.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new UserHandler($username, $conn);
    $login = $user->login($password);
    if($login["response"]) {
      $_SESSION["username"] = $username;
      performRedirect("../app");
    } else {
      performError($login["message"], "../index.php");
    }
  } else {
    performError("Please enter a username & password.", "../index.php");
  }
} else {
  performError("Please enter a username & password.", "../index.php");
}


?>
