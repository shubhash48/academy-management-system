<?php
session_start();
include("php/dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}


$page = 'dashboard';

?>
<?php

include("counter/header.php");
$contact=$name=$fees=$balance=$fullname=$joindate=$course='';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Academy Management System</title>
    <link rel="icon" type="image/png" href="./logo/logo.png"/>
    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="logo/logo.png"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <style>
    .upload {
        width: 125px;
        position: relative;
        margin: auto;
    }

    .upload img {
        border-radius: 50%;
        border: 3px solid red;
    }

    .upload .round {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #00B4FF;
        width: 32px;
        height: 32px;
        text-align: center;
        line-height: 32px;
        border-radius: 50%;
        cursor: pointer;
    }

    .upload .round i {
        color: white;
    }

    .upload .round input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
    }
    .camerafi{
        position: relative;
        margin-top: 7px;
        font-size: 20px;
    }
    .userdetail hr {
    border-color: black;
}
</style>


</head>

<body>
<?php
$username = $_SESSION['username'];
$query = "SELECT contact, course, address, fees, joindate, balance,sname,emailid,image FROM student WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    $userInfo = mysqli_fetch_assoc($result);

    // Display user information
     $fullname=$userInfo['sname'] ;
     $contact=$userInfo['contact'] ;
     $address=$userInfo['address'] ;
   $course= $userInfo['course'];
    $fees=$userInfo['fees'];
  $balance= $userInfo['balance'];
  $imagefile=$userInfo['image'] ;
  $emailid=$userInfo['emailid'];
  $joindate=$userInfo['joindate'];
 
} 
?>
<div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line fs-5"><?php echo $fullname ?> Profile</h1>
                        </div>
                        <div class="row">
                        <div class="col-sm-3 col-sm-offset-1">
                    
</div>
<div class="col-sm-4 ">
<form class="form" id="form" action="" enctype="multipart/form-data" method="post">
    <div class="upload">
        <img src="../img/<?php echo $imagefile; ?>" width="125" height="125" title="<?php echo $imagefile; ?>">
        <div class="round">
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera camerafi" style="color: #fff;"></i>
        </div>
    </div>
</form>


<!-- click on submitting -->


<script type="text/javascript">
    document.getElementById("image").onchange = function() {
        document.getElementById("form").submit();
    };
</script>
  



                </div>
                <div class="col-sm-3 ">
                           
               </div>
</div>

</div>
<div class="col-sm-3 col-sm-offset-1  ">
                            
               </div>
               <div class="col-sm-4 bg-light"style="box-shadow: -26px 5px 47px 22px rgba(240,231,231,1);">
                            <div class= "userdetail" style="margin-bottom:20px; margin-bottom:50px; border-bottom: 1px solid black;" >
                            <li class="fa fa-user" style="color:black; margin-right:20px;" ></li>Name<br>
                            <small style="margin-left:30px;"  ><?php echo $fullname ?></small>
</div>

<div class= "userdetail" style="margin-bottom:20px; border-bottom: 1px solid black; margin-bottom:50px;">
                            <li class="fa fa-phone" style="color:black; margin-right:20px;" ></li>Contact Number<br>
                            <small style="margin-left:30px;"  ><?php echo $contact?></small>
</div>
<div class= "userdetail" style="margin-bottom:20px; border-bottom: 1px solid black; margin-bottom:50px;">
                            <li class="fa fa-phone" style="color:black; margin-right:20px;" ></li>Address<br>
                            <small style="margin-left:30px;"  ><?php echo $address?></small>
</div>



<div class= "userdetail" style="margin-bottom:20px; border-bottom: 1px solid black; margin-bottom:50px;">
                            <li class="fa fa-envelope" style="color:black; margin-right:20px;" ></li>Email<br>
                            <small style="margin-left:30px; "  ><?php echo $emailid?></small>
</div>


<div class= "userdetail" style="margin-bottom:20px; border-bottom: 1px solid black; margin-bottom:50px;">
                            <li class="fa fa-book" style="color:black; margin-right:20px;" ></li>Course<br>
                            <small style="margin-left:30px; "  ><?php echo $course?></small>
</div>


<div class= "userdetail" style="margin-bottom:20px; margin-bottom:50px;">
                            <li class="fa fa-calendar-o" style="color:black; margin-right:20px;" ></li>Join Date<br>
                            <small style="margin-left:30px; margin-bottom:50px;"  ><?php echo $joindate?></small>
</div>
<div class="col-sm-3 ">
                           
                           </div>
</div>

</div>

              
</div>

<!-- uploading image while changing -->
<?php
    if (isset($_FILES["image"])) {
        if ($_FILES["image"]["error"] == 4) {
            echo "<script> alert('Image Does Not Exist'); </script>";
        } else {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>alert('Invalid Image Extension');</script>";
            } else if ($fileSize > 1000000) {
                echo "<script>alert('Image Size Is Too Large');</script>";
            } else {
                $newImageName = uniqid() . '.' . $imageExtension;
    
                if (move_uploaded_file($tmpName, '../img/' . $newImageName)) {
                    $sql = "UPDATE student SET image = '$newImageName' WHERE username = '$username'";
                    if ($conn->query($sql)) {
                        $imagefile = $newImageName;

    // Redirect to details.php
                header("Location: details.php");
                    } else {
                        echo "<script>alert('Error updating image in database');</script>";
                    }
                } else {
                    echo "<script>alert('Error moving uploaded image');</script>";
                }
            }
        }
    }
    ?>
    
    
    
    
    
    
</body>
</html>