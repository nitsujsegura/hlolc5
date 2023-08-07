<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
 
    include '../../DB_connection.php';
    include "../data/student.php";

    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $lrn = $_POST['lrn'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['guardian_parent_first_name'];
    $parent_lname = $_POST['guardian_parent_last_name'];
    $parent_phone_number = $_POST['guardian_parent_phone_number'];

    $grade = $_POST['grade'];
    $section = $_POST['section'];
    

    $data = 'uname='.$uname.'&first_name='.$fname.'&last_name='.$lname.'&address='.$address.'&en='.$lrn.'&gender='.$religion.'&guardian_parent_first_name='.$parent_fname.'&guardian_parent_last_name='.$parent_lname.'&guardian_parent_phone_number='.$parent_phone_number;

    if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Last name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Username is taken! try another";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($lrn)) {
        $em  = "LRN is required";}
        if(!preg_match('/^[0-9]{12}+$/', $lrn)){
            $em = "LRN is invalid!";  
        header("Location: ../student-add.php?error=$em&$data");
        
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($religion)) {
        $em  = "Email address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Parent first name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_lname)) {
        $em  = "Parent last name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Parent phone number is required";}
        if(!preg_match('/^[0-9]{11}+$/', $parent_phone_number)){
            $em = "Parent's Phone number is invalid!"; 
        header("Location: ../student-add.php?error=$em&$data");
        exit;
   
    }else {
       
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql  = "INSERT INTO
                 students(username, password, first_name, last_name, grade,section, address, lrn, gender, religion, date_of_birth, guardian_parent_first_name, guardian_parent_last_name, guardian_parent_phone_number)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $lname, $grade,$section, $address, $lrn, $gender, $religion, $date_of_birth, $parent_fname, $parent_lname, $parent_phone_number]);
        $sm = "New student registered successfully";
        header("Location: ../student-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../student-add.php?error=$em");
    exit;
  }


