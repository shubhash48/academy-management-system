
<?php
session_start();
include("php/dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$page="setting";

$error = '';
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];

        // Retrieve form data
        $oldPassword = $_POST["oldpassword"];
        $newPassword = $_POST["newpassword"];
        $confirmPassword = $_POST["confirm_password"];

        // Validate the old password
        $sql = "SELECT password FROM student WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $plainOldPassword = $row["password"];

            if ($oldPassword !== $plainOldPassword) {
                echo '<script type="text/javascript">window.location="setting.php?act=1";</script>';
                exit;
            }
        } else {
            exit;
        }

        // Validate new password and confirm password match
        if ($newPassword !== $confirmPassword) {
            echo '<script type="text/javascript">window.location="setting.php?act=2";</script>';
            exit;
        }
        if ($oldPassword === $newPassword) {
            echo '<script type="text/javascript">window.location="setting.php?act=4";</script>';
            exit;
        }

        // Update the user's password in the database
        $updateSql = "UPDATE student SET password = '$newPassword' WHERE username = '$username'";
        if ($conn->query($updateSql) === TRUE) {
            echo '<script type="text/javascript">window.location="setting.php?act=3";</script>';
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Username not found in session. Please log in.";
    }
}
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
	
</head>
<body>
<?php
include("counter/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Account Setting</h1>
                     
<?php


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$error = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Incorrect old password. Please try again.</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$error = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>New password and confirm password do not match. Please try again.</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$error= "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password changed successfully!</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="4")
{
$error= "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Old password and new password shouldnot be same!!</div>";
}
/*
if(isset($_REQUEST['act']) &&  @$_REQUEST['act']=='1')
{
echo '<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Password Change Successfully.
</div>';

}
*/
echo $error;
?>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
				
                    <div class="col-sm-8 col-sm-offset-2">
               <div class="panel panel-success">
                        <div class="panel-heading">
                          Change Password
                       
                        </div>
						<form action="setting.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						
						
						
						
						<div class="form-group">
								<label class="col-sm-4 control-label" for="Old">Old Password</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="oldpassword" name="oldpassword" />
                                    <span class="help-block"></span>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="Password"> New Password</label>
								<div class="col-sm-5">
									 <input class="form-control" name="newpassword" id="newpassword" type="password" minlength=4 maxlenngth=15 >
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="Confirm">Confirm Password</label>
								<div class="col-sm-5">
                <input class="form-control" name="confirm_password" id="confirm_password" type="password" minlength=4 maxlenngth=15 >


								</div>
							</div>
						
						<div class="form-group">
								<div class="col-sm-9 col-sm-offset-4">
									<button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Change Password </button>
								</div>
							</div>
                         
                           
                           
                         
                           
                         </div>
							</form>
							
                        </div>
                            </div>
            
			
                </div>
                <!-- /. ROW  -->

            
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
    
		<script type="text/javascript">
		

		$( document ).ready( function () {			
			
			$( "#signupForm1" ).validate( {
				rules: {
					oldpassword: "required",
				
					newpassword: {
						required: true,
						minlength: 4
					},
					
					
				},
				messages: {
					oldpassword: "Please enter your old password",
					
					newpassword: {
						required: "Please provide a password",
						minlength: "Your password must be at least 4 characters long"
					},
          confirmpassword: {
    required: true,
    minlength: 4,
    equalTo: "#confirm_password"
}
				},

				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
		} );
	</script>


</body>
</html>
