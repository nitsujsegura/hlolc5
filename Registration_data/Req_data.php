<?php 
session_start();

if (isset($_SESSION)) {
    
    include '../DB_connection.php';
    include "../Registration_data/Reg.php";
    $registration_id= $_POST['Registration_id'];
    $Email= $_POST['Email'];
    $Contact_Number = $_POST['Contact_Number'];
    $Present_address = $_POST['Present_address'];
    $First_name = $_POST['First_name'];
    $Middle_name = $_POST['Middle_name'];
    $Last_name = $_POST['Last_name'];
    $Age = $_POST['Age'];
    $Type_of_student = $_POST['Type_of_student'];
    $Child_birthday = $_POST['Child_birthday'];
    $gender = $_POST['gender'];
    $Father_Name = $_POST['Father_Name'];
    $Mother_name = $_POST['Mother_name'];
    $grade = $_POST['grade'];
    

    $data ='Registration_id='.$registration_id.'&Email='.$Email.'&Contact_Number='.$Contact_Number.'&Present_address='.$Present_address.'&First_name='.$First_name.'&Middle_name='.$Middle_name.'&Last_name='.$Last_name.'&Age='.$Age.'&Type_of_student='.$Type_of_student.'&Child_birthday='.$Child_birthday.'&gender='.$gender.'&Father_Name='.$Father_Name.'&Mother_name='.$Mother_name.'&grade='.$grade;
  
    if (empty($Email)) {
		$em  = "Email is required";}
        if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $em = "Email is invalid!";
    
		header("Location: ../Registration.php?error=$em&$data");
        return;
	}else if (empty($Contact_Number)) {
		$em  = "Contact_Number is required";}
        if(!preg_match('/^[0-9]{11}+$/', $Contact_Number)){
            $em = "Contact Number is invalid!";        
		header("Location: ../Registration.php?error=$em&$data");
		exit;

	}else if (empty($Present_address)) {
		$em  = "Username is required";
		header("Location: ../Registration.php?error=$em&$data");
		exit;
	}else if (empty($First_name )) {
		$em  = "First name is required";
		header("Location: ../Registration.php?error=$em&$data");
		exit;
    }else if (empty($Middle_name )) {
		$em  = "Middle name is required";
		header("Location: ../Registration.php?error=$em&$data");
		exit;
    }else if (empty($Last_name )) {
		$em  = "Last name is required";
		header("Location: ../Registration.php?error=$em&$data");
		exit;
	}else if (empty($Age)) {
		$em  = "Age is required";}
        if(!preg_match('/^[0-9]{2}+$/', $Age)){
            $em = "Age is invalid!"; 
		header("Location: ../Registration.php?error=$em&$data");
        
		exit;
	}else if (empty($Type_of_student)) {
        $em  = "Type of Student is required";
        header("Location: ../Registration.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../Registration.php?error=$em&$data");
        exit;
    }else if (empty($Father_Name)) {
        $em  = "Father' Name is required";
        header("Location: ../Registration.php?error=$em&$data");
        exit;
    }else if (empty($Mother_name)) {
        $em  = "Mother's Name is required";
        header("Location: ../Registration.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Grade is required";
        header("Location: ../Registration.php?error=$em&$data");
        exit;
    }else {
       
        
    $sql  = "INSERT INTO
    registration2(Registration_id,Email,Contact_Number, Present_address, First_name, Middle_name, Last_name, Age, Type_of_student, Child_birthday, gender, Father_Name, Mother_name, grade)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);

    
$stmt->execute([$registration_id,$Email, $Contact_Number, $Present_address, $First_name,$Middle_name,$Last_name, $Age, $Type_of_student, $Child_birthday, $gender, $Father_Name, $Mother_name, $grade]);
$sm = "Registration Complete!";
header("Location: ../Registration.php?success=$sm");
exit;
    
    
}
}else{
    $em = "An error occurred";
    header("Location: ../Registration.php?error=$em");
    exit;

}


