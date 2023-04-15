<?php
session_start();
require __DIR__ . '/Source/signin-process.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/Js/mainSignin.js" defer></script>
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/578abef626.js" crossorigin="anonymous"></script>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2321/2321232.png">
</head>

<body>
    <!-- Signin -->
    <div class="form-wrapper">
        <form id="form-signin" action="/Source/signin-process.php" method="POST">
            <h2>Sign In</h2>

            <div class="block-input">
                <input id="inp-email" value="<?= htmlspecialchars($_POST['email'] ?? "") ?>" type="text" name="email" placeholder="E-mail"><br>
            </div>
            <div class="block-input">
                <input id="inp-pass1" type="password" name="pass" placeholder="Password">
            </div>
            <?php
            if (isset($_SESSION['error_pass'])) {
                echo '<p id="error" >' . $_SESSION['error_pass'] . '</p>';
            }
            unset($_SESSION['error_pass']);
            ?>
            <div class="chekbox-1">
                <div class="toggle-pill-1">
                    <input type="checkbox" id="pill1" name="check">
                    <label for="pill1"></label>
                </div>
                <span id="viewPass1">View password</span>
            </div>
            <button type="submit">Log-in</button>
            <pre>You don't have an account?<a href="signup.php">Sign-up!</a></pre>
        </form>
    </div>
</body>

</html>