<?php 
session_start();
if (isset($_SESSION['teacher_id'])) {
    	
    include '../../DB_connection.php';

$grade = $_POST['grade_id'];
$subject = $_POST['subject'];
$School_years = $_POST['school_year'];
$teacher_id = $_POST['teacher_id'];

$data ='grade_id='.$grade.'&subject='.$subject.'&school_year='.$School_years.'&Present_address='.'&teacher_id='.$teacher_id;


if (empty($grade)) {
    $em  = "grade is required";
    header("Location: ../add-class.php?error=$em&$data");
    exit;
}else if (empty($subject)) {
    $em  = "subject is required";
    header("Location: ../add-class.php?error=$em&$data");
    exit;
}else if (empty($School_years)) {
        $em  = "School Year is required";
        header("Location: ../add-class.php?error=$em&$data");
        exit;
    
    

}else {
    $sql  = "INSERT INTO
             class_teacher(teacher_id, class_id, subject_id,school_year)
             VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id, $grade,$subject,$School_years]);
    $sm = "New Class registered successfully";
    header("Location: ../add-class.php?success=$sm");
    exit;
}

}else {
  $em = "An error occurred";
header("Location: ../subject-add.php?error=$em");
exit;
}

