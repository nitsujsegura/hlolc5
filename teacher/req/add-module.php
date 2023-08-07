<?php 
session_start();
if (isset($_SESSION['teacher_id'])) {
    	
    include '../../DB_connection.php';



$grade = $_POST['grade_id'];
$subject = $_POST['subject'];
$Module_name = $_POST['Module_name'];
$teacher_id = $_POST['teacher_id'];
$Module_descrptn =$_POST['Module_descrptn'];


$target="../teacher/Modules/";
$target_file=$target.basename($_FILES['module']["name"]);




$data ='grade_id='.$grade.'&subject='.$subject.'&Module_name='.$Module_name.'&Module_descrptn='.$Module_descrptn.'&target='.$target.'&teacher_id='.$teacher_id;


if (empty($Module_name)) {
    $em  = "Module_name is required";
    header("Location: ../modules.php?error=$em&$data");
    exit;
}else if (empty($Module_descrptn)) {
    $em  = "Module_descrptn is required";
    header("Location: ../modules.php?error=$em&$data");
    exit;
}else if (empty($subject)) {
    $em  = "subject is required";
    header("Location: ../modules.php?error=$em&$data");
    exit;


    

}else {
    move_uploaded_file($_FILES['module']['tmp_name'],$target_file);
    $sql  = "INSERT INTO
             module_tbl(teacher_id, grade_id, subject_id,module_name,module_desc,module)
             VALUES(?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id, $grade,$subject,$Module_name,$Module_descrptn,$target_file]);
    $sm = "New Module added successfully";
    header("Location: ../modules.php?success=$sm");
    exit;
}

}else {
  $em = "An error occurred";
header("Location: ../modules.php?error=$em");
exit;
}

