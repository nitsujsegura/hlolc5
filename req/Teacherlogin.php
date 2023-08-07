<?php 
session_start();

if (isset($_POST['uname']) &&
    isset($_POST['pass'])) {

	include "../DB_connection.php";
	
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];

	if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../Teacherlogin.php?error=$em");
		exit;
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../Teacherlogin.php?error=$em");
		exit;
	}else {	
        	$sql = "SELECT * FROM teachers
        	        WHERE username = ? ";
	    
        $stmt = $conn->prepare($sql);
				$stmt->execute([$uname]);

        if 	($stmt->rowCount() == 1) {
			$user = $stmt->fetch();
        	$username = $user['username'];
        	$password = $user['password'];	
			$status = $user['status'];

			if($status==1){
        	
            if ($username === $uname) {
            	if (password_verify($pass, $password)) {
								$_SESSION['username'] = $user; 
						{
                        $id = $user['teacher_id'];
                        $_SESSION['teacher_id'] = $id;
                        header("Location: ../teacher/index.php");
                        exit;
                    }
				
				
            	}else {
		        	$em  = "Incorrect Username or Password ";
				    header("Location: ../Teacherlogin.php?error=$em");
				    exit;
		        }
            }else {
	        	$em  = "Incorrect Username or Password ";
			    header("Location: ../Teacherlogin.php?error=$em");
			    exit;
	        }
		}else {
			$em  = "Incorrect Username or Password ";
			header("Location: ../Teacherlogin.php?error=$em");
			exit;
		}
        }else {
        	$em  = "Incorrect Username or Password ";
		    header("Location: ../Teacherlogin.php?error=$em");
		    exit;
        }
	

	}
}
	

else{
	header("Location: ../Teacherlogin.php");
	exit;
}