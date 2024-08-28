<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Invoice</title>
    <style>
        body {
            background-image: url('img/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center my-2">My Invoice</h5>
                <?php
                $pat = $_SESSION['patient'];
                $query = "SELECT * FROM patient WHERE username = '$pat'";
                $res = mysqli_query($connect, $query);
                $row = mysqli_fetch_array($res);
                $fname = $row['firstname'];
                $querys = mysqli_query($connect, "SELECT * FROM income WHERE patient='$fname'");
                if (mysqli_num_rows($querys) < 1) {
                    echo "<p class='text-center'>No Invoice Yet</p>";
                } else {
                    echo "<table class='table'>";
                    echo "<tr>
                            <th>ID</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Date Discharge</th>
                            <th>Amount Paid</th>
                            <th>Description</th>
                            <th>Action</th>
                          </tr>";
                    while ($row = mysqli_fetch_array($querys)) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['doctor'] . "</td>
                                <td>" . $row['patient'] . "</td>
                                <td>" . $row['date_discharge'] . "</td>
                                <td>" . $row['amount_paid'] . "</td>
                                <td>" . $row['description'] . "</td>
                                <td>
                                    <a href='view.php?id=" . $row['id'] . "'>
                                        <button class='btn btn-info'>View</button>
                                    </a>
                                </td>
                              </tr>";
                    }
                    echo "</table>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
