<?php session_start(); ?>
<?php require_once('private/initialize.php'); 
include('connect.php');
include(SHARED_PATH . '/library_header.php'); ?>
<br>
<h2>Please Enter Username and Password to Login</h2>
<br>
<div class='user'>
<form action="snovalleylogin.php" method="post">
      <dl>
        <dt><i>Enter Username</i>
		<input type="text" placeholder="User Name" name="username" autofocus="autofocus" autocomplete="off" required> (Required)
		<br>		
		<i>Enter Password</i>&nbsp;
		<input type="password" placeholder="Password" name="password" required> (Required)<br />
		</dt>		
      </dl>
<br>
<button class='login' name="createrecord"><b>Login</b></button> 

</form>

</div>	  
	  
<br />

<?php 

$name ="";
$username ="";
$password = "";

if(is_post_request()) {
	
//	$name=$_POST['name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$_SESSION['name']=$name;
	$_SESSION['username']=$username;
	
	if (empty($username)){
		$error[]="User Name Cannot be Blank";
	}
	if (empty($password)){
		$error[]="Passsword Cannot be Blank";
	}

	if (empty($error)){
		$error_message="Login was Unsuccessful";
		$admin="select * from admin where username = '" . mysqli_escape_string($con, $username) . "'";
		$selectresult=mysqli_query($con,$admin);
		$selectsubject = mysqli_fetch_assoc($selectresult);
		if ($selectsubject){
			if(password_verify($password,$selectsubject['hashed_password'])){
				$_SESSION['name'] = $selectsubject['name'];
				$_SESSION["login_time_stamp"] = time();				
				redirect_to(url_for('update.php'));				
				//password matches
			}else {
				//login correct but password doesn't match
				echo "<h1>" . "Incorrect Password" . "</h1>";
			}
		} else {
			echo "<h1>" . "User Name Not Found" . "</h1>";
		}
	}	
}
	?>
<br>
<hr class='login77' />
<br>
<br>
<img src="images/snovalley.jpg" alt="Books">

<br>
<br>
<br>
<?php include(SHARED_PATH . '/library_footer.php'); ?>