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
       $School_year = getAllSchoolYear($conn);

  
    

  
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
        <a href="subjects.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/add-class.php">
        <h3>Add Class</h3><hr>
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
        <div class="mb-3">
          <label class="form-label">School Year</label>
          <div class="row row-cols-5">
            <?php foreach ($School_year as $School_years): ?>
            <div class="col">
              <input type="radio"
                     name="school_year"
                     value="<?=$School_years['school_year']?>">
                     <?=$School_years['school_year']?>
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