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
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
    function captchaSubmit(data) {
        document.getElementById("register").submit();
    }
  </script>
</head>
  <body>
    <div class="container" id="login-container">
      <div class="login-form">
        <form id="register" action="./php/CreateAccountHandler.php" method="post">
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
              <label>Confirm Password</label>
              <input type="password" name="c_password" id="c_password" placeholder="Confirm password..." class="form-control" />
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary g-recaptcha" data-sitekey="6Lde7ycUAAAAAGnaE0ORYAkdutS7al-PRN-iUylS" data-callback="captchaSubmit">Login</button>
            </div>
            <p class="link_login">Already have an account? <a href="<?php echo $url ?>index.php">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
