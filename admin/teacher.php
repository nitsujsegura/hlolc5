<?php 
session_start();
if (isset($_SESSION['admin_id']))

   {
       include "../DB_connection.php";
       include "data/teacher.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/class.php";
       include "data/section.php";
       $teachers = getAllTeachers($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Teachers</title>
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
</head>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($teachers != 0) {
     ?>
     <br><hr><br>
     <div class="container mt-2">
        <a href="teacher-add.php"
           class="btn btn-dark">Add New Teacher</a> <br><br>
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
                    
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Class</th>
                    <th scope="col">Action</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($teachers as $teacher ) { 
                    $i--;  ?>
                  <tr>
                   
                    <td><?=$teacher['teacher_id']?></td>
                    <td><a href="teacher-view.php?teacher_id=<?=$teacher['teacher_id']?>">
                         <?=$teacher['fname']?></a></td>
                    <td><?=$teacher['lname']?></td>
                    <td><?=$teacher['username']?></td>
                    <td>
                       <?php 
                           $s = '';
                           $subjects = str_split(trim($teacher['subjects']));
                           foreach ($subjects as $subject) {
                              $s_temp = getSubjectById($subject, $conn);
                              if ($s_temp != 0) 
                                $s .=$s_temp['subject_code'].', ';
                           }
                           echo $s;
                        ?>
                    </td>
                    <td>
                      <?php 
                           $c = '';
                           $classes = str_split(trim($teacher['grades']));

                           foreach ($classes as $class_id) {
                               $class = getClassById($class_id, $conn);

                              $c_temp = getGradeById($class['grade'], $conn);
                              $section = getSectioById($class['section'], $conn);
                              if ($c_temp != 0) 
                                $c .=$c_temp['grade_code'].
                                     $c_temp['grade'].'-'.$section['section'].', ';
                           }
                           echo $c;

                        ?>
                    </td>
                    <td>
                        <a href="teacher-edit.php?teacher_id=<?=$teacher['teacher_id']?>"
                           class="btn btn-warning">Edit</a>
                    </td>
                    <td>
        
                  

        <?php

          if ($teacher['status']==1){
          echo '<p> <a href = "req/teacher_status.php?teacher_id='.$teacher['teacher_id'].'&status=0" class = "btn btn-success">Active</a></p>';
          
          }else{
           echo '<p> <a href = "req/teacher_status.php?teacher_id='.$teacher['teacher_id'].'&status=1" class = "btn btn-danger">Deactive</a></p>';
         }                 
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
             $("#navLinks li:nth-child(2) a").addClass('active');
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