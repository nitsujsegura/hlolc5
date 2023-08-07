<?php 
session_start();

if (isset($_POST['uname']) &&
    isset($_POST['pass'])) {

	include "../DB_connection.php";
	
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];

	if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../login.php?error=$em");
		exit;
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../login.php?error=$em");
		exit;
	}else {	
        	$sql = "SELECT * FROM admin 
        	        WHERE username = ? ";
	    
        $stmt = $conn->prepare($sql);
				$stmt->execute([$uname]);

        if 	($stmt->rowCount() == 1) {
			$user = $stmt->fetch();
        	$username = $user['username'];
        	$password = $user['password'];	
        	
            if ($username === $uname) {
            	if (password_verify($pass, $password)) {
								$_SESSION['username'] = $user; 
						{
                        $id = $user['admin_id'];
                        $_SESSION['admin_id'] = $id;
                        header("Location: ../admin/index.php");

						$query = "INSERT INTO logs (username,login_date,admin_id)VALUES(?,?,?)";
						$stmt1 = $conn->prepare($query);
						$stmt1->execute($username,$id);


                        exit;
                    }
				
				
            	}else {
		        	$em  = "Incorrect Username or Password ";
				    header("Location: ../login.php?error=$em");
				    exit;
		        }
            }else {
	        	$em  = "Incorrect Username or Password ";
			    header("Location: ../login.php?error=$em");
			    exit;
	        }
        }else {
        	$em  = "Incorrect Username or Password ";
		    header("Location: ../login.php?error=$em");
		    exit;
        }
	

	}
}
	

else{
	header("Location: ../login.php");
	exit;
}