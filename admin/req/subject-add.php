<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
    	

if (isset($_POST['subject_code']) &&
    isset($_POST['subject'])) {
    
    include '../../DB_connection.php';


    $subject_code = $_POST['subject_code'];
    $subject = $_POST['subject'];
   

    

    $data = 'subject_code='.$subject_code.'&subject='.$subject;

    if (empty($subject_code)) {
		$em  = "subject_code is required";
		header("Location: ../subject-add.php?error=$em&$data");
		exit;
	}else if (empty($subject)) {
		$em  = "subject is required";
		header("Location: ../subject-add.php?error=$em&$data");
		exit;
	
    }else {
        $sql  = "INSERT INTO
                 subjects(subject_code, subject)
                 VALUES(?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$subject_code, $subject]);
        $sm = "New Subject registered successfully";
        header("Location: ../subject-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../subject-add.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  }