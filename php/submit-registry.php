<?php

//MySQL Login Info
$servername = "localhost";
$username = "root";
$password = "pass";
$dbname = "cardkeeper";

$conn = new mysqli($servername, $username, $password, $dbname);

//get form data
$firstName = sanitize($_POST["first-name"]);
$lastName = sanitize($_POST["last-name"]);
$email = sanitize($_POST["email"]);
$password = sanitize($_POST["password"]);
$confirm = sanitize($_POST["confirm"]);

//identify errors / go back to login page if any found
$errors = array();
if ($password != $confirm) {
    array_push($errors, "no-match");
}
if (strpos($email, "@") === false) {
    array_push($errors, "invalid-email");
}
if (!empty($errors)) {
    $error_url = "../register.php";
    $c = 0; //hacky but whatever
    foreach ($errors as $error) {
        $c++; //haha (kill me)
        if ($c != 1) {
            $error_url = $error_url . "&" . $error;
        } else {
            $error_url = $error_url . "?" . $error;
        }
    }
    header("Location: " . $error_url);
    exit;
}

//generate verification key and setup email
$key = uniqid();

$email_subject = "Please verify your new CardKeeper account.";

// email message
$email_message = "
<html>
<head>
    <title>Please verify your CardKeeper account</title>
</head>
<body>
    <p> Welcome to CardKeeper! You're just a few seconds
away from never losing card info again. Please click the link below
to verify your account. </p> <br>
    <a href='https://localhost/Gift Card Hub/verify.php?email=$email&key=$key'>Verify account</a>
</body>
</html>
";

// Make sure its in html format
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Verify CardKeeper Account <verify-account@example.com>' . "\r\n";

//input into MySQL database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO login_info (firstname, lastname, email, password, verified, verification_key)
VALUES ('$firstName', '$lastName', '$email', '$password', 'false', '$key')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    //send verification email
    mail($email, $email_subject, $email_message, $headers);
    
    header("Location: ../login.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

function sanitize($str) {
    return strip_tags(trim($str));
}

?>