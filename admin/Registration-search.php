<?php 
session_start();
if (isset($_SESSION['admin_id'])){

       if (isset($_GET['searchKey'])) {

       $search_key = $_GET['searchKey'];
       include "../DB_connection.php";
       include "../Registration_data/Reg.php";
       include "data/grade.php";
       $registration = searchRegistration($search_key, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Search Registration</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($registration != 0) {
     ?>

           <form action="Registration-search.php" 
                 class="mt-3 n-table"
                 method="post">
             <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchKey"
                       placeholder="Search...">
                <button class="btn btn-primary">
                        <i class="fa fa-search" 
                           aria-hidden="true"></i>
                      </button>
             </div>
           </form>

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
              <table class="table table-bordered mt-3 ">
                <thead>
                  <tr>
                    <th scope="col">Name of Student</th>
                    <th scope="col">Age</th>
                    <th scope="col">gender</th>
                    <th scope="col">Present Address</th>
                    <th scope="col">Child's Birthday</th>
                    <th scope="col">Type of Student</th>
                    <th scope="col">Incoming Grade</th>
                    <th scope="col">Father's Name</th>
                    <th scope="col">Mother' Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of submission</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=11; foreach ($registration as $registration ) { 
                    $i-- ?> 
                  <tr>
                    <td><?=$registration['Name_of_student']?></td>
                    <td><?=$registration['Age']?></td>
                    <td><?=$registration['gender']?></td>
                    <td><?=$registration['Present_address']?></td>
                    <td><?=$registration['Child_birthday']?></td>
                    <td><?=$registration['Type_of_student']?></td>
                    <td>
                      <?php 
                           $grade = $registration['grade'];
                           $g_temp = getGradeById($grade, $conn);
                           if ($g_temp != 0) {
                              echo $g_temp['grade_code'].'-'.
                                     $g_temp['grade'];
                            }
                        ?>         
                    <td><?=$registration['Father_Name']?></td>
                    <td><?=$registration['Mother_name']?></td>
                    <td><?=$registration['Email']?></td>
                    <td><?=$registration['date_of_submission']?></td>
                    
                  </tr>
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                    No Results Found
                 <a href="registration.php"
                   class="btn btn-dark">Go Back</a>
              </div>
         <?php } ?>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 
   }else {
      header("Location: registration.php");
      exit;
    } 

  }else {
    header("Location: ../login.php");
    exit;
  } 

 

?>