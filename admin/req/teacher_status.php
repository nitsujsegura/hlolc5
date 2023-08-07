<?php
include "../../DB_connection.php";

$teacher_id =$_GET['teacher_id'];
$status = $_GET['status'];
$update = "UPDATE teachers SET status=$status where teacher_id=$teacher_id";
mysqli_query($db,$update);
header('location:../teacher.php');

?>
