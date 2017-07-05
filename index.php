<?php
session_start();
$url = "./";
$title = "Login";
require "./php/SessionHandler.php";
?>
<!DOCTYPE html>
<html>
<head>
  <?php
  include_once "./templates/head.php";
  ?>
</head>
  <body>
    <div class="container" id="login-container">
      <div class="login-form">
        <form action="./php/LoginHandler.php" method="post">
          <div class="form-header">
            <img src="https://charliejames.me/images/logo_purple.png" alt="Logo" />
            <h1>PASTEBIN</h1>
          </div>
          <div class="form-content">
            <?php

            require_once "./php/ErrorHandler.php";

            ?>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" id="username" placeholder="Enter username..." class="form-control" />
            </div>

            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" id="Password" placeholder="Enter password..." class="form-control" />
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <p class="link_login">Don't have an account? <a href="<?php echo $url ?>create_account.php">Register</a></p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
