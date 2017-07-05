<?php
require_once "RecaptchaHandler.php";
require_once "Functions.php";
require_once "UserHandler.php";
$url = "../";
$recaptcha = new RecaptchaHandler();
if($recaptcha) {
  require_once "DatabaseHandler.php";
  $username = $_POST["username"];
  $password = $_POST["password"];
  $c_password = $_POST["c_password"];
  $user = new UserHandler($username, $conn);
  $validation = $user->validate($password, $c_password);
  $exists = $user->user_exists();
  if($exists) {
    performError("Username already exists!", "../create_account.php");
  } else {
    if($validation["response"]) {
      if($user->create($password)) {
        performSuccess("Account created, please login!", "../index.php");
      } else {
        performError("Something went wrong while creating your account.", "../create_account.php");
      }
    } else {
      performError($validation["message"], "../create_account.php");
    }
  }
} else {
  performError("Invalid recaptcha", "../create_account.php");
}

?>
