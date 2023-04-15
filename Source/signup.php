<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/Js/mainSignup.js" defer></script>
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/578abef626.js" crossorigin="anonymous"></script>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2321/2321232.png">
</head>

<body>
    <div class="form-wrapper">
        <!-- Signup -->
        <form id="form-signup" action="./signup-process.php" method="POST">
            <h2>Sign Up</h2>
            <div class="block-input">
                <input id="inp-login" type="text" name="login" placeholder="Login"><br>
            </div>
            <div class="block-input">
                <input id="inp-email" type="email" name="email" placeholder="Enter your e-mail"><br>
            </div>
            <div class="block-input">
                <input id="inp-pass2" type="password" name="pass" placeholder="Create password">
            </div>
            <div class="block-input">
                <input id="pass_confirm" type="password" name="pass_confirm" placeholder="Confirm password">
            </div>
            <div class="chekbox-2">
                <div class="toggle-pill-2">
                    <input type="checkbox" id="pill2" name="check">
                    <label for="pill2"></label>
                </div>
                <span id="viewPass2">View password</span>
            </div>
            <button name="button" type="submit">Create account</button>
            <pre>You have an account?<a href="signin.php">Sign-in!</a></pre>
        </form>
    </div>
</body>

</html>