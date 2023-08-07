<?php 
session_start();
if (isset($_SESSION['admin_id'])) {

 {
    	

if (isset($_POST['section']) &&
    isset($_POST['grade']) &&
    isset($_POST['Classes_id'])) {
    
    include '../../DB_connection.php';

    $section = $_POST['section'];
    $grade = $_POST['grade'];
    $class_id = $_POST['Classes_id'];

    $data = 'Classes_id='.$class_id;

    if (empty($class_id)) {
        $em  = "Class id is required";
        header("Location: ../Class-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Grade is required";
        header("Location: ../Class-edit.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Section is required";
        header("Location: ../Class-edit.php?error=$em&$data");
        exit;
    }else {
        // check if the class already exists
        $sql_check = "SELECT * FROM class 
                      WHERE grade=? AND section=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $section]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "The class already exists";
           header("Location: ../Class-edit.php?error=$em&$data");
           exit;
        }else {

            $sql  = "UPDATE class SET grade=?, section=?
                     WHERE Classes_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$grade, $section, $class_id]);
            $sm = "Class updated successfully";
            header("Location: ../Class-edit.php?success=$sm&$data");
            exit;
       }
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../Class.php?error=$em");
    exit;
  }

 
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 