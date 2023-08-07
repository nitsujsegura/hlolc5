<?php 


function getAllSchoolYear($conn){
   $sql = "SELECT * FROM school_year";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $School_year = $stmt->fetchAll();
     return $School_year;
   }else {
   	return 0;
   }
}

// Get Subjects by ID
function getSchoolYearById($school_year_id, $conn){
   $sql = "SELECT * FROM school_year
           WHERE school_year_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$school_year_id]);

   if ($stmt->rowCount() == 1) {
     $school_year_id = $stmt->fetch();
     return $school_year_id;
   }else {
   	return 0;
   }
}

 ?>