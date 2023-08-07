<?php 
session_start();
if (isset($_SESSION['teacher_id'])) {
  
       include "../DB_connection.php";
       include "../admin/data/subject.php";
       include "../admin/data/grade.php";
       include "../admin/data/teacher.php";
       include "../admin/data/School_year.php";
       $subjects = getAllSubjects($conn);
       $grades = getAllGrades($conn);
       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);

    
 
       $Module_name = '';
       $Module_descrptn = '';
       
       if (isset($_GET['module_name'])) $Module_name = $_GET['module_name'];
       if (isset($_GET['Module_descrptn'])) $Module_descrptn = $_GET['Module_descrptn'];



      
    
    

  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Add Class</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
     <div class="container mt-5">
        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/add-module.php"
              enctype="multipart/form-data">
        <h3>Add Module</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
       
   
        <?php } ?>

        <div class="mb-3">
          <label class="form-label">Module Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Module_name?>" required 
                 name="Module_name">
        </div>
     
        <div class="mb-3">
          <label class="form-label">Module Desciption</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Module_descrptn?>" required 
                 name="Module_descrptn">
        </div>

        <div class="form-group mb-3">
        <label for="module">Module <br></label>
        <br><input type="file" class="form-control-file" name="module" required > 
       
     

        <div class="mb-3">
          <label class="form-label"> Grade Level</label>
          <div class="row row-cols-5">
            <?php foreach ($grades as $grade): ?>
            <div class="col">
              <input type="radio"
                     name="grade_id"
                     value="<?=$grade['grade_id']?>">
                     <?=$grade['grade_code']?>
            </div>
          
            
            <?php endforeach ?>
        
    
        </div>
       
        <div class="mb-3">
          <label class="form-label">Subjects</label>
          <div class="row row-cols-5">
            <?php foreach ($subjects as $subject): ?>
            <div class="col">
              <input type="radio"
                     name="subject"
                     value="<?=$subject['subject_id']?>">
                     <?=$subject['subject']?>
            </div>
          
            
            <?php endforeach ?>
             
          </div>
        </div>
       
        
        <input type="text"
                value="<?=$teacher['teacher_id']?>"
                name="teacher_id"
                hidden>
    
       
        
      
    
        

      <button type="submit" class="btn btn-primary">Add</button>
     </form>
     </div>
     
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