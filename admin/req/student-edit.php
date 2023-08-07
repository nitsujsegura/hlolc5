<<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
        

 
    include '../../DB_connection.php';
    include "../data/student.php";

   
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $uname = $_POST['username'];

    $lrn = $_POST['lrn'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['guardian_parent_first_name'];
    $parent_lname = $_POST['guardian_parent_last_name'];
    $parent_phone_number = $_POST['guardian_parent_phone_number'];

    $student_id = $_POST['student_id'];
    
    $grade = $_POST['grade'];
    $section = $_POST['section'];

    $data = 'student_id='.$student_id;

    
    if (empty($first_name)) {
            $em  = "First name is required";
            header("Location: ../student-edit.php?error=$em&$data");
            exit;
    }else if (empty($last_name)) {
        $em  = "Last name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em  = "Username is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($lrn)) {
        $em  = "LRN is required";}
        if(!preg_match('/^[0-9]{12}+$/', $lrn)){
            $em  = "LRN is invalid!";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn, $student_id)) {
        $em  = "Username is taken! try another";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($religion)) {
        $em  = "Religion is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Parent first name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_lname)) {
        $em  = "Parent last name is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Parent phone number is required";}
        if(!preg_match('/^[0-9]{11}+$/', $parent_phone_number)){
            $em = "Parent's Phone number is invalid!";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Section is required";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
   
    }else {

        
        $sql = "UPDATE students SET
                username = ?, first_name=?, last_name=?, grade=?,section=?, address=?, lrn=?, gender = ?, religion=?, date_of_birth=?, guardian_parent_first_name=?,guardian_parent_last_name=?,guardian_parent_phone_number=?
                WHERE student_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname,$first_name, $last_name, $grade,$section, $address,$lrn,$gender, $religion, $date_of_birth, $parent_fname, $parent_lname,$parent_phone_number, $student_id]);
        $sm = "successfully updated!";
        header("Location: ../student-edit.php?success=$sm&$data");
        exit;
    }
    
  }else {
    $em = "An error occurred";
    header("Location: ../student.php?error=$em");
    exit;
  }

  