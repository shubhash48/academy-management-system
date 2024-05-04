
<?php
session_start();
include("php/dbconnect.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$page='grade';
?>

<?php 


$errormsg = '';
$action = "add";
$username='';
$emailid='';
$password='';


if(isset($_POST['save'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $emailid = mysqli_real_escape_string($conn, $_POST['emailid']);

	// encrypted the password
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
 
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
        $sql = "INSERT INTO admin (username,password,role,emailid,image) VALUES ('$username','$password','$emailid','$newImageName')";
        $conn->query($sql);
        
        header("Location: admin.php?act=1");
        exit;
    } else if ($_POST['action'] == "update") {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        $sql = "UPDATE admin SET username='$username', password='$password',  emailid='$emailid',  image='$newImageName' WHERE id='$id'";
        $conn->query($sql);
        
        header("Location: admin.php?act=2");
        exit;
    }
}
		  }
		}
	}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $idToDelete = mysqli_real_escape_string($conn, $_GET['id']);
    $conn->query("DELETE FROM admin WHERE id = '$idToDelete'");
    
    header("Location: admin.php?act=3");
    exit;
}

$action = "add";
if(isset($_GET['action']) && $_GET['action'] == "edit" ){
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';
    
    $sqlEdit = $conn->prepare("SELECT * FROM admin WHERE id = ?");
    $sqlEdit->bind_param("i", $id);
    $sqlEdit->execute();
    $result = $sqlEdit->get_result();
    
    if($result->num_rows) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $password = $row['password'];
     
		$emailid=$row['emailid'];
		$newImageName=$row['image'];
        $action = "update";
    } else {
        $_GET['action'] = "";
    }
}








if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> Admin has been added successfully</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'> Admin has been updated successfully</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'> Admin has been deleted successfully</div>";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Academy  Management System</title>

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
                        <h1 class="page-head-line">Admin ID Password Creation
					
						

						
						
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
                           <?php echo ($action=="add")? "Add Admin": "Edit Admin"; ?>
                        </div>
						<form action="admin.php" method="post" id="signupForm1" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        <div class="panel-body">
						
						
						
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="">Username </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" required name="username" value="<?php echo $username;?>"  />
								</div>
							</div>
							
							
							
							
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Confirm">Email id</label>
								<div class="col-sm-10">
									    <input type="text" class="form-control"  required name="emailid" id="emailid" value="<?php echo $emailid;?>" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="">password</label>
								<div class="col-sm-10">
								<?php if ($action == "edit") { ?>
            <input type="password" class="form-control" name="password" id="password"   disabled value="<?php echo $password; ?>"/>
            <small class="text-muted">Password cannot be edited during editing.</small>
        <?php } else { ?>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" />
        <?php } ?>
								</div>
		 
							</div>
                           
						

							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">File Upload </label>
								<div class="col-sm-10">
								
								<input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png"> 
									
								</div>
						</div>
							
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
         <?php 
         } else {
			?>
			<link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
			<div class="panel panel-default">
							<div class="panel-heading">
							 Admin List
							</div>
							<div class="panel-body">
								 <div class="table-sorting table-responsive">
	
									<table class="table table-striped table-bordered table-hover" id="tSortable22">
										<thead>
											<tr>
												<th>#</th>
												<th>Image</th>
												<th>username</th>
												<th>Email</th>
											
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
										<?php
		$sql = "select * from admin";
		$q = $conn->query($sql);
		$i = 1;
		while ($r = $q->fetch_assoc()) {
			echo '<tr>
					<td>'.$i.'</td>
					<td> <img src="img/' . $r['image'] . '" width="70px" title="' . $r['image'] . '"></td>
					<td>'.$r['username'].'</td>
					<td>'.$r['emailid'].'</td>
				
					
					<td>
						<a href="admin.php?action=edit&id='.$r['id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
						<a onclick="return confirm(\'Are you sure you want to delete this record?\');" href="admin.php?action=delete&id='.$r['id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a>
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
         
               