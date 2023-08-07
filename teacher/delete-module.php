<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_GET['teacher_id'])) {


     include "../DB_connection.php";
     include "data/modules.php";

     $id = $_GET['teacher_id'];
     if (removeModule($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: Modules.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: teacher.php?error=$em");
        exit;
     }


  }else {
    header("Location: teacher.php");
    exit;
  } 

