<?php
session_start();
include 'assets/server/connection.php';

if (isset($_SESSION['logged_in'])) {
    header('location: welcome.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['admin_email'];
    $password = ($_POST['admin_password']);

    $query = "SELECT admin_id, admin_name, admin_username, admin_phone, admin_email, admin_password
    FROM adm
    WHERE admin_email = ? AND admin_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);
    
    if ($stmt_login->execute()) {
        $stmt_login->bind_result($admin_id, $admin_name, $admin_username, $admin_phone ,$admin_email ,$admin_password);
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_username'] = $admin_username;
            $_SESSION['admin_phone'] = $admin_phone;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_password'] = $admin_password;
            $_SESSION['logged_in'] = true;

            header('location:welcome.php?message=Logged in successfully');
        } else {
            header('location:index.php?error=Could not verify your account');
        }
    } else {
        // Error
        header('location: login.php?error=Something went wrong!');
    }
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Project</title>

    <link rel="icon" href="assets/img/android-chrome-192x192.png">

    <!-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" /> -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->
   
</head>

<body>
    <!-- JS -->
    <!-- <script type="text/javascript" src="js/bootstrap.js"></script> -->
    <!-- JS -->
    <header>
        <img src="assets/img/android-chrome-192x192.png" class="image" alt="">
        <h2 class="logo">God
            <small class="text-muted">Dang</small>
        </h2> 
        <nav class="navigation">
            <a href="home.php">Home</a>
            <a href="#about">About Us</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
            <button class="btnLogin-popup">Login</button>
        </nav>
    </header>
    <div class="wrapper">
        <!-- ---------------------LOGIN START------------------------ -->
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>
        <div class="form-box login">
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <?php if (isset($_GET['error'])) ?>
                    <div role="alert">
                        <?php
                        if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        }
                        ?>
                    </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="admin_email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon>    
                    </span>
                    <input type="password" name="admin_password" required >
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox"> Remember Me
                    </label>
                    <a href="#">Forget Passowrd?</a>
                </div>
                <button type="submit" class="btn" name="login_btn">Login</button>
                <div class="login-register">
                    <p>
                        Don't have an account?
                        <a href="#Register" class="register-link"> Register</a>
                    </p>
                </div>
            </form>  
        </div>
        <!-- ---------------------LOGIN END------------------------ -->
        <!-- ---------------------REG START------------------------ -->
        <div class="form-box register">
            <h2>Registration</h2>
            <form action="action.php" method="POST">
                <div class="input-box">
                    <span class="icon">
                    <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="admin_name" required>
                    <label>Full Name</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="admin_username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <ion-icon name="call"></ion-icon>
                    </span>
                    <input type="text" name="admin_phone" required>
                    <label>Phone</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="text" name="admin_email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon>    
                    </span>
                    <input type="password" name="admin_password" required >
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">I agree to the terms & condtions
                    </label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>
                        Already have an account?
                        <a href="#Login" class="login-link"> Login</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- ---------------------REG END------------------------ -->
    </div>

    

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="assets/javascript/main.js"></script>
</body>

</html>