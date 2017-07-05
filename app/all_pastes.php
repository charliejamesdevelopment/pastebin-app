<?php
session_start();
$url = "../";
require_once "../php/Functions.php";
$title = "All Pastes";
require_once "../php/PasteHandler.php";
require_once "../php/DatabaseHandler.php";
require_once "../php/PasteTypes.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="<?php echo $url ?>css/highlight.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
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
            <h3>All Pastes</h3>
            <p>Here are most of your pastes... most meaning some get deleted after a certain amount of time. Others are deleted because of inappropriate content and/or invalid use.</p>
          </div>
          <?php

          require_once "../php/ErrorHandler.php";

          ?>
            <table class="table table-inverse">
              <thead>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Tools</th>
              </thead>
              <tbody>
                <?php

                $paste_handler = new PasteHandler($conn, $paste_types);
                $paste = $paste_handler->get_all_pastes_from_user($_SESSION["username"]);

                if($paste["response"]) {
                  if(count($paste["result"])) {
                    for($i = 0; $i < count($paste["result"]); $i++) {
                      $paste_data = $paste["result"][$i];
                      echo "<tr>";
                      echo "<td>" . ($i+1) . "</td>";
                      echo "<td>" . $paste_data["name"] . "</td>";
                      echo "<td><span class='code-type-template ".$paste_data["type"]."-code'>" . strtoupper($paste_data["type"]) . "</span></td>";
                      echo "<td><a class='btn btn-success' href='" . $url . "app/paste.php?id=" . $paste_data["id"] . "'>View</a>" .
                      "<a class='btn btn-danger' href='" . $url . "php/DeletePaste.php?id=" . $paste_data["id"] . "'>Delete</a></td>";
                      echo "<tr>";
                    }
                  } else {
                    echo "<tr>";
                    echo "<td>No pastes avaliable. <a class='link' href='" . $url . "app/index.php'>Create a Paste!</a></td>";
                    echo "</tr>";
                  }
                }

                ?>
              </tbody>
            </table>
          </div>
          <?php include_once "../templates/footer.php" ?>
        </div>
      </div>
    </div>
    <?php include_once "../templates/scripts.php" ?>
  </body>
</html>
