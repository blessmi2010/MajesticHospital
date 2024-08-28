<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <style>
        body {
            background-image: url('img/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                    include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-2">Book Appointment</h5>
                    <?php
                    // Check if form is submitted
                    if(isset($_POST['book'])) {
                        // Retrieve form data
                        $date = $_POST['date'];
                        $sym = $_POST['sym'];

                        // Check if symptoms field is not empty
                        if (!empty($sym)) {
                            // Retrieve patient data from session
                            $pat = $_SESSION['patient'];
                            $sel = mysqli_query($connect, "SELECT * FROM patient WHERE username = '$pat'");
                            $row = mysqli_fetch_array($sel);

                            // Extract patient data
                            $firstname = $row['firstname'];
                            $surname = $row['surname']; // Assuming surname is a field in your patient table
                            $gender = $row['gender'];
                            $phone = $row['phone'];

                            // Insert appointment into database
                            $query = "INSERT INTO appointment(firstname, surname, gender, phone, appointment_date, symptoms, status, date_booked) 
                                      VALUES ('$firstname', '$surname', '$gender', '$phone', '$date', '$sym', 'Pendding', NOW())";

                            $res = mysqli_query($connect, $query);

                            if($res) {
                                echo "<script>alert('You have booked an appointment.')</script>";
                            } else {
                                // Debugging: Print SQL error if any
                                echo "Error: " . mysqli_error($connect);
                            }
                        } else {
                            echo "<script>alert('Symptoms field cannot be empty.')</script>";
                        }
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 jumbotron">
                                <form method="post">
                                    <label>Appointment Date</label>
                                    <input type="date" name="date" class="form-control">
                                    <label>Symptoms</label>
                                    <input type="text" name="sym" class="form-control"
                                    autocomplete="off" placeholder="Enter Symptoms">
                                    <input type="submit" name="book" class="btn btn-info my-2" value="Book Appointment">
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
