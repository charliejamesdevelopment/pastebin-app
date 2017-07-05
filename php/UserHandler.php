<?php

class UserHandler {
  var $username;
  var $conn;
  function __construct($username, $conn) {
    $this->username = $username;
    $this->conn = $conn;
  }

  function validate($password, $c_password) {
    if($this->username !== "" && $password !== "" && $c_password !== "") {
      if($password !== $c_password) {
        return array(
          "response" => false,
          "message" => "Confirm password does not match password, try again."
        );
      } else {
        if(strlen($this->username) > 64) {
          return array(
            "response" => false,
            "message" => "Please keep your username to under 64 characters."
          );
        } else {
          if(strlen($password) > 64) {
            return array(
              "response" => false,
              "message" => "Please keep your password to under 64 characters."
            );
          } else {
            return array(
              "response" => true
            );
          }
        }
      }
    } else {
      return array(
        "response" => false,
        "message" => "Please enter all fields."
      );
    }
  }

  function create($password) {
    $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
    $sql = "INSERT INTO users (username, password)
            VALUES (?, ?);";
    $stmt = $this->conn->prepare($sql);

    if ($stmt) {

      $stmt->bind_param("ss", $this->username, $password);

      $stmt_exec = $stmt->execute();

      if($stmt_exec) {
        return true;
      } else {
        return false;
      }
      $stmt->close();

    } else {
      return false;
    }
  }

  function user_exists() {
    $conn = $this->conn;
    $username = $this->username;
    if ($stmt = $conn->prepare("SELECT username FROM users WHERE username=?")) {
      /* bind parameters for markers */
      $stmt->bind_param("s", $username);

      $stmt->execute();

      $stmt->bind_result($result);

      $stmt->fetch();

      if(isset($result)) {
        return array(
          "response" => true
        );
      } else {
        return array(
          "response" => false,
          "message" => "Invalid username."
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Invalid sql statement."
      );
    }
  }

  function login($password) {
    $conn = $this->conn;
    $username = $this->username;
    if ($stmt = $conn->prepare("SELECT password FROM users WHERE username=?")) {
      /* bind parameters for markers */
      $stmt->bind_param("s", $username);

      $stmt->execute();

      $stmt->bind_result($result);

      $stmt->fetch();

      if(isset($result)) {
        if(password_verify($password, $result)) {
          return array(
            "response" => true,
            "message" => "Created user! => " . $this->username
          );
        } else {
          return array(
            "response" => false,
            "message" => "Invalid password."
          );
        }
      } else {
        return array(
          "response" => false,
          "message" => "Invalid username."
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Invalid sql statement."
      );
    }
  }
}

?>
