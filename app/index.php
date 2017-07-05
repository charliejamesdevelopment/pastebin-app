<?php
session_start();
$url = "../";
$title = "Home";
require_once "../php/SessionHandlerAuthorized.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
    include_once "../templates/head.php";
    ?>
  </head>
  <body>
    <div class="main-wrapper">
      <div class="container">
        <?php include "../templates/navigation.php"; ?>
        <div class="content-wrapper">
          <div class="rules">
            <h3>Terms and Conditions</h3>
            <p>Please use this pastebin responsibly. Any inappropriate content will be filtered and you will be banned if you submit
            anything of the sort. This is a personal pastebin so if you have access to it, use it responsibly.</p>
          </div>
          <form action="../php/CreatePaste.php" method="post">
            <?php

            require_once "../php/ErrorHandler.php";
            require_once "../php/PasteTypes.php";

            ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Paste Name</label>
                  <input type="text" name="name" id="name" placeholder="Enter paste name..." class="form-control" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Language</label>
                  <select class="form-control" name="type" style="border-bottom-radius:none;height:50px;">
                    <?php

                    foreach($paste_types as $type) {

                      $format_type = strtoupper($type);
                      echo '<option value="'.$type.'">' .$format_type.'</option>';
                    }

                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Paste</label>
              <textarea name="paste" id="paste" placeholder="Enter paste..." class="form-control" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
          </form>

        </div>
        <?php include_once "../templates/footer.php" ?>
      </div>
    </div>
    <?php include_once "../templates/scripts.php" ?>
  </body>
</html>
