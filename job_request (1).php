<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	 
	<title>Job Request</title>
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
	?>
  
    <div class="container-fluid">
    	<div class="col-md-12">
    		<div class="row">
    			<div class="col-md-2" style="margin-left:-12px;">
                    <?php
                    include("sidenav.php");

                    ?>

                </div>
                <div class="col-md-10">
                	<br>
                	<h5 class="text-center my">Job Request</h5>

                	<div id="show"></div>
                </div>
    		</div>
    	</div>
    </div>			

    <script type="text/javascript">
    	$(document).ready(function(){
    		     
    		     show();
    		  function show(){



               $.ajax({

                 url:"ajax_job_request.php",
                 method: "POST" ,
                 success: function(data){
                 	$("#show").html(data);
                 }


               });


    		  }



            $(document).on('click' , '.approve' ,function(){

            	var id = $(this).attr("id");



            	$.ajax({
                    url:"ajax_approve.php",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                    	show();
                    }

            	});
            });

            $(document).on('click' , '.reject' ,function(){

            	var id = $(this).attr("id");



            	$.ajax({
                    url:"ajax_reject.php",
                    method:"POST",
                    data:{id:id},
                    success:function(data){
                    	show();
                    }

            	});
            });


    	});


   </script>

</body>
</html>