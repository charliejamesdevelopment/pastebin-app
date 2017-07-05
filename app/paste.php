<?php
session_start();
$url = "../";
require_once "../php/Functions.php";
if(!isset($_GET["id"])) {
  performError("Invalid paste id!", $url . "app/index.php");
}
$title = "Paste#" . $_GET["id"];
require_once "../php/PasteHandler.php";
require_once "../php/DatabaseHandler.php";
require_once "../php/PasteTypes.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="<?php echo $url ?>css/highlight.min.css">
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>-->
    <link rel="stylesheet" href="<?php echo $url?>css/prism.css" />
    <script src="<?php echo $url?>css/prism.js"></script>
    <?php
    include_once "../templates/head.php";
    ?>
  </head>
  <body>
    <div class="main-wrapper">
      <div class="container">
        <?php include "../templates/navigation.php"; ?>
        <div class="content-wrapper">
          <?php

          $paste_handler = new PasteHandler($conn, $paste_types);
          $paste = $paste_handler->get_paste($_GET["id"]);
          if($paste["response"]) {
            $type = $paste["result"]["type"];
            $name = $paste["result"]["name"];
            ?>

            <div class="row">
              <div class="col-md-6">
                <?php echo "<h3 id='paste_title'>Pastebin: <span class='paste_title_name'>" . $name . "</span></h3>"; ?>
              </div>
              <div class="col-md-6">
                <?php echo "<div class='code-type-template-content ".$type."-code'>" . $type . "</div>"; ?>
              </div>
            </div>
            <?php
            echo "<pre class='line-numbers'><code class='language-".$type."'>" . htmlentities($paste["result"]["paste"]) . "</code></pre>";
          } else {
            ?>
            <div style="background:red;padding:20px;">
            Invalid paste id, please select a <b>valid paste</b>.
            </div>
            <?php
          }
?>


        </div>
        <?php include_once "../templates/footer.php" ?>
      </div>
    </div>
    <?php include_once "../templates/scripts.php" ?>
  </body>
</html>
