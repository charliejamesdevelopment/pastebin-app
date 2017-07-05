<?php

class PasteHandler {
  var $conn;
  var $paste_types;
  function __construct($conn, $paste_types) {
    $this->conn = $conn;
    $this->paste_types = $paste_types;
  }

  function get_all_pastes_from_user($username) {
    $conn = $this->conn;
    if ($stmt = $conn->prepare("SELECT id, name, paste, type, author FROM pastes WHERE author=?")) {

      $stmt->bind_param("s", $username);

      /* execute query */
      $stmt_exec = $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($id, $name, $paste, $type, $author);

      $result = array();
      while ($stmt->fetch()) {
        $paste = array(
          "id" => $id,
          "name" => $name,
          "paste" => $paste,
          "type" => $type,
          "author" => $author
        );
        array_push($result, $paste);
      }

      if($stmt_exec) {
        return array(
          "response" => true,
          "result" => $result
        );
      } else {
        return array(
          "response" => false,
          "message" => "Something went wrong!"
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Something went wrong!"
      );
    }
  }

  function get_all_pastes() {
    $conn = $this->conn;
    if ($stmt = $conn->prepare("SELECT id, name, paste, type FROM pastes")) {

      /* execute query */
      $stmt_exec = $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($id, $name, $paste, $type);

      $result = array();
      while ($stmt->fetch()) {
        $paste = array(
          "id" => $id,
          "name" => $name,
          "paste" => $paste,
          "type" => $type,
        );
        array_push($result, $paste);
      }

      if($stmt_exec) {
        return array(
          "response" => true,
          "result" => $result
        );
      } else {
        return array(
          "response" => false,
          "message" => "Something went wrong!"
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Something went wrong!"
      );
    }
  }

  function escape_paste($paste) {
    return array(
      "name" => $paste["name"],
      "type" => $paste["type"],
      "paste" => $paste["paste"],
      "author" => $paste["author"]
    );
  }

  function validate_paste($paste) {
    $name = $paste["name"];
    $type = $paste["type"];
    $paste = $paste["paste"];
    if($name !== "" && $type !== "" && $paste !== "") {
      if(strlen($name) > 32) {
        return array(
          "response" => false,
          "message" => "Please enter a title less than 32 characters long."
        );
      } else {
        if(in_array($type, $this->paste_types)) {
          return array(
            "response" => true,
            "message" => "Success!"
          );
        } else {
          return array(
            "response" => false,
            "message" => "Invalid paste type."
          );
        }
      }
    } else {
      return array(
        "response" => false,
        "message" => "Please fill in all fields!"
      );
    }
  }

  function create_paste($paste) {
    $conn = $this->conn;
    if ($stmt = $conn->prepare("INSERT INTO pastes (name, paste, type, author) VALUES (?, ?, ?, ?)")) {
      /* bind parameters for markers */
      $stmt->bind_param("ssss", $paste["name"], $paste["paste"], $paste["type"], $paste["author"]);

      if($stmt->execute()) {
        return array(
          "response" => true,
          "id" => $conn->insert_id,
          "message" => "Created paste"
        );
      } else {
        var_dump($paste["author"]);
        return array(
          "response" => false,
          "message" => "Something went wrong!"
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

  function delete_paste($id) {
    $conn = $this->conn;
    if ($stmt = $conn->prepare("DELETE FROM pastes WHERE id=?")) {
      /* bind parameters for markers */
      $stmt->bind_param("i", $id);

      if($stmt->execute()) {
        return array(
          "response" => true,
          "message" => "Deleted paste " . $id
        );
      } else {
        return array(
          "response" => false,
          "message" => "Something went wrong!"
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Something went wrong!"
      );
    }
  }

  function verify_paste($id) {
    $conn = $this->conn;
    if ($stmt = $conn->prepare("SELECT id, author FROM pastes WHERE id=?")) {
      /* bind parameters for markers */
      $stmt->bind_param("i", $id);

      /* execute query */
      $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($id, $author);

      /* fetch value */
      $stmt->fetch();

      if(isset($id)) {
        return array(
          "response" => true,
          "result" => array(
            "id" => $id,
            "author" => $author
          )
        );
      } else {
        return array(
          "response" => false,
          "message" => "Invalid paste id."
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Something went wrong!"
      );
    }
  }

  function get_paste($id) {
    $conn = $this->conn;
    if ($stmt = $conn->prepare("SELECT * FROM pastes WHERE id=?")) {
      /* bind parameters for markers */
      $stmt->bind_param("i", $id);

      /* execute query */
      $stmt->execute();

      /* bind result variables */
      $stmt->bind_result($id, $name, $paste, $type, $author);

      /* fetch value */
      $stmt->fetch();

      if(isset($id)) {
        return array(
          "response" => true,
          "result" => array(
            "name" => $name,
            "paste" => $paste,
            "type" => $type
          )
        );
      } else {
        return array(
          "response" => false,
          "message" => "Invalid paste id."
        );
      }

      /* close statement */
      $stmt->close();
    } else {
      return array(
        "response" => false,
        "message" => "Something went wrong!"
      );
    }
  }
}

?>
