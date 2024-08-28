<!DOCTYPE html>
<html>
<head>
    <title>Patient Login Page</title>
    <style>
        .jumbotron {
            background-color: #f8f9fa; /* Light gray background */
            padding: 20px; /* Add padding */
            border-radius: 10px; /* Add border radius */
        }
        .jumbotron img {
            width: 100px; /* Adjust image width */
            height: auto; /* Maintain aspect ratio */
            display: block; /* Ensure image is centered */
            margin: 0 auto; /* Center image horizontally */
        }
    </style>
</head>
<body style="background-image: url(img/back-1.jpg); background-repeat: no-repeat; background-size: cover;">

<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {
    $pass = $_POST['pass'];
    $uname = $_POST['uname'];

    if (empty($uname)) {
        echo "<script>alert('Enter Username')</script>";
    } else if (empty($pass)) {
        echo "<script>alert('Enter Password')</script>";
    } else {
        $query = "SELECT * FROM patient WHERE username = '$uname' AND password='$pass'";
        $res = mysqli_query($connect, $query);

        if (mysqli_num_rows($res) == 1) {
            $_SESSION['patient'] = $uname;
            header("Location:patient/index.php");
            exit(); // Make sure to stop the script after redirections
        } else {
            echo "<script>alert('Invalid Account')</script>";
        }
    }
}
?>

<?php
include("include/header.php");
?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 my-5 jumbotron">
                
                <img src="img/patientnew.jpg" alt="Patient Image" class="img-fluid mb-2">
                <h5 class="text-center my-3">Patient Login</h5>
                <form method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="uname" class="form-control"
                               autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="Password" name="pass" class="form-control"
                               autocomplete="off" placeholder="Enter Password">

                    </div>
                    <input type="submit" name="login" class="btn btn-info my-3" value="Login">
                    <p>Don't have an account? <a href="account.php">Click here</a></p>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>
