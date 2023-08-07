<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
    	

if (isset($_POST['subject_code'])      &&
    isset($_POST['subject'])) {
    
    include '../../DB_connection.php';
    include "../data/subject.php";

    $subject_code = $_POST['subject_code'];
    $subject = $_POST['subject'];

 

    $data = 'subject_id='.$subject_id;

    if (empty($subject_code)) {
		$em  = "subject_code is required";
		header("Location: ../subject-edit.php?error=$em&$data");
		exit;
	}else if (empty($subject)) {
		$em  = "subject is required";
		header("Location: ../subject-edit.php?error=$em&$data");
		exit;
    }else {
        $sql = "UPDATE subjects SET
                subject_code = ?, subject=?
                WHERE subject_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$subject_code,$subject,$subject_id]);
        $sm = "successfully updated!";
        header("Location: ../subject-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../subject.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  }
  


