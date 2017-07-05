<?php

require $url . "php/config/database.php";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require $url . "php/DatabaseCreator.php";
$database = new DatabaseCreator($conn);
$users = $database->setup_users();
$pastes = $database->setup_pastes();
?>
