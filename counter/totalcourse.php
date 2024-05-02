<?php

    $servername="localhost";
    $uname="root";
    $pass="";
    $database="institutesys";

    $conn=mysqli_connect($servername,$uname,$pass,$database);

if(!$conn){
    die("Connection Failed");
}

    $sql = "SELECT * FROM course";
    $query = $conn->query($sql);
    echo "$query->num_rows";
?>