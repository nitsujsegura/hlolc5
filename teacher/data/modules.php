<?php 

function getAllModules($conn){
   $sql = "SELECT * FROM module_tbl";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $modules = $stmt->fetchAll();
     return $modules;
   }else {
    return 0;
   }
}
function removeModule($id, $conn){
    $sql  = "DELETE FROM module_tbl
            WHERE module_id=?";
    $stmt = $conn->prepare($sql);
    $re   = $stmt->execute([$id]);
    if ($re) {
      return 1;
    }else {
     return 0;
    }
 }

function getModuleById($module_id, $conn){
   $sql = "SELECT * FROM module_tbl
           WHERE module_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$module_id]);

   if ($stmt->rowCount() == 1) {
     $module = $stmt->fetch();
     return $module;
   }else {
    return 0;
   }
}