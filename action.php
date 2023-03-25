<?php 
include 'assets/server/connection.php';

$name = $_POST['admin_name'];
$username = $_POST['admin_username'];
$phone = $_POST['admin_phone'];
$email = $_POST['admin_email'];
$password = $_POST['admin_password'];

$query = "INSERT INTO adm VALUES ('', '$name', '$username', '$phone', 
'$email', '$password')";

mysqli_query($conn, $query);

header("location: index.php");
?>