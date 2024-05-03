<?php
include './php/dbconnect.php';
if (
	isset($_GET['id'])
) {
	// $data = base64_decode($_GET['data']);
	// $data = json_decode($data, true);
	// echo $data;
	$sql = "SELECT * FROM student WHERE id = '" . $_GET['id'] . "'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if ($row) {
			$dues = $row['balance'];
			$id = $row['id'];
			$fees = $row['fees'];
			$dues = $dues - $fees;
			$sql = "UPDATE student SET balance = 0 WHERE id = $id";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				header('Location: http://127.0.0.1/academy-management-system/student/fees.php?success=1');
			} else {
				echo "server error, please contact administrator";
			}

		} else {
			echo "No data found, server error, please contact the administrator";
		}
		// header('Location: http://localhost/academy-management-system/success.php');
		print_r($result);
	}

}
