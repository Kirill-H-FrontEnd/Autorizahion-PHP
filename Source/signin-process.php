<?php
$is_invalid = false;





if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST') {
  $pass = $_POST['pass'];
  $email = $_POST['email'];

  $mysqli = require __DIR__ . "/connect.php";

  $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($email));
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  if ($user) {
    if (password_verify($pass, $user['pass_hash'])) {
      session_start();
      session_regenerate_id();
      $_SESSION["user_id"] = $user["id"];
      header("Location:../index.php");
      exit();
    } else {
      session_start();
      $_SESSION["error_pass"] = 'Wrong password!';
      header("Location:signin.php");
      exit();
    }
  }
}
$is_invalid = true;
