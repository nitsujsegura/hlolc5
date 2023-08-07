<?php 
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_GET['subject_id'])) {
{
      
       include "../DB_connection.php";
       include "data/subject.php";
   
     
    
     
       $subject_id = $_GET['subject_id'];
       $subject = getSubjectById($subject_id, $conn);

       if ($subject == 0) {
         header("Location: subjects.php");
         exit;
       }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Edit Subject</title>
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
        <a href="student.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/subject-edit.php">
        <h3>Edit Subject Information</h3><hr>
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
          <label class="form-label">subject_code</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$subject['subject_code']?>"
                 name="subject_code">
        <?php } ?>
        <div class="mb-3">
          <label class="form-label">subject</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$subject['subject']?>" 
                 name="subject">
        </div>     
          </div>
          <input type="text"
                value="<?=$subject['subject_id']?>"
                name="subject_id"
                hidden>
          <button type="submit" 
              class="btn btn-primary">
              Change</button>
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
    header("Location: subject.php");
    exit;
  }

?>