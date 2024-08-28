<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Total Income</title>
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
        <div class="col-md-2" style="margin-left: -30px">
          <?php
          include("sidenav.php");
          ?>
        </div>
        <div class="col-md-10">
          <h5 class="text-center my-2">Total Income</h5>  
          <?php
          $query = "SELECT * FROM income";
          $res = mysqli_query($connect, $query);

          if(mysqli_num_rows($res) < 1) {
            echo "<p class='text-center'>No Patient Discharge Yet.</p>";
          } else {
            echo "<table class='table table-bordered'>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Doctor</th>
                        <th>Patient</th>
                        <th>Date Discharge</th>
                        <th>Amount Paid</th>
                      </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_array($res)) {
              echo "<tr>
                      <td>".$row['id']."</td>
                      <td>".$row['doctor']."</td>
                      <td>".$row['patient']."</td>
                      <td>".$row['date_discharge']."</td>
                      <td>".$row['amount_paid']."</td>
                    </tr>";
            }

            echo "</tbody></table>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>  
</body>
</html>
