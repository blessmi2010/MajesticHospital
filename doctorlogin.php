<?php

session_start();
include("include/connection.php");


if(isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if(empty($uname)) {
        $error['login'] = "Enter Username";
    } elseif(empty($password)) {
        $error['login'] = "Enter Password";
    } else {
        $q = "SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
        $qq = mysqli_query($connect, $q);

        if(!$qq) {
            echo "<script>alert('Error: " . mysqli_error($connect) . "')</script>";
        } else {
            $row = mysqli_fetch_array($qq);

            if($row) {
                if($row['status'] == "Pending") {
                    $error['login'] = "Please wait for the admin to confirm";
                } elseif($row['status'] == "Rejected") {
                    $error['login'] = "Try again later";
                } else {
                    $_SESSION['doctor'] = $uname;
                    echo "<script>alert('Login successful')</script>";
                    // Redirect to another page after successful login
                    header("Location: doctor/index.php");
                    exit();
                }
            } else {
                $error['login'] = "Invalid username or password";
            }
        }
    }
}

if(isset($error['login'])) {
    $l = $error['login'];
    $show = "<h5 class='text-center alert alert-danger'>$l</h5>";
} else {
    $show = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Custom jumbotron style */
        .custom-jumbotron {
            background-color: #f8f9fa; /* Light gray background color */
            padding: 20px; /* Adjust padding as needed */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        .custom-jumbotron form {
            /* Additional styling for the form inside jumbotron */
            margin-top: 10px;
        }

        .jumbotron-img {
            margin: auto; /* Center the image horizontally */
            display: block; /* Ensure image is displayed as a block element */
        }
        body {
            background-image: url('img/back-1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>

    <?php
    include("include/header.php");
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center"> <!-- Centering the row -->
            <div class="col-md-6 custom-jumbotron my-3">
                <img src="img/doctorlogin.png" class="jumbotron-img col-md-3">
                <h5 class="text-center my-2">Doctors Login</h5>
                <div>
                    <?php echo$show; ?>
                </div>
                <form method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div>
                    <br>
                    <input type="submit" name="login" class="btn btn-success" value="Login">
                    <br>
                    <p>Don't have an account?<a href="apply.php"> Apply Now</a> </p>
                </form> <!-- Closing form tag moved here -->
            </div>
        </div>
    </div>

</body>
</html>
