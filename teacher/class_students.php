<?php 
session_start();
if (isset($_SESSION['teacher_id'])) {
{
       include "../DB_connection.php";
       include "data/student.php";
       include "data/grade.php";
       include "data/class.php";
       include "data/section.php";
       if (!isset($_GET['Classes_id'])) {
           header("Location: MyStudents.php");
           exit;
       }
       $class_id = $_GET['Classes_id'];
       $students = getAllStudents($conn);

       $class = getClassById($class_id, $conn);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher - Students</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
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
        <div class="container mt-5">
       <?php          
         $grade  = getGradeById($class['grade'], $conn);
         $section = getSectioById($class['section'], $conn);
         $c =$grade['grade_code'].'-'.$grade['grade'].' '.$section['section'];
		$school_year_query = "select * from school_year order by school_year DESC";
		$res= mysqli_query($db,$school_year_query);
			if($res){
         $row = $res->fetch_array(MYSQLI_ASSOC);}
								?>
                                <a href="#" class="text-center p-4"><b>My Class</b></a><span class="divider">/</span></li>
                                <a href="#"class="text-center p-3"><?php echo $c; ?></a><span class="divider">/</span></li>
								<a href="#"class="text-center p-3">School Year: <?php echo $row['school_year']; ?></a></li>
                <br><br><br>
                                
     
    <div class="d-grid gap-2 d-md-block">
        <a href="modules.php" class="btn btn-dark gap-2   ">Modules</a></button>
        <a href="modules-add.php" class="btn btn-dark gap-2   ">Assignments</a></button>
        <a href="modules-add.php" class="btn btn-dark gap-2   ">Exams</a></button>
        <a href="modules-add.php" class="btn btn-dark gap-2   ">Grades</a></button>
            </div>

           <h4 class="text-center p-3">Student List</h4>
           <a id="print" onclick="window.print()"  class="btn btn-success"><i class="icon-print"></i> Print Student List</a>
     
  <?php $i = 0; foreach ($students as $student ) { 
       $g = getGradeById($class['grade'], $conn);
       $s = getSectioById($class['section'], $conn);
       if ($g['grade_id'] == $student['grade'] && $s['section_id'] == $student['section']) { $i++; 
       if ($i == 1) { 
    ?>
        <div class="container mt-5">
           <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered mt-3  ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Grade</th>
                  </tr>
                </thead>
                <tbody>  
              <?php } ?>          
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$student['student_id']?></td>
                    <td>
                      <a href="students-grade.php?student_id=<?=$student['student_id']?>">
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
                  </tr>
                <?php } } ?>
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
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(5) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 


  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>