<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Patient Dashboard</title>
</head>
<body>
	<?php

	   include("../include/header.php");
	   include("../include/connection.php");


	?>
	<div class="container-fluid"></div>
	  <div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="margin-left: -30px;">
				<?php
				   include("sidenav.php");
				?>
				</div>
			  <div class="col-md-10">
				<h5 class="my-3">Patient Dashboard</h5>
				
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3 mx-2" style="height:150px; background-color: #3E3D53;">

							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<h5 class="text-white my-4">My Profile</h5>
										
									</div>
								    <div class="col-md-4">
								    	<a href="Profile.php">
								    		<i class="fa fa-user-circle fa-3x 
								    		my-4 " style="color: white;"></i>
								    	</a>
								    </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 mx-2" style="height:150px; background-color: #594D5B;">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<h5 class="text-white my-4">Book Appointment</h5>
										
									</div>
								    <div class="col-md-4">
								    	<a href="appointment.php">
								    		<i class="fa fa-calendar fa-3x 
								    		my-4 " style="color: white;"></i>
								    	</a>
								    </div>
								</div>
							</div>
							
						</div>
						<div class="col-md-3 mx-2" style="height:150px; background-color: #9897A9;">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<h5 class="text-white my-4">My Invoice </h5>
										
									</div>
								    <div class="col-md-4">
								    	<a href="invoice.php">
								    		<i class="fa-solid fa-pen-to-square fa-3x my-4 " style="color: white;"></i>
								    	</a>
								    </div>
								</div>
							</div>
							
						</div>
					</div>
				</div>


				    <?php  

                       if(isset($_POST['send'])) {

                       	   $title = $_POST['title'];
                       	   $message = $_POST['message'];


                       	   if(empty($title)) {

                       	   } else if(empty($message)) {

                       	   } else {
                       	   	$user = $_SESSION['patient'];
                       	   	$query = "INSERT INTO report(title, message, username, date_send) VALUES('$title', '$message', '$user', NOW())";
                       	   	$res = mysqli_query($connect, $query);

                       	   	if($res) {
                       	   		echo "<script>alert('You Have sent Your Report')</script>";
                       	   	}
                       	   }
                       }

				    ?>

	            <div class="col-md-12">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6 jumbotron my-5" style="background-color: #393739;">
							<h5 class="text-center text-white my-3 my-2">Send a Report</h5>
							<form method="post">
								<label >Title</label>
								<br>
							<input type="text" name="title" class="form-control"
							autocomplete="off" placeholder="Enter Title of the report">
							    <label>Message</label>
							<input type="text" name="message" class="form-control"
							autocomplete="off" placeholder="Enter Message">

							    
							<input type="submit" name="send" value="Send Report"
							class="btn btn-success my-2">
							</form>
						</div>
					</div>
					
				</div>
			  </div>

			</div>	
	  </div>
     </div>
</body>
</html>
