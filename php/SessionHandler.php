<?php

if(isset($_SESSION['username'])) {
  header("Location: " . $url . "app");
}

?>
