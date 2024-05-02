
<?php

session_start();
if(!isset($_SESSION['username'])){
echo '<script type="text/javascript">window.location="login.php"; </script>';
}
include("php/dbconnect.php");


?>


<?php


$page = 'course';

$errormsg = '';
$action = "add";

$course = '';
$teacher = '';
$fee = '';
$id = '';

if(isset($_POST['save'])) {
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $teacher = mysqli_real_escape_string($conn, $_POST['teacher']);
    $fee = intval(mysqli_real_escape_string($conn, $_POST['fee']));
    
    if ($_POST['action'] == "add") {
        $sql = "INSERT INTO course (course, teacher, fee) VALUES ('$course', '$teacher', '$fee')";
        $conn->query($sql);
        
        header("Location: course.php?act=1");
        exit;
    } else if ($_POST['action'] == "update") {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        $sql = "UPDATE course SET course='$course', teacher='$teacher', fee='$fee' WHERE id='$id'";
        $conn->query($sql);
        
        header("Location: course.php?act=2");
        exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $idToDelete = mysqli_real_escape_string($conn, $_GET['id']);
    $conn->query("DELETE FROM course WHERE id = '$idToDelete'");
    
    header("Location: course.php?act=3");
    exit;
}

$action = "add";
if(isset($_GET['action']) && $_GET['action'] == "edit" ){
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';
    
    $sqlEdit = $conn->prepare("SELECT * FROM course WHERE id = ?");
    $sqlEdit->bind_param("i", $id);
    $sqlEdit->execute();
    $result = $sqlEdit->get_result();
    
    if($result->num_rows) {
        $row = $result->fetch_assoc();
        $course = $row['course'];
        $teacher = $row['teacher'];
        $fee = $row['fee'];
        $action = "update";
    } else {
        $_GET['action'] = "";
    }
}








if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> Course has been added successfully</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'> Course has been updated successfully</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'> Course has been deleted successfully</div>";
}
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
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
	
    <link rel="icon" type="image/png" href="./logo/logo.png"/>

    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	
	 <script src="js/jquery-1.10.2.js"></script>


	
</head>



<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course and Fee 
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="course.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Go Back </a>':'<a href="course.php?action=add" class="btn btn-success btn-sm pull-right" style="border-radius:0%">
						<i class="glyphicon glyphicon-plus"></i> Add New Course </a>';
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
				
                    <div class="col-sm-8 col-sm-offset-2">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Add Course": "Edit Course"; ?>
                        </div>
						<form action="course.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						
						
						
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Course </label>
								<div class="col-sm-10">
								<input type="text" class="form-control" title="Only letters are allowed" id="course" name="course" value="<?php echo $course;?>" />

								</div>
							</div>
							
							
							
							
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Confirm"> Teacher</label>
								<div class="col-sm-10">
									    <input type="text" class="form-control" required name="teacher"  pattern="[A-Za-z]+(\s[A-Za-z]+)*" title="Only letter are allowed" id="teacher" value="<?php echo $teacher;?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Confirm"> Fee</label>
								<div class="col-sm-10">
									    <input type="number" class="form-control" name="fee" id="fee"  required max="30000" value="<?php echo $fee;?>" />
								</div>
							</div>
						
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id"  value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								
									<button type="submit" name="save" class="btn btn-success" style="border-radius:0%"> Save </button>
								</div>
							</div>
                         
                           
                           
                         
                           
                         </div>
							</form>
							
                        </div>
                            </div>
            
			
                </div>
               

			   
			   
		<script type="text/javascript">
		
		document.addEventListener("DOMContentLoaded", function () {
    var signupForm1 = document.getElementById("signupForm1");

    if (signupForm1) {
        signupForm1.addEventListener("submit", function (event) {
            var gradeInput = document.querySelector("input[name='course']");
            var errorMessage = "Please enter course name";

            if (!gradeInput.value.trim()) {
                event.preventDefault();
                showError(gradeInput, errorMessage);
            } else {
                showSuccess(gradeInput);
            }
        });
    }
});

function showError(inputElement, errorMessage) {
    var errorElement = document.createElement("em");
    errorElement.className = "help-block";
    errorElement.innerText = errorMessage;

    var parentDiv = inputElement.closest(".col-sm-10");
    parentDiv.classList.add("has-feedback", "has-error");
    parentDiv.appendChild(errorElement);

    var iconElement = document.createElement("span");
    iconElement.className = "glyphicon glyphicon-remove form-control-feedback";
    parentDiv.appendChild(iconElement);
}

function showSuccess(inputElement) {
    var parentDiv = inputElement.closest(".col-sm-10");
    parentDiv.classList.add("has-feedback", "has-success");

    var iconElement = document.createElement("span");
    iconElement.className = "glyphicon glyphicon-ok form-control-feedback";
    parentDiv.appendChild(iconElement);
}


	</script>


			   
		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Add course and Fee
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course</th>
                                            <th>Teacher</th>
											<th>Fee</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
    $sql = "select * from course";
    $q = $conn->query($sql);
    $i = 1;
    while ($r = $q->fetch_assoc()) {
        echo '<tr>
                <td>'.$i.'</td>
                <td>'.$r['course'].'</td>
                <td>'.$r['teacher'].'</td>
                <td>'.$r['fee'].'</td>
                <td>
                    <a href="course.php?action=edit&id='.$r['id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
                    <a onclick="return confirm(\'Are you sure you want to delete this record?\');" href="course.php?action=delete&id='.$r['id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>';
        $i++;
    }
?>
									
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     
	<script src="js/dataTable/jquery.dataTables.min.js"></script>
    <script>
         $(document).ready(function () {
             $('#tSortable22').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
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
