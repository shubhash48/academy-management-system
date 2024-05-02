<?php

session_start();
if(!isset($_SESSION['username'])){
echo '<script type="text/javascript">window.location="login.php"; </script>';
}
$page='dashboard';
include("php/dbconnect.php");

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
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


</head>
<?php

include("php/header.php");

?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Admin Dashboard</h1>
                        

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
				
				  <div class="col-md-4">
                        <div class="main-box mb-secondary">
                            <a href="student.php">
                                <i class="fa fa-users fa-5x"></i>
                                <h4>Total Students: <?php include 'counter/stucount.php'?></h4>
                                <h5>Manage Students</h5>
                            </a>
                        </div>
                    </div>
				
				
                   
					
                    <div class="col-md-4">
                        <div class="main-box mb-secondary">
                            <a href="fees.php">
                                <i class="fa fa-money fa-5x"></i>
                                <h4>Total Earnings: <?php include 'counter/totalearncount.php'?></h4>
                                <h5>Collect Fees </h5>
                            </a>
                        </div>
                    </div>
					<div class="col-md-4">
                        <div class="main-box mb-secondary" >
                            <a href="fees.php">
                                <i class="fa fa-exclamation-circle fa-5x" ></i>
                                <h4>Total Dues: <?php include 'counter/totalduescount.php'?></h4>
                                <h5> Yet to Collect Fees </h5>
                            </a>
                        </div>
                    </div>
					
					 <div class="col-md-4">
                        <div class="main-box mb-secondary">
                            <a href="course.php">
                                <i class="fa fa-book fa-5x"></i>
                                <h4>Available Course: <?php include 'counter/totalcourse.php'?></h4>
                                <h5>Course</h5>
                            </a>
                        </div>
                    </div>
                  

                

               

                    <div class="col-md-4">
                        <div class="main-box mb-secondary">
                            <a href="report.php">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                <h5>View Reports</h5>
                                <h5>Details</h5>
                            </a>
                        </div>
                    </div>
                    
                    
                <!-- /. ROW  -->

            
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

