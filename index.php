<?php

include 'connection.php';

error_reporting(0);

session_start();

if (isset($_SESSION['email_address'])) {
    header("Location: success_login.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if ($_SESSION['captcha'] == $_POST['captcha']) {
        $sql = "SELECT * FROM users WHERE email_address='$email' AND password='$password'";
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['fullname'] = $name;
            $_SESSION['email_address'] = $row['email_address'];
            header("Location: success_login.php");
        } else {
            echo "<script>alert('Invalid Email or Password!')</script>";
        }
    } else {
        echo "<script>alert('Invalid Captcha!')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Login</title>
</head>

<body>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error'] ?>
    </div>

    <div class="container">
        <form action="index.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <img src="generate_captcha.php" alt=""><br>
            <div class="input-group">
                <input type="text" placeholder="Captcha" name="captcha" value="" required>
            </div>
            <div class="input-group">
                <input name="submit" class="btn" type="submit">
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>

</html>