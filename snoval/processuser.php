<?php require_once('private/initialize.php'); 
include('connect.php');
?>

<?php include(SHARED_PATH . '/library_header.php'); ?>


<?php

if (empty($_POST['username'])) {
	die("User Name is Required");
}
if (strlen($_POST['username'])<2) {
	die("User Name requires at least 2 characters");
}
if (strlen($_POST['password'])<4) {
	die("Password requires at least 6 characters");
}

if (!preg_match('/[a-z]/', $_POST['password'])){
	die("Password must contain 1 lowercase letter.");
}
//if (!preg_match('/[0-9]/', $_POST['password'])){
//	die("Password must contain 1 number.");
//}

if ($_POST['password']!==$_POST['confirm_password']) {
	die("Password and Confirm Password must match.");
}

$name=($_POST['name']);
$username=($_POST['username']);
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
		

		
		$selectuser="select * from admin where username = '" . mysqli_escape_string($con, $username) . "' and
			hashed_password = '" . mysqli_escape_string($con, $password_hash) . "'";
		
//		$selectauthor="select * from author where lastname = '" . mysqli_escape_string($con, $lastname) . "'";
		
		$selectresult=mysqli_query($con,$selectuser);
		$selectsubject = mysqli_fetch_assoc($selectresult);
		
//		
		if ($selectsubject) { 	  


echo "name exists";	
				
		}
		
		else {
						
	
		$sql="insert into admin (name, username, hashed_password) values ('$name', '$username', '$password_hash')";
	
		$result=mysqli_query($con,$sql);
	
			if($result){
			
				$select = "select * from admin";
				$newresult=mysqli_query($con,$select);
				$subject = mysqli_fetch_assoc($newresult); 
				
	echo "User Entered";						
 				}
		else {
		echo mysqli_error($db);
		}		
			}
		 
?>
