<?php

if(isset($_GET['message_type']) && isset($_GET['message'])) {
  echo "<div class='" . htmlentities($_GET['message_type']) . "'>" . htmlentities($_GET['message']) . "</div>";
}

?>
