<?php 
session_start();
if (isset($_SESSION['admin_id'])) {

  
       include "../DB_connection.php";
       include "data/subject.php";
  
    $subjects = getAllSubjects($conn)
    
 
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Subjects</title>
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
        if ($subjects != 0) {
     ?>
     <br><hr><br>
     <div class="container mt-2">
        <a href="Subject-add.php"
           class="btn btn-dark">Add New Subject</a> <br><br>

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
                    
                    <th scope="col">Subject Code</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php  $i='.';foreach ($subjects as $subject ) { 
                   $i++ ?>
                  <tr>
                
                    <td><?=$subject['subject_code']?></td>
                    <td><?=$subject['subject']?></td>
    
                    <td>
                        <a href="subject-edit.php?subject_id=<?=$subject['subject_id']?>"
                           class="btn btn-warning">Edit</a>   
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
             $("#navLinks li:nth-child(6) a").addClass('active');
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