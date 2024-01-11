<?php session_start(); 
require_once('private/initialize.php'); 
include('connect.php');
include(SHARED_PATH . '/library_header.php'); 
date_default_timezone_set('America/Los_Angeles');
if (!isset($_SESSION['username'])){
	redirect_to(url_for('snovalleylogin.php'));
}
$_SESSION['last_activity'] = time();	
$name=$_SESSION['titledelete'];
	
if (isset($_SESSION['login_time_stamp']) && time() - $_SESSION["login_time_stamp"] > 3600){ 
	redirect_to(url_for('timeout.php'));	
	
} else {	
	$_SESSION['login_time_stamp'] = time();
}
?>
<br />
<br />
<div class="dropdown">
	
</div>
<br />
<h2>	 

<?php
echo "Selected Title - ";
echo "<u><i>";
echo $name;
echo "</i></u>";
echo " - Has Been Deleted <br />";
?>
</h2>
<br />
<br /> 	 
<hr />
<br />
<!--<h2>Please Make Another Selection</h2> -->


<br />
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('delete.php'); ?>"><i>Delete</i></a> Another Book</h2>

<br />

<h2 class='centerx'> <a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "<i>Choose</i></a> Another Update Option"; ?>  </h2>
				
<br />
				
	<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2> 
				
<br>
<br>
<br>

<?php include(SHARED_PATH . '/library_footer.php'); ?>