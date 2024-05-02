<?php

session_start();
if(!isset($_SESSION['username'])){
echo '<script type="text/javascript">window.location="login.php"; </script>';
}

$page = 'report';
include("php/dbconnect.php");


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rainbow Academy</title>
    <link rel="icon" type="image/png" href="./logo/logo.png"/>
    <!-- BOOTSTRAP STYLES -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES -->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM BASIC STYLES -->
    <link href="css/basic.css" rel="stylesheet" />
    <!-- CUSTOM MAIN STYLES -->
    <link href="css/custom.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="/logo/logo.png"/>
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link href="css/ui.css" rel="stylesheet" />
    <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
    <link href="css/datepicker.css" rel="stylesheet" />
    <link href="css/datatable/datatable.css" rel="stylesheet" />
</head>

<body>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line"> Reports</h1>
            </div>
        </div>

       

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
                                <th>Balance</th>
                                <th>Course</th>
                                <th>DOJ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch data from the database and populate the table rows
                            $sql = "SELECT * FROM student";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['sname'] . '</td>';
                                echo '<td>' . $row['fees'] . '</td>';
                                echo '<td>' . $row['balance'] . '</td>';
                                echo '<td>' . $row['course'] . '</td>';
                                echo '<td>' . $row['joindate'] . '</td>';
                                echo '<td><button class="btn btn-primary btn-sm" onclick="GetFeeForm(' . $row['id'] . ')">View Details</button></td>';
                                echo '</tr>';
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fee Report</h4>
            </div>
            <div class="modal-body" id="formcontent">
            
            </div>
            <div class="modal-footer">
            <center>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="printButton"><i class="fa fa-print"></i> Print</button>
                    </center>
                <button type="button" class="btn btn-danger" style="border-radius:0%" data-dismiss="modal">Close</button>
                
            </div>
            
        </div>
    </div>
</div>
                
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
<!-- SCRIPTS -->
<script src="js/jquery-1.10.2.js"></script>
<script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.metisMenu.js"></script>
<script src="js/custom1.js"></script>
<script type="text/javascript">
    function GetFeeForm(sid) {
        $.ajax({
            type: 'post',
            url: 'reportprint.php',
            data: {
                student: sid,
                req: '1'
            },
            success: function(data) {
                $('#formcontent').html(data);
                $("#myModal").modal({
                    backdrop: "static"
                });
            }
        });
    }

    //print the bill 
// Wait for the document to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById("myModal");
  var printButton = document.getElementById("printButton");

  printButton.addEventListener('click', function() {
    var modalContent = modal.querySelector(".modal-content");
    var modalClone = modalContent.cloneNode(true);

    // Remove the footer from the cloned content
    var modalFooter = modalClone.querySelector(".modal-footer");
    modalFooter.parentNode.removeChild(modalFooter);

    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write(modalClone.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
  });
});




		


</script>
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






</body>
</html>
