<?php
$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$pass_conf = $_POST['pass_confirm'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (empty($login)) {
    die('erorr Login');
}
if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
    die('erorr Email');
}
if (strlen($pass) < 8) {
    die('erorr Pass');
}
if (!preg_match("/[a-z]/i", $pass)) {
    die('erorr Pass1');
}
if (!preg_match("/[0-9]/i", $pass)) {
    die('erorr Pass2');
}
if ($pass !== $pass_conf) {
    die('passwoed error');
}

$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO user (login, email, pass_hash) VALUE (?,?,?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die('SQL error' . $mysqli->error);
}

$stmt->bind_param("sss",  $login,  $email, $pass_hash);

if ($stmt->execute()) {
    // Send e-mail START
    require "./PHPMailer-master/src/PHPMailer.php";
    require "./PHPMailer-master/src/SMTP.php";
    require "./PHPMailer-master/src/Exception.php";

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Your email';
        $mail->Password   = 'yrqbphtxqqktghpo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Recipients
        $mail->setFrom($mail->Username, 'PHP');
        $mail->addAddress($email);
        $mail->addReplyTo($mail->Username);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('');


        // Body vars
        $title = "PHP";
        $body .= "<h1 style='color: #3337FF;font-size: 30px'><strong>PHP </strong>$login!</h1>";
        $body .= "<p><strong>Your email: </strong>$email</p>";
        $body .= "<p><strong>Your password: </strong>$pass</p>";

        //Content
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $body;
        $mail->AltBody = '11111';

        //Custom connection options
        //Note that these settings are INSECURE
        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => false,
                'verify_depth' => 3,
                'allow_self_signed' => true,
                'peer_name' => 'smtp.gmail.com',
                'cafile' => '/etc/ssl/ca_cert.pem',
            ],
        );
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location:./signUp-Successful.php");
} else {
    if ($mysqli->errno == 1062) {
        die("email alredy taken");
    } else {
        die($mysqli->error . "" . $mysqli->errno);
    }
}
