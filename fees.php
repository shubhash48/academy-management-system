<?php

session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location="login.php"; </script>';
    exit(); // Make sure to exit after redirect
}


$page='fees';


include("php/dbconnect.php");
$sname=$contact='';
$errormsg= '';
$paid='';
$submitdate='';
$rdues='';
$action="edit";
$transcation_remark='';
if(isset($_POST['save'])) {

  $paid = mysqli_real_escape_string($conn, $_POST['paid']);
  $submitdate = $_POST['submitdate'];
  $transcation_remark = mysqli_real_escape_string($conn, $_POST['transcation_remark']);
  $sid = mysqli_real_escape_string($conn,$_POST['id']);

  $sq = $conn->query("SELECT fees,balance FROM student WHERE id='$sid'");
  $sr = $sq->fetch_assoc();
  if($sr){
  $tdues=$sr['balance'];
  if($paid>$tdues){
    echo '<script type="text/javascript">window.location="fees.php?act=2";</script>';              
  }
  else if($tdues>0){

  


    //$sql = "Insert into fees_transaction(stdid,submitdate,transcation_remark,paid) values('$sid','$submitdate','$transcation_remark','$paid') ";
    $conn->query("INSERT INTO fees_transaction (stdid,submitdate,transcation_remark,paid) VALUES ('$sid','$submitdate','$transcation_remark','$paid')");
    
    $rdues=$tdues-$paid;
    $sql = "update student set balance='$rdues' where id = '$sid'";
    $conn->query("UPDATE student SET balance='$rdues' WHERE id = '$sid' ");
    
     echo '<script type="text/javascript">window.location="fees.php?act=1";</script>'; //act 1
   
}
}
}

// success for fee has been submited
if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> Fees has been submitted</div>";
}



if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong>Please Enter paid amount less than dues amount.</div>";
}

