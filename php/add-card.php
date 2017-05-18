<?php

//if this doesn't work check the names of these post indices
$store_name = $_POST["store"];
$card_code = password_hash($_POST["code"]);
$expiration_date = $_POST["date"];
$card_value = $["value"];

$password = "pass";
$username = "root";
$servername = "localhost";
$dbname = "cardkeeper";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//check these sql column names too
$sql = 'INSERT INTO card_info ("store", "code", "date", "value")
VALUES ("$store_name","$card_code","$expiration_date","$card_value")';

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../home.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
