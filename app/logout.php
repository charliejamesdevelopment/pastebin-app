<?php
session_start();
$url = "../";
require_once "../php/SessionHandlerAuthorized.php";
session_destroy();
header("Location: ../index.php");

?>