if(isset($_GET['action']) && $_GET['action'] == "edit" ){
  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
  
  $sqlEdit = $conn->prepare("SELECT sname,contact,fees,balance FROM student WHERE id = ?");
  $sqlEdit->bind_param("i", $id);
  $sqlEdit->execute();
  $result = $sqlEdit->get_result();
   
  if($result->num_rows) {
    $row = $result->fetch_assoc();
    
    $sname = $row['sname'];
    $contact = $row['contact'];
    $fees= $row['fees'];
$balance=$row['balance'];
    $action = "update";
} else {
    $_GET['action'] = "";
}


  
  
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
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	
	<link href="css/ui.css" rel="stylesheet" />
	<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />	
	<link href="css/datepicker.css" rel="stylesheet" />	
	   <link href="css/datatable/datatable.css" rel="stylesheet" />
	   <link rel="icon" type="image/png" href="./logo/logo.png"/>
    <script src="js/jquery-1.10.2.js"></script>	
    <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
   <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
 
		 <script src="js/dataTable/jquery.dataTables.min.js"></script>
		
		 
	
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Fees  
                        <?php
						    if(isset($_GET['action']) && @$_GET['action']=="edit"){
                echo ' <a href="fees.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Go Back </a>';
                }
			?>
						</h1>
          

                    </div>
                </div>
				
				
				
    	<?php
		echo $errormsg;
		
		 if(isset($_GET['action']) &&  @$_GET['action']=="edit")
		 {
		?>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
      <div class="col-sm-8 col-sm-offset-2">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="edit")? "collect fee": " "; ?>
                        </div>
						<form action="fees.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
		
  <form class="form-horizontal" id="signupForm1" action="fees.php" method="post">
   
  <div class="form-group">
								<label class="col-sm-2 control-label" for="name">Name </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" disabled value="<?php echo $sname ?>"  />
								</div>
							</div>
              


<div class="form-group">
<label class="control-label col-sm-2" for="email">Contact:</label>
<div class="col-sm-10">
  <input type="text" class="form-control" disabled value="<?php echo $contact ?>" />
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="email">Total Fee:</label>
<div class="col-sm-10">
  <input type="text" class="form-control" name="totalfee" id="totalfee" value="<?php echo $fees ?>" disabled />
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="balance">Dues:</label>
<div class="col-sm-10">
  <input type="text" class="form-control" name="balance"  id="balance" value="<?php echo $balance ?>" disabled />
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="email">Paid:</label>
<div class="col-sm-10">
  <input type="text" class="form-control" name="paid"  id="paid"  />
  <span id="error-message" class="text-danger"></span>
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-2" for="email">Date:</label>
<div class="col-sm-10">

  <input type="date" class="form-control" name="submitdate" required id="submitdate" style="background:#fff;" max="<?php echo date('Y-m-d'); ?>" />
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="email">Remark:</label>
<div class="col-sm-10">
  <textarea class="form-control" name="transcation_remark" id="transcation_remark"></textarea>
</div>
</div>





<div class="form-group"> 
<div class="col-sm-offset-2 col-sm-10">
<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
  <button type="submit" class="btn btn-info" style="border-radius:0%" name="save">Submit</button>
</div>
</div>
</form>

		<?php

     }else{
      ?>
    <link href="css/datatable/datatable.css" rel="stylesheet" />

		
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Fees  
                        </div>
                        <div class="panel-body">
                            <div class="table-sorting table-responsive" id="subjectresult">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                          
                                            <th>Name/Contact</th>                                            
                                            <th>Fees</th>
											<th>Dues</th>
											<th>course</th>
											<th>DOJ</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
		$sql = "select * from student";
		$q = $conn->query($sql);
		$i = 1;
		while ($r = $q->fetch_assoc()) {
			echo '<tr>
					<td>'.$r['sname'].'</td>
					<td>'.$r['fees'].'</td>
					<td>'.$r['balance'].'</td>
          <td>'.$r['course'].'</td>
          <td>'.$r['joindate'].'</td>
					
					<td>
						<a href="fees.php?action=edit&id='.$r['id'].'" class="btn btn-primary btn-sm">Collect Fee</a>
		
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
                     
	
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <script>
         $(document).ready(function () {
             $('#tSortable22').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
	
         });
         $(document).ready(function () {
    // Add a custom validation rule
    $.validator.addMethod("lessThanOrEqual", function (value, element, param) {
        return parseFloat(value) <= parseFloat($(param).val());
    }, "Paid amount must be less than or equal to balance.");

    // Initialize the form validation
    <script>
$(document).ready(function () {
    $('#signupForm1').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting

        var paid = parseFloat($('#paid').val());
        var balance = parseFloat($('#balance').val());

        if (paid > balance) {
            alert("Paid amount cannot be greater than the balance.");
        } else {
            // If paid amount is valid, submit the form
            this.submit();
        }
    });
});
</script>

<script src="js/dataTable/jquery.dataTables.min.js"></script>
    
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
		 
	
    </script>
  
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>
    


  <?php
     }
     
     ?>
      <script type="text/javascript">
      // Get references to the input fields and error message element
const balanceInput = document.getElementById("balance");
const paidInput = document.getElementById("paid");
const errorMessage = document.getElementById("error-message");

// Add an event listener to the "paid" input field to perform validation
paidInput.addEventListener("input", function () {
  const balance = parseFloat(balanceInput.value); // Convert balance to a number
  const paid = parseFloat(paidInput.value); // Convert paid amount to a number

  // Check if paid amount is greater than balance
  if (paid > balance) {
    errorMessage.textContent = "Please enter a paid amount less than the dues.";
    paidInput.classList.add("is-invalid"); // Optionally, add a visual indication of the error
  } else {
    errorMessage.textContent = ""; // Clear any previous error message
    paidInput.classList.remove("is-invalid"); // Remove the error indication
  }
});
</script>
</body>
</html>
