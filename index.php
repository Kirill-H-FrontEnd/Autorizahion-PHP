<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/Source/connect.php";

    $sql = "SELECT * FROM user WHERE id ={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/Styles/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php if (isset($user)) : ?>
        <p>Hello <?= htmlspecialchars($user['login']) ?></p>
        <a href="/Source/logout.php">Logout</a>
    <?php else : ?>
        <div class="home">
            <h1>Welcome!</h1>
            <p>Your have an account? <a href="/Source/signin.php">SignIn</a></p>
            <p>You don't have an account? <a href="/Source/signup.php">SignUp</a></p>
        </div>
    <?php endif; ?>
</body>

</html>