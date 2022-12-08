<?php

include 'connection.php';

error_reporting(0);

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email_address='$email'";
        $result = mysqli_query($connection, $sql);
        if (!$result->num_rows > 0) {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (firstname, lastname, email_address, password, birth_date, gender)
                VALUES ('$firstname', '$lastname', '$email', '$pass_hash', '$birthdate', '$gender')";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $firstname = "";
                $lastname = "";
                $email = "";
                $password = "";
                $cpassword = "";
                $birthdate = "";
                echo "<script>alert('User Registered Successfully!'); window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Something went wrong!')</script>";
            }
        } else {
            echo "<script>alert('Email Already Exists!')</script>";
        }
    } else {
        echo "<script>alert('Password Not Matched!')</script>";
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

    <title>Register</title>
</head>

<body>
    <div class="container">
        <form action="register.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Firstname" name="firstname" value="<?= $firstname ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Lastname" name="lastname" value="<?= $lastname ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?= $email ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?= $_POST['password'] ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" value="<?= $_POST['cpassword'] ?>" required>
            </div>
            <div class="input-group">
                <input type="text" onfocus="(this.type='date')" placeholder="Birth Date" name="birthdate" value="<?= $birthdate ?>" required>
            </div>
            <div class="" style="margin-bottom: 20px;">
                <p>Gender</p>
                <input type="radio" name="gender" id="male" value="Male" <?= $gender == 'Male' ? 'checked' : '' ?>>
                <label for="male">Male</label>
                <br>
                <input type="radio" name="gender" id="female" value="female" <?= $gender == 'Female' ? 'checked' : '' ?>>
                <label for="female">Female</label>
            </div>
            <div class="input-group">
                <input name="submit" class="btn" value="Register" type="submit">
            </div>
            <p class="login-register-text">Already have an account? <a href="index.php">Login Here</a>.</p>
        </form>
    </div>


</body>

</html>