<?php
// Generate and store CSRF token in the user's session
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$db_name="user_db";
$conn= mysqli_connect("localhost","root","", $db_name);
mysqli_query($conn,"set characer set utf8");
mysqli_query($conn,"SET NAMES utf8");

?>