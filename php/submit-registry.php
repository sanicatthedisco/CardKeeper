<?php

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
if (strpos($email, "@") !== false) {
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

function sanitize(str) {
    return strip_tags(trim(str));
}

?>