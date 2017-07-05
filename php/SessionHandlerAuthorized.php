<?php
require_once $url . "php/Functions.php";
if(!isset($_SESSION['username'])) {
  performError("Please sign in to use that page.", "../index.php");
}

?>
