<?php
if (empty($_POST['login'])) {
    die('erorr Login');
}
if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
    die('erorr Email');
}
if (strlen($_POST['pass']) < 8) {
    die('erorr Pass');
}
if (!preg_match("/[a-z]/i", $_POST['pass'])) {
    die('erorr Pass1');
}
if (!preg_match("/[0-9]/i", $_POST['pass'])) {
    die('erorr Pass2');
}
if ($_POST['pass'] !== $_POST['pass_confirm']) {
    die('passwoed error');
}

$pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO user (login, email, pass_hash) VALUE (?,?,?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die('SQL error' . $mysqli->error);
}

$stmt->bind_param("sss", $_POST['login'], $_POST['email'], $pass_hash);

if ($stmt->execute()) {
    header("Location:../signin.php");
} else {
    if ($mysqli->errno == 1062) {
        die("email alredy taken");
    } else {
        die($mysqli->error . "" . $mysqli->errno);
    }
}
