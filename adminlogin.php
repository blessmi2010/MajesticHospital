<?php   
session_start(); // Start the session

include("include/connection.php");

if(isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if(empty($username)) {
        $error['admin'] = "Enter Username";
    } elseif(empty($password)) {
        $error['admin'] = "Enter Password";
    }

    if(count($error) == 0) {
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
        $result = mysqli_query($connect, $query);

        if(mysqli_num_rows($result)==1) {
            echo "<script>alert('You have Logged in as Admin')</script>";
            $_SESSION['admin'] = $username;
            // Redirect to the desired location after login
            header("Location:admin/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Username or Password')</script>";
        }
    }
}
?>    


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Include necessary stylesheets here -->
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
    </style>
</head>
<body style="background-image: url(img/back-1.jpg);background-repeat:no-repeat;background-size:cover;">
    <?php include("include/header.php"); ?>

    <div style="margin-top:60px;"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 custom-jumbotron">
                    <img src="img/admin.jpg" class="jumbotron-img col-md-4">
                    <form method="post" class="my-2">
                        <div >
                            <?php
                            if(isset($error['admin'])){
                                $sh= $error['admin'];
                                $show = "<h4 class='alert alert-danger'>$sh</h4>";
                            }
                            else{
                                $show="";

                            }
                            echo $show;
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <input type="submit" name="login" class="btn btn-success" value="Login">
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>
