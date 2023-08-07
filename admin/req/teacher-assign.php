<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
    	

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['teacher_id']) &&
    isset($_POST['address'])  &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])  &&
    isset($_POST['qualification']) &&
    isset($_POST['email_address']) &&
    isset($_POST['gender'])        &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['sections'])       &&
    isset($_POST['subjects'])   &&
    isset($_POST['grades'])) {
    
    include '../../DB_connection.php';
    include "../data/teacher.php";



    $teacher_id = $_POST['teacher_id'];
    
    $grades = "";
    foreach ($_POST['grades'] as $grade) {
    	$grades .=$grade;
    }

    $subjects = "";
    foreach ($_POST['subjects'] as $subject) {
    	$subjects .=$subject;
    }

    $sections = "";
    foreach ($_POST['sections'] as $section) {
        $sections .=$section;
    }

    $data = 'teacher_id='.$teacher_id;

    }else {
        $sql = "UPDATE teachers SET
                username = ?, subjects=?, grades=?,section=?
                WHERE teacher_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([ $subjects, $grades, $gender, $sections, $teacher_id]);
        $sm = "successfully updated!";
        header("Location: ../Assign.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: Assign.php?error=$em");
    exit;
  }


  

