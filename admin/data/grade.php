<?php 

function getAllGrades($conn){
   $sql = "SELECT * FROM grades";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $grades = $stmt->fetchAll();
     return $grades;
   }else {
    return 0;
   }
}

function getGradeCode($grade_code, $conn){
  $sql = "SELECT * FROM grades
          WHERE grade_code=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$grade_code]);

  if ($stmt->rowCount() == 1) {
    $grade_code = $stmt->fetch();
    return $grade_code;
  }else {
   return 0;
  }
}

function getGradeById($grade_id, $conn){
   $sql = "SELECT * FROM grades
           WHERE grade_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$grade_id]);

   if ($stmt->rowCount() == 1) {
     $grade = $stmt->fetch();
     return $grade;
   }else {
    return 0;
   }
}