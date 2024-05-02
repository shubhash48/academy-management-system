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

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Academy Management System</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />

    <link rel="icon" type="image/png" href="./logo/logo.png"/>
    <!--CUSTOM MAIN STYLES-->

    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>
    .logo img {
    max-width: 50%;
    height: auto;
    display: block;
    margin: 0 auto;
}
</style>
</head>

<body>

 
<div id="page-wrapper">
            <div id="page-inner">
            <div class="page-header">
    <h1></h1>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="logo">
            <img src="logo.png" alt="logo">
        </div>
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
       <h4 style="margin-left:200px;"> Dear Student <?php echo $fullname;?>. Welcome to Rainbow Academy</h4>
</div>
</div>
            
            
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
 
<script src="js/jquery-1.10.2.js"></script>	
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>
    
</body>
</html>