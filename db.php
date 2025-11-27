<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$dbname = "todo_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

$conn->set_charset("utf8");
?>
