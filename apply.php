<?php
include("include/connection.php");

if(isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];

    $error = array();

    if(empty($firstname)) {
        $error['apply'] = "Enter firstname";
    } elseif(empty($surname)) {
        $error['apply'] = "Enter Surname";
    } elseif(empty($username)) {
        $error['apply'] = "Enter Username";
    } elseif(empty($email)) {
        $error['apply'] = "Enter Email Address";
    } elseif(empty($gender)) {
        $error['apply'] = "Select Your Gender";
    } elseif(empty($phone)) {
        $error['apply'] = "Enter Phone Number";
    } elseif(empty($country)) {
        $error['apply'] = "Select Country";
    } elseif(empty($password)) {
        $error['apply'] = "Enter Password";
    } elseif($confirm_password != $password) {
        $error['apply'] = "Both Passwords do not match";
    }

    if(count($error) == 0) {
        $query = "INSERT INTO doctors(firstname, surname, username, email, gender, phone, country, password, salary, data_reg, status, profile) 
                  VALUES ('$firstname', '$surname', '$username', '$email', '$gender', '$phone', '$country', '$password', '0', NOW(), 'Pendding', 'doctor.jpg')";

        $result = mysqli_query($connect, $query);

        if($result) {
            echo "<script>alert('You have Successfully Applied');</script>";
            header("Location: doctorlogin.php");
            exit(); // Ensure script stops executing after redirection
        } else {
            echo "<script>alert('Failed');</script>";
        }   
    }   
}

if(isset($error['apply'])) {
    $s = $error['apply'];
    $show = "<h5 class='text-center alert alert-danger'>$s</h5>";
} else {
    $show = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Now</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .custom-jumbotron {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-jumbotron form {
            margin-top: 10px;
        }

        .jumbotron-img {
            margin: auto;
            display: block;
        }

        body {
            background-image: url('img/back-1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 custom-jumbotron my-2">
                    <h5 class="text-center">Apply Now</h5>
                    <div>
                        <?php echo $show; ?>
                    </div>  
                    <form method="post">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname'];?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname" value="<?php if(isset($_POST['sname'])) echo $_POST['sname'];?>"
                            >
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email Address" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                        </div>
                        <br>
                        
                        <div class="form-group">
                        <label>Select Gender</label>
                        <select name="gender" class="form-control">
                       	  <option value="">Select Gender</option>
                       	  <option value="Male">Male</option>
                       	  <option value="Female">Female</option>
                       	</select>  
                        </div>	
                        <br>
                        <div class="form-group">
    		   			<label>Phone Number</label>
    		   			<input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number" 
    		   			value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">
    		   		    </div>
    		   		<br>

    		   		<div class="form-group">
                       <label>Select Country</label>
                       <select name="country" class="form-control">
                       	  <option value="">Select Country</option>
                       	  <option value="Russia">Russia</option>
                       	  <option value="India">India</option>
                       	  <option value="Ghana">Ghana</option>
                       	</select>  
                    </div>
                    <br>
                    
                    <div class="form-group">
    		   			<label>Password</label>
    		   			<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">

                    </div>
                    <br>
                    <div class="form-group">
    		   			<label>Confirm Password</label>
    		   			<input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">

                    </div>
                    <br>
                    <input type="submit" name="apply" value="Apply Now" class="btn btn-success">
                    <p>I aldready have an account <a href="doctorlogin.php"> Click here </a></p>


                </form>

    		   </div>
    		   <div class="col-md-3"></div>
            </div>
    	</div>
    </div>



</body>
</html>