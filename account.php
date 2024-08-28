<?php
include("include/connection.php");

if(isset($_POST['Create'])) {
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $country = $_POST['Country']; // Fix typo here
    $password = $_POST['pass']; // Fix variable name here
    $con_pass = $_POST['con_pass'];

    $error = array();

    if (empty($fname)) {
        $error['ac'] = "Enter Firstname";
    } elseif (empty($sname)) {
        $error['ac'] = "Enter Surname";
    } elseif (empty($uname)) {
        $error['ac'] = "Enter Username";
    } elseif (empty($email)) {
        $error['ac'] = "Enter Email";
    } elseif (empty($phone)) {
        $error['ac'] = "Enter Phone Number";
    } elseif (empty($gender)) {
        $error['ac'] = "Enter Your Gender";
    } elseif (empty($country)) {
        $error['ac'] = "Enter Your country";
    } elseif (empty($password)) {
        $error['ac'] = "Enter Password";
    } elseif ($con_pass != $password) {
        $error['ac'] = "Both passwords do not match";
    }
    
    if (count($error) == 0) {
        $query = "INSERT INTO patient(firstname,surname,username,email,phone,gender,country,password,date_reg,profile) 
        VALUES('$fname','$sname','$uname','$email','$phone','$gender','$country','$password',NOW(),'patient.jpg')";

        $res = mysqli_query($connect, $query);
        if($res) {
            header("Location: patientlogin.php"); // Fix the redirection URL
            exit();
        } else {
            echo "<script>alert('Failed')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
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
       include("include/header.php");
     ?>
     <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 my-5 jumbotron">
                    <h5 class="text-center my-3">Create Account</h5>

                    <form method="post">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="fname" class="form-control"
                            autocomplete="off" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="sname" class="form-control"
                            autocomplete="off" placeholder="Enter Surname">
                            
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control"
                            autocomplete="off" placeholder="Enter Username">
                            
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control"
                            autocomplete="off" placeholder="Enter Email">
                            
                        </div>
                        <div class="form-group">
                            <label>Phone No</label>
                            <input type="number" name="phone" class="form-control"
                            autocomplete="off" placeholder="Enter Phone Number">
                            
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Your Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <select name="Country" class="form-control">
                                <option value="">Select Your Country</option>
                                <option value="India">India</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="Password" name="pass" class="form-control"
                            autocomplete="off" placeholder="Enter Password">
                            
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="Password" name="con_pass" class="form-control"
                            autocomplete="off" placeholder="Enter Confirm Password">
                            
                        </div>
                                

                        <input type="submit" name="Create" class="btn btn-info my-3" value="Create Account">
                        <p>I already have an account <a href="account.php">click here.</a></p>
                    </form>
                </div>
            </div>
            
        </div>    
    </div>

</body>
</html>
