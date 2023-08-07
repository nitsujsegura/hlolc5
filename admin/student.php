<?php 
session_start();
if (isset($_SESSION['admin_id'])) {

  
       include "../DB_connection.php";
       include "data/student.php";
       include "data/grade.php";
     
       $students = getAllStudents($conn);
    
 
       
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
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($students != 0) {
     ?>
     <br><hr><br>
     <div class="container mt-2">
        <a href="student-add.php"
           class="btn btn-dark">Add New Student</a> <br><br>


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
                    <th scope="col">LRN</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Action</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php  $i='.';foreach ($students as $student ) { 
                   $i++ ?>
                  <tr>
                
                    <td><?=$student['student_id']?></td>
                    <td><?=$student['lrn']?></td>
                    <td>
                      <a href="student-view.php?student_id=<?=$student['student_id']?>">
                        <?=$student['first_name']?>
                      </a>
                    </td>
                    <td><?=$student['last_name']?></td>
                    <td><?=$student['username']?></td>
                    <td>
                      <?php 
                           $grade = $student['grade'];
                           $g_temp = getGradeById($grade, $conn);
                           if ($g_temp != 0) {
                              echo $g_temp['grade_code'].'-'.
                                     $g_temp['grade'];
                            }
                        ?>
                    </td>
                    <td>
                        <a href="student-edit.php?student_id=<?=$student['student_id']?>"
                           class="btn btn-warning">Edit</a>

                       
                    </td>
                    <td>
        
                  

                   <?php

                     if ($student['status']==1){
                     echo '<p> <a href = "req/active.php?student_id='.$student['student_id'].'&status=0" class = "btn btn-success">Active</a></p>';
                     
                     }else{
                      echo '<p> <a href = "req/active.php?student_id='.$student['student_id'].'&status=1" class = "btn btn-danger">Deactive</a></p>';
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