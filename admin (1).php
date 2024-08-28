<?php
session_start();
?>

<html>
<head>
    <title>Admin</title>
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
<div class="container-fluid"></div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-2" style="margin-left: -12px;">
            <?php
            include("sidenav.php");
            include("../include/connection.php");
            ?>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <br>
                    <h5 class="text-center">All Admin </h5>
                    <br>

                    <?php
                    $ad = $_SESSION['admin'];
                    $query = "SELECT * FROM admin WHERE username != '$ad'";
                    $res = mysqli_query($connect, $query);
                    $output = "<table class='table table-bordered'>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th style='width:10%'>Action</th>
                                </tr>";

                    if (mysqli_num_rows($res) < 1) {
                        $output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_array($res)) {
                            $id = $row['id'];
                            $username = $row['username'];

                            $output .= "<tr>
                                            <td>$id</td>
                                            <td>$username</td>
                                            <td>
                                               <form method='post'>
                                                   <input type='hidden' name='admin_id' value='$id'>
                                                   <button type='submit' class='btn btn-info' name='remove'>Remove</button>
                                               </form>
                                            </td>
                                        </tr>";
                        }
                    }

                    $output .= "</table>";

                    echo $output;

                    if(isset($_POST['remove'])){
                       $id = $_POST['admin_id'];

                       $query = "DELETE FROM admin WHERE id='$id'";
                       mysqli_query($connect, $query);
                    }
                    ?>

                </div>
                <div class="col-md-6">
                    
                

                    <?php
                    if(isset($_POST['add'])){
                        $uname = mysqli_real_escape_string($connect, $_POST['uname']); // Sanitize user input
                        $pass = mysqli_real_escape_string($connect, $_POST['pass']); // Sanitize user input
                        $image = $_FILES['img']['name'];

                        $error = array();

                        if(empty($uname)){
                            $error['u'] = "Enter Admin Username";
                        }elseif(empty($pass)){
                            $error['p'] = "Enter Admin Password";
                        }elseif(empty($image)){
                            $error['i'] = "Add Admin Picture";
                        }

                        if(count($error) == 0){
                            // Hash the password before storing it in the database
                            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                            
                            // Insert data into the database
                            $q = "INSERT INTO admin (username, password, profile) VALUES ('$uname', '$hashed_password', '$image')";
                            $result = mysqli_query($connect, $q);

                            if($result){
                                // Check if directory exists, if not, create it
                                $upload_dir = "img/";
                                if (!file_exists($upload_dir)) {
                                    mkdir($upload_dir, 0777, true); // Create directory recursively
                                }

                                // Move uploaded file to destination directory
                                move_uploaded_file($_FILES['img']['tmp_name'], $upload_dir . $image);
                                echo "Admin added successfully.";
                            }else{
                                echo "Failed to add admin.";
                            }
                        }else{
                            foreach($error as $err){
                                echo $err . "<br>";
                            }
                        }
                    }
                     
                     if(isset($error['u'])){
                        $er = $error['u'];

                        $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
                     }else{
                        $show = "";
                     }

                    ?>
                    <br>

                    <h5 class="text-center">Add Admin</h5>
                    <form method="post" enctype="multipart/form-data">
                        <div>
                           <?php
                            echo $show;
                           ?> 

                        </div>
                        <div class="from-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off">
                        </div>
                        <div class="from-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control">
                        </div>
                        <div class="from-group">
                            <label>Add Admin Picture</label>
                            <input type="file" name="img" class="form-control">
                        </div>
                        <br>
                        <input type="submit" name="add" value="Add New Admin" class="btn btn-success">
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
