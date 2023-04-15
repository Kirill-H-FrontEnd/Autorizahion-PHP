<?php

// Connect
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_errno) {
  die("connect error" . $mysqli->connect_error);
}
return $mysqli;
