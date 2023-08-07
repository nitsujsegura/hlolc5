<?php 
session_start();
if (isset($_SESSION['teacher_id'])) {
  
       include "../DB_connection.php";
       include "../admin/data/subject.php";
       include "../admin/data/grade.php";
       include "../admin/data/teacher.php";
       include "../admin/data/School_year.php";
       include "data/modules.php";
       $modules = getAllModules($conn);
       $subjects = getAllSubjects($conn);
       $grades = getAllGrades($conn);
       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);
    
 
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Students</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  <script src = "css/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/cbfa8b25c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($teacher != 0) {
     ?>
     <br><hr><br>
     <div class="container mt-2">
        <a href="modules-add.php"
           class="btn btn-dark">Add New Module</a> <br><br>
           <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" 
                 role="alert">
              <?=$_GET['error']?>
            </div>
            <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" 
                 role="alert">
              <?=$_GET['success']?>
            </div>
            <?php } ?>

           <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered mt-3  ">
                <thead>
                  <tr>
                    <th scope="col">Grade</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Module Name</th>
                    <th scope="col">Module Desciption</th>
                    <th scope="col">Module</th>
                    <th scope="col">Action</th>
              
                  </tr>
                </thead>
                <tbody>
                  
                  <?php  $i='.';foreach ($modules as $module ) { 
                   $i++ ?>
                  <tr>
                
                    <td> 
                         <?php 
                           $grade = $module['grade_id'];
                           $g_temp = getGradeById($grade, $conn);
                           if ($g_temp != 0) {
                              echo $g_temp['grade_code'].'-'.
                                     $g_temp['grade'];
                            }
                        ?>
                        </td>
                    <td> 
                        <?php 
                           $subject = $module['subject_id'];
                           $g_temp = getSubjectById($subject, $conn);
                           if ($g_temp != 0) {
                              echo $g_temp['subject_code'];
                            }
                        ?>
                        </td>
                    <td><?=$module['module_name']?></td>
                    <td><?=$module['module_desc']?></td>
                    <td><?=$module['module']?></td>
                   
                  
                 
                    <td>
                      
        
                     <a href="<?php echo $module["module"];?>" download="<?php echo $module["module"]; ?>">
                     <i class="fa-solid fa-download" class = "vertical-align-left"> </i>
                              </a> 

                    <a href="delete-module.php?teacher_id=<?=$module['module_id']?>"
                    i class="fa-solid fa-trash" style="color: #fa0000;"></a>

                    
                            
                            </td>
        
                  

                   <?php

                    
?>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
     </div>
     <br><hr><br>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(3) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 


?>