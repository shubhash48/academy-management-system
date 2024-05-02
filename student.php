
<?php
session_start();
include("php/dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$page = 'student';
?>
<?php

$errormsg = '';
$action = "add";

$id = "";
$emailid = '';
$sname = '';
$joindate = '';
$remark = '';
$contact = '';
$address='';
$balance = 0;
$fees = '';
$course = '';
$username='';
$password='';

if (isset($_POST['save'])) {

    $sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $joindate = mysqli_real_escape_string($conn, $_POST['joindate']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $emailid = mysqli_real_escape_string($conn, $_POST['emailid']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $existingContact = $conn->query("SELECT * FROM student WHERE contact='$contact'");
    if ($existingContact->num_rows > 0) {
        $errormsg = "<div class='alert alert-danger'>Contact number must be unique!</div>";
    } else {
    
    if (isset($_POST['save'])&&$_POST['action'] == "add"){
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
   
    }
    if($_FILES["image"]["error"] == 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>"
        ;
    }
    else{
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if ( !in_array($imageExtension, $validImageExtension) ){
          echo
          "
          <script>
            alert('Invalid Image Extension');
          </script>
          ";
        }
        else if($fileSize > 1000000){
            echo
            "
            <script>
              alert('Image Size Is Too Large');
            </script>
            ";
          }
          else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
      
            move_uploaded_file($tmpName, 'img/' . $newImageName);
            {

    if ($_POST['action'] == "add") {
        // Check if the student already exists
        $existingStudent = $conn->query("SELECT * FROM student WHERE sname='$sname' AND contact='$contact'");
        if ($existingStudent->num_rows > 0) {
            // Student already exists, update the existing record
            $row = $existingStudent->fetch_assoc();
            $newCourse = $row['course'] . ', ' . $course;
            $newFees = $row['fees'] + $_POST['fees'];
            $conn->query("UPDATE student SET course='$newCourse', fees='$newFees' WHERE id='" . $row['id'] . "'");
            $sid = $row['id'];
        } else {
            // Student does not exist, add a new record
            $remark = mysqli_real_escape_string($conn, $_POST['remark']);
            $fees = mysqli_real_escape_string($conn, $_POST['fees']);
            $advancefees = mysqli_real_escape_string($conn, $_POST['advancefees']);
    
    // Check if the contact number already exists
    $existingContact = $conn->query("SELECT * FROM student WHERE contact='$contact'");
    if ($existingContact->num_rows > 0) {
        $errormsg = "<div class='alert alert-danger'>Contact number must not ne same!</div>";
    } 
            $balance = $fees - $advancefees;
            $q1 = $conn->query("INSERT INTO student (sname, joindate, contact,address, image, emailid, course, balance, fees,username,password) VALUES ('$sname','$joindate','$contact', '$address', '$newImageName','$emailid','$course','$balance','$fees','$username','$password')");
            $sid = $conn->insert_id;
            $conn->query("INSERT INTO fees_transaction (stdid, paid, submitdate, transcation_remark) VALUES ('$sid','$advancefees','$joindate','$remark')");
        }

        echo '<script type="text/javascript">window.location="student.php?act=1";</script>';

    } else if ($_POST['action'] == "update") {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $sql = $conn->query(" UPDATE student SET  sname = '$sname', contact = '$contact',  address='$address', course = '$course',image='$newImageName', joindate='$joindate', emailid = '$emailid' WHERE id = '$id'");
        echo '<script type="text/javascript">window.location="student.php?act=2";</script>';
    }
}
		  }
}
}
}

// Rest of your code remains the same...





if(isset($_GET['action']) && $_GET['action']=="delete"){

	$idToDelete = mysqli_real_escape_string($conn, $_GET['id']);
    $conn->query("DELETE FROM student WHERE id = '$idToDelete'");
header("location: student.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM student WHERE id='".$id."'");
if($sqlEdit->num_rows)
{
$rowsEdit = $sqlEdit->fetch_assoc();
extract($rowsEdit);
$action = "update";
}else
{
$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student record has been added!</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student record has been updated!</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student has been deleted!</div>";
}

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
	
	<link href="css/ui.css" rel="stylesheet" />
	<link href="css/datepicker.css" rel="stylesheet" />	
	
    <script src="js/jquery-1.10.2.js"></script>
  
       
    <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
   
	
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">student 
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="student.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Go Back </a>':'<a href="student.php?action=add" class="btn btn-success btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Add New Student</a>';
						?>
						</h1>
                        
                     
<?php

echo $errormsg;
?>
                    </div>
                </div>
				
				
				
        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {
		?>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
                <div class="row">
				
                    <div class="col-sm-10 col-sm-offset-1">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Add Student Details": "Edit Student Details"; ?>
                        </div>
						<form action="student.php" method="post" id="signupForm1" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        <div class="panel-body">
						<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Personal Information:</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Full Name* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="sname" name="sname" value="<?php echo $sname;?>"  />
								</div>
							</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Contact* </label>
								<div class="col-sm-10">
									<input type="tel" class="form-control" id="contact" name="contact"  value="<?php echo $contact;?>" minlength="9" maxlength="10" />
                                    <?php echo $errormsg; ?>
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Address </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="address" name="address" value="<?php echo $address;?>"  />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">File Upload </label>
								<div class="col-sm-10">
								
								<input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png"> 
									
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Course* </label>
								<div class="col-sm-10">
								<select class="form-control" id="course" name="course">
    <option value="">Select Course Level</option>
    <?php
    $sql = "SELECT course FROM course"; // Retrieve only the course name from the "grade" table
    $q = $conn->query($sql);

    while ($r = $q->fetch_assoc()) {
        echo '<option value="' . $r['course'] . '" ' . (($course == $r['course']) ? 'selected="selected"' : '') . '>' . $r['course'] . '</option>';
    }
    ?>
</select>

								</div>
						</div>
						<?php
						if($action=="add")
						{
						?>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="">Username </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" name="username" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="">password</label>
								<div class="col-sm-10">
								<input type="password" class="form-control" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$" title="Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long." id="password" value="" />
           
								</div>
</div>
<!--
<div class="form-group">
    <label class="col-sm-2 control-label" for="">Confirm password</label>
    <div class="col-sm-10">
        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="" />
        <div id="passwordMatchError" class="error"></div>
    </div>
</div>

                        -->
      <?php
                        }
                        ?>
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">DOJ* </label>
								<div class="col-sm-10">
                                <input type="date" class="form-control"  placeholder="Date of Joining" id="joindate"  name="joindate" value="<?php echo  ($joindate!='')?date("Y-m-d", strtotime($joindate)):'';?>" style="background-color: #fff;" max="<?php echo date('Y-m-d'); ?>" readonly />
								
								</div>
							</div>
						 </fieldset>
						
						
						
							<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Fee Information:</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Total Fees* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="fees" name="fees" value="<?php echo $fees;?>" <?php echo ($action=="update")?"disabled":""; ?>  />
								</div>
						</div>
						
						<?php
						if($action=="add")
						{
						?>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Advance Fee* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="advancefees" name="advancefees" readonly   />
								</div>
						</div>
						<?php
						}
						?>
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Dues </label>
								<div class="col-sm-10">
									<input type="text" class="form-control"  id="balance" name="balance" value="<?php echo $balance;?>" disabled />
								</div>
						</div>
						
						
						
							
							<?php
						if($action=="add")
						{
						?>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Password">Fee Remark </label>
								<div class="col-sm-10">
	                        <textarea class="form-control" id="remark" name="remark"><?php echo $remark;?></textarea >
								</div>
							</div>
						<?php
						}
						?>
							
							</fieldset>
							
							 <fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Optional Information:</legend>
							
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Email Id </label>
								<div class="col-sm-10">
									
									<input type="text" class="form-control" id="emailid" name="emailid" value="<?php echo $emailid;?>"  />
								</div>
						    </div>
							</fieldset>
						
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								
									<button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Save </button>
								 
								   
								   
								</div>
							</div>
                         
                           
                           
                         
                           
                         </div>
							</form>
							
                        </div>
                            </div>
            
			
                </div>
               

			   
			   
		<script type="text/javascript">
		
		
    $(document).ready(function () {
        $("#joindate").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1970:<?php echo date('Y');?>"
        });

        if ($("#signupForm1").length > 0) {
            <?php if ($action == 'add') { ?>
                $("#signupForm1").validate({
                    rules: {
                        
                        joindate: "required",
                        emailid: "email",
                        grade: "required",
                        contact: {
                            required: true,
                            digits: true
                           
                        },
                        fees: {
                            required: true,
                            digits: true
                        },
                        address: {
                            required: true,
                            digits: false
                        },
                        advancefees: {
                            required: true,
                            digits: true
                        },
						sname:{
							required:true,
							digits: false

						}
                       
                    },
                    errorElement: "em",
                    errorPlacement: function (error, element) {
                        error.addClass("help-block");
                        element.parents(".col-sm-10").addClass("has-feedback");
                        if (element.prop("type") === "checkbox") {
                            error.insertAfter(element.parent("label"));
                        } else {
                            error.insertAfter(element);
                        }
                        if (!element.next("span")[0]) {
                            $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                        }
                    },
                    success: function (label, element) {
                        if (!$(element).next("span")[0]) {
                            $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                        }
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).parents(".col-sm-10").addClass("has-error").removeClass("has-success");
                        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).parents(".col-sm-10").addClass("has-success").removeClass("has-error");
                        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                    }
                });
            <?php } else { ?>
                $("#signupForm1").validate({
                    rules: {
                        sname: "required",
                        joindate: "required",
                        emailid: "email",
                        grade: "required",
                        username:"required",
                        password:"required",
                        confirmpassword:"required"
                        contact: {
                            required: true,
                            digits: true
                        }
						sname:{
							required:true,
							digits:false
						},
                       
            // Other rules...
            confirmPassword: {
                required: true,
                equalTo: "#password" // Check if confirmPassword matches password
            }
        },
                    messages: {
            // ...
            confirmPassword: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            }
        },
                    errorElement: "em",
                    errorPlacement: function (error, element) {
                        error.addClass("help-block");
                        element.parents(".col-sm-10").addClass("has-feedback");
                        if (element.prop("type") === "checkbox") {
                            error.insertAfter(element.parent("label"));
                        } else {
                            error.insertAfter(element);
                        }
                        if (!element.next("span")[0]) {
                            $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                        }
                    },
                    success: function (label, element) {
                        if (!$(element).next("span")[0]) {
                            $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                        }
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).parents(".col-sm-10").addClass("has-error").removeClass("has-success");
                        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).parents(".col-sm-10").addClass("has-success").removeClass("has-error");
                        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                    }
                });
            <?php } ?>
        }
    });


		
		$("#fees").keyup( function(){
		$("#advancefees").val("");
		$("#balance").val(0);
		var fee = $.trim($(this).val());
		if( fee!='' && !isNaN(fee))
		{
		$("#advancefees").removeAttr("readonly");
		$("#balance").val(fee);
		$('#advancefees').rules("add", {
            max: parseInt(fee)
        });
		
		}
		else{
		$("#advancefees").attr("readonly","readonly");
		}
		
		});
		
		
		
		
		$("#advancefees").keyup( function(){
		
		var advancefees = parseInt($.trim($(this).val()));
		var totalfee = parseInt($("#fees").val());
		if( advancefees!='' && !isNaN(advancefees) && advancefees<=totalfee)
		{
		var balance = totalfee-advancefees;
		$("#balance").val(balance);
		
		}
		else{
		$("#balance").val(totalfee);
		}
		
		});
		
		
	</script>


			   
		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Student  
                        </div>
                        <div class="panel-body">
                            <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
											<th>Photo</th>
                                            <th>Name | Contact</th>
											<th>Address</th>
											<th>course</th>
                                            <th>Joined On</th>
                                            <th>Fees</th>
											<th>Dues</th>
											<th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select * from student";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
									
									echo '<tr '.(($r['balance']>0)?'class="primary"':'').'>
                                            <td>'.$i.'</td>
											<td> <img src="img/' . $r['image'] . '" width="70px" title="' . $r['image'] . '" > </td>

											<td>'.$r['sname'].'<br/>'.$r['contact'].'</td>
                                            <td>'.$r['address'].''.'</td>
											<td>'.$r['course'].''.'</td>
                                            <td>'.date("d M y", strtotime($r['joindate'])).'</td>
                                            <td>'.$r['fees'].'</td>
											<td>'.$r['balance'].'</td>
											<td>
										
											<a href="student.php?action=edit&id='.$r['id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="student.php?action=delete&id='.$r['id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a> </td>
											
                                        </tr>';
										$i++;
									}
									?>
									
                                        
                                        
                                    </tbody>
                                </table>
                                <div class="text-center">
    <button class="btn btn-primary" onclick="printTable()">Print Report</button>
</div>
                            </div>
                        </div>
                    </div>
                     
	<script src="js/dataTable/jquery.dataTables.min.js"></script>
    <script>
function printTable() {
    var printContents = document.getElementById("tSortable22").outerHTML;
    var originalContents = document.body.innerHTML;
    var table = document.getElementById("tSortable22");

    // Remove last cell from each row (Actions column)
    for (var i = 0; i < table.rows.length; i++) {
        table.rows[i].deleteCell(-1);
    }

    document.body.innerHTML = table.outerHTML;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
     <script>
         $(document).ready(function () {
             $('#tSortable22').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
	
         });
		 
	
    </script>
    
		
		<?php
		}
		?>
	
            
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
