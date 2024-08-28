<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Invoice</title>
</head>
<body>

    <?php

    include("../include/header.php"); 
    include("../include/connection.php");

    // Check if id is set and not empty
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // SQL query
        $query = "SELECT * FROM income WHERE id = '$id'";
        $res = mysqli_query($connect,$query);

        // Check if query executed successfully
        if($res) {
            $row = mysqli_fetch_array($res);
            if($row) {
                // Output invoice details
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
                               <h5 class="text-center my-2">View Invoice</h5>
                               <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th colspan="2" class="text-center">Invoice Details</th>
                                            </tr>   

                                            <tr>
                                                <td>Doctor</td>
                                                <td><?php echo $row['doctor'];?></td>
                                            </tr>

                                            <tr>
                                                <td>Patient</td>
                                                <td><?php echo $row['patient'];?></td>
                                            </tr>

                                            <tr>
                                                <td>Date Discharge</td>
                                                <td><?php echo $row['date_discharge'];?></td>
                                            </tr>

                                            <tr>
                                                <td>Amount Paid</td>
                                                <td>$<?php echo $row['amount_paid'];?></td>
                                            </tr>   

                                            <tr>
                                                <td>Description</td>
                                                <td><?php echo $row['description'];?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-3"></div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            } else {
                echo "No data found for the given ID.";
            }
        } else {
            echo "Error executing query: " . mysqli_error($connect);
        }
    } else {
        echo "ID is not set or empty.";
    }
    ?>
</body>
</html>
