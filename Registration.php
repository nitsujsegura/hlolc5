<?php 
session_start();


        
        include "DB_connection.php";
       include "admin/data/grade.php";

error_reporting(0);
       $grades = getAllGrades($conn);
       $Email ='';
       $Contact_Number = '';
       $Present_address= '';
       $First_name= '';
       $Middle_name= '';
       $Last_name= '';
       $Age = '';
       $Type_of_student = '';
       $Child_birthday = '';
       $gender = '';
       $Father_Name = '';
       $Mother_name = '';
       
    
      
       if (isset($_GET['Registration_id'])) $registration_id = $_GET['Registration_id'];

       if (isset($_GET['Email'])) $Email = $_GET['Email'];
       if (isset($_GET['First_name'])) $First_name = $_GET['First_name'];
       if (isset($_GET['Middle_name'])) $Middle_name = $_GET['Middle_name'];
       if (isset($_GET['Last_name'])) $Last_name = $_GET['Last_Name'];
       if (isset($_GET['Contact_Number'])) $Contact_Number = $_GET['Contact_Number'];
       if (isset($_GET['Present_address'])) $Present_address = $_GET['Present_address'];
       if (isset($_GET['Age'])) $Age = $_GET['Age'];
       if (isset($_GET['Type_of_student'])) $Type_of_student = $_GET['Type_of_student'];
       if (isset($_GET['Child_birthday'])) $Child_birthday = $_GET['Child_birthday'];
       if (isset($_GET['gender'])) $gender = $_GET['gender'];
       if (isset($_GET['Father_Name'])) $Father_Name = $_GET['Father_Name'];
       if (isset($_GET['Mother_name'])) $Mother_name = $_GET['Mother_name'];

       $query2 = "SELECT *FROM registration2 ORDER BY Registration_id DESC LIMIT 1";
       $res= mysqli_query($db,$query2);
       if($res){
       $row = $res->fetch_array(MYSQLI_ASSOC);
       $last_id = $row['Registration_id'];
       if($last_id == NULL){
        
          $newrollno= "R220954000";
        }
        else{
            $newrollno= str_replace("R220954","",$last_id);
            $newrollno= str_pad($newrollno+1,0);
            $newrollno= "R220954". $newrollno;
        }
      
       }
  
     
      if(isset($_POST['submit'])){
        $newrollno=$_POST['Registration_id'];
        $insert = "INSERT INTO 'registration2'('registration_id) VALUES ('$newrollno')";
      }

     
    
      
      

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  
  
    
     <div class="container mt-5">
        <a href="index.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="../School Management System/Registration_data/Req_data.php"
              enctype="multipart/form-data">
        <h3>Student Registration Form</h3><hr>
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
          <label class="form-label">Registration Number</label>
          <input type="text" 
                 class="form-control bg-secondary text-white"
                 value="<?php echo $newrollno?>"
                 name="Registration_id" readonly>
        </div>
        
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Email?>" 
                 name="Email">
        </div>
        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Contact_Number?>"
                 name="Contact_Number"
                 minlength="11"          
                 maxlength="11">                
        </div>
        <div class="mb-3">
          <label class="form-label">Present Address</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Present_address?>"
                 name="Present_address">
        </div>
        <div class="mb-3">
          <label class="form-label">First Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$First_name?>"
                 name="First_name">
                 
                 <div class="mb-3">
          <label class="form-label">Middle Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Middle_name?>"
                 name="Middle_name">
          <label class="form-label">Last Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Last_name?>"
                 name="Last_name">
        <div class="mb-3">
          <label class="form-label">Age</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Age?>"
                 name="Age"
                 maxlength="2">
         <div class="mb-3">
          <label class="form-label">Type of Student</label><br>
          <input type="radio"
                 value="New_Student"
                 checked 
                 name="Type_of_student"> New Student
                 &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio"
                 value="Old_Student"
                 name="Type_of_student"> Old Student 
        <br><hr>
        </div>
        <div class="mb-3">
          <label class="form-label">Child's Birthday</label>
          <input type="date" 
                 class="form-control"
                 name="Child_birthday">
        </div>
        <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <input type="radio"
                 value="Male"
                 checked 
                 name="gender"> Male
                 &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio"
                 value="Female"
                 name="gender"> Female
        <br><hr>
     
          
        </div><br><hr>
        <div class="mb-3">
          <label class="form-label">Father's Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Father_Name?>"
                 name="Father_Name">
        </div>
        <div class="mb-3">
          <label class="form-label">Mother's Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$Mother_name?>"
                 name="Mother_name">
        </div>
       
        </div><br><hr>
        <div class="mb-3">
          <label class="form-label">Incoming Grade Level</label>
          <div class="row row-cols-5">
            <?php foreach ($grades as $grade): ?>
            <div class="col">
              <input type="radio"
                     name="grade"
                     value="<?=$grade['grade_id']?>">
                     <?=$grade['grade_code']?>-<?=$grade['grade']?>
            </div>
          
            
            <?php endforeach ?>
             
          </div>
          <br>
       
        
      
        </div>
      
          
             
          </div>
        
        <div>
      <button type="submit" class="btn btn-primary">Submit Form</button>
     </form>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(3) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 


   
?>