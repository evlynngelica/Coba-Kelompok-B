<?php
session_start();
include 'assets/server/connection.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['admin_email']);
        header('location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>

<body>
    <h2>
        selamat datang <?php echo $_SESSION['admin_name']?>
        test
    </h2>
    <a class="btn btn-danger" aria-current="page" href="welcome.php?logout=1">Logout</a>
    <a href="dashboard.php">Dashboard</a>

</body>

</html>