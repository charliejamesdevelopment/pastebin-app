<?php

class DatabaseCreator {
  var $conn;
  function __construct($conn) {
    $this->conn = $conn;
  }

  function setup_users() {
    $users = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(32),
        password VARCHAR(64)
    )";

    $users = $this->conn->prepare($users);

    if ($users) {
      /* execute query */
      $stmt_exec = $users->execute();

      if($stmt_exec) {
        return true;
      } else {
        return false;
      }
      $users->close();
    }
  }

  function setup_pastes() {
    $pastes = "CREATE TABLE IF NOT EXISTS pastes (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(32),
        paste TEXT,
        type VARCHAR(32),
        author VARCHAR(64)
    )";
    $pastes = $this->conn->prepare($pastes);
    if ($pastes) {
      $stmt_exec = $pastes->execute();
      if($stmt_exec) {
        return true;
      } else {
        return false;
      }
      $pastes->close();
    } else {
      return false;
    }
  }
}

?>
