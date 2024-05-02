<?php
session_start();
include("php/dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$page = 'fees';
?>
<?php

include("counter/header.php");

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Insitute Management System</title>

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
	
	<script src="js/jquery-1.10.2.js"></script>
	
	<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
    <style>
    .logo img {
    max-width: 50%;
    height: 60px;
   
    margin: 0 auto;
    }
    .pay-amount-container {
    text-align: center;
     margin-left:40px;
    
   
}

.pay-amount-container input[type="submit"] {
    background-color: green;
    color:white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    width:540px;
}

</style>
	
</head>
<body>
<div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">My fees</h1>
                        </div>

                </div>
            
                  <div class="row">
				
                <div class="col-sm-8 col-sm-offset-1">
                <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
         <div class="panel panel-default">
                         <div class="panel-heading">
                             PayFee
                         </div>
                         <div class="panel-body">
                                <div class="row">
                                <div class="col-sm-5 ">
                                <div class="logo">
            <img src="logo.png" alt="logo">
        </div>
        <h5 style="margin-top:20px">Rainbow Academy Management System</h5><br>
        <small>
        Address: Kanchan-3,Haraiya,Rupandehi<br>
        Telephone number: 071*******<br>
        Email Address: rainbowacademy@gmail.com<br>
</small>
                                         
                                </div>
                                <div class="col-sm-6 "><div class="table">
                                 <table class="table table-bordered" style="width: 100%;">
                                   
                                     <tbody>
                                     <?php
                                     $username = $_SESSION['username'];
                                    $sql="SELECT * FROM student WHERE username = '$username'";
                                     $q = $conn->query($sql);
                                     
                                     while($r = $q->fetch_assoc())
                                     {
                                        $dues=$r['balance'];
                                        $id=$r['id'];
                                          
                                    ?>
                                     <tr>
    <td>Student Name</td>
    <td><?php echo $r['sname']; ?></td>
</tr>
<tr>
<td>Course Name</td>
    <td><?php echo $r['course']; ?></td>
</tr>
<tr>
<td>Joined Date</td>
    <td><?php echo date("d M y", strtotime($r['joindate'])); ?></td>
</tr>
<tr>
<td>Fees</td>
    <td><?php echo $r['fees']; ?></td>
</tr>
<td>Dues</td>
    <td><?php echo $r['balance']; ?></td>
</tr>
          
<?php } ?>
                                     
                                         
                                         
                                     </tbody>
                                 </table></div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-sm-8">
                                <div class="pay-amount-container">
                                     <?php
                                $username = $_SESSION['username'];
                                    $sql="SELECT * FROM student WHERE username = '$username'";
                                     $q = $conn->query($sql);
                                     
                                     while($r = $q->fetch_assoc())
                                     {
                                        $dues=$r['balance'];
                                        $id=$r['id'];
                                        ?>
                                       
                                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                            <input value="<?php echo $dues; ?>" name="tAmt" type="hidden">
                                            <input value="<?php echo $dues; ?>" name="amt" type="hidden">
                                            <input value="0" name="txAmt" type="hidden">
                                            <input value="0" name="psc" type="hidden">
                                            <input value="0" name="pdc" type="hidden">
                                            <input value="EPAYTEST" name="scd" type="hidden">
                                            <input value="<?php echo $id; ?>" name="pid" type="hidden">
                                            <input value="http://localhost/academymanagementsystem/esewa_payment_success.php" type="hidden" name="su">
                                            <!-- <input value="http://localhost/academymanagementsystem/esewa_payment_failure.php" type="hidden" name="su"> -->
                                            <input value="http://localhost/academymanagementsystem/student/fees.php" type="hidden" name="fu">
                                            <input value="Pay Fee Via Esewa" type="submit">
                                            </form>
                                    
<?php
                                     }


                                        
                                        
                                        
                                        ?>
                                        
                                        </div>
                                    </div>
                                    </div>
                             </div>
                         </div>
                     </div>
                      
     <script src="js/dataTable/jquery.dataTables.min.js"></script>
</div>
</div>
                    
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>

   
</body>
</html>
