<?php
include "../../DB_connection.php";

$student_id =$_GET['student_id'];
$status = $_GET['status'];
$update = "UPDATE students SET status=$status where student_id=$student_id";
mysqli_query($db,$update);
header('location:../student.php');

?>
