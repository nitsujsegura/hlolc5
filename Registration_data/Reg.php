<?php 


function getAllregistration($conn){
   $sql = "SELECT * FROM registration2 ORDER BY registration_id DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $registration = $stmt->fetchAll();
     return $registration;
   }else {
   	return 0;
   }
}


// Get Registration By Id 
function getRegistrationById($id, $conn){
    $sql = "SELECT * FROM registration2
            WHERE registration_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() == 1) {
      $registration = $stmt->fetch();
      return $registration;
    }else {
     return 0;
    }
 }
 
 // Search 
 function searchRegistration($key, $conn){
  $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);
  $sql = "SELECT * FROM registration2
          WHERE registration_id LIKE ?
          OR Name_of_student LIKE ?
          OR Age LIKE ?
          OR gender LIKE ? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$key, $key, $key, $key]);

  if ($stmt->rowCount() == 1) {
    $registration = $stmt->fetchAll();  
    return $registration;
  }else {
   return 0;
  }
}