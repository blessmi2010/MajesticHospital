<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
  <style>
        body {
            background-image: url('img/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
</body>
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
	<h5 class="text-center my-2">Total Reports</h5>
	<?php
	$query="SELECT * FROM report";
	$res=mysqli_query($connect,$query);

	$output="";
     
    $output.="
    <table class='table table-bordered'>
    <tr>
    <td>ID</td>
    <td>File</td>
    <td>Message</td>
    <td>Username</td>
    <td>Date Send</td>
    </tr>
    ";
    if(mysqli_num_rows($res)<1) {
    	$output .="
    	<tr>
    	<td class='text-center' colspan='6'>No Report Yet</td>
    	</tr>
    	";
    }

    while($row=mysqli_fetch_array($res)) {
    	$output .="
    	<tr>
    	  <td>".$row['id']."</td>
    	  <td>".$row['title']."</td>
    	  <td>".$row['message']."</td>
    	  <td>".$row['username']."</td>
    	  <td>".$row['date_send']."</td>
    	</tr>
    	";
    }
    $output .="<tr></table>";
    echo $output;

	?>
</div>
</body>
</body>
</html>