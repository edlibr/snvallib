<?php session_start(); 
require_once('private/initialize.php'); 
include('connect.php');
include(SHARED_PATH . '/library_header.php'); 
date_default_timezone_set('America/Los_Angeles');
if (!isset($_SESSION['username'])){
	redirect_to(url_for('snovalleylogin.php'));
}
$_SESSION['last_activity'] = time();	
$name=$_SESSION['name'];
	
if (isset($_SESSION['login_time_stamp']) && time() - $_SESSION["login_time_stamp"] > 3600){ 
	redirect_to(url_for('timeout.php'));	
	
} else {	
	$_SESSION['login_time_stamp'] = time();
}
?>
<br>
<br>
<div class="dropdown">
	
	
	<?php echo "<h2>Welcome - "; echo $name;  echo "</h2>";?> 


</div>
<br>	 
<hr>
<br>
<h2>
<?php
echo "Choose from the Following Options for Finding When Books Were Added  <br>";
?>
</h2>

<br>
<br> 	 

<table class="center">	
	<tr>						
	<td id='hd3' style="background-color: #e1e1f0;">	
		 Show Books Added Starting from a <a class='centerx' href="<?php echo url_for('selectdate.php'); ?>">
				<i>Date</i></a>
	</td> 
	</tr>

	<tr>						
	<td id='hd3' style="background-color: #e1e1f0;">	
		 Show Books Added on a <a class='centerx' href="<?php echo url_for('selectspecificdate.php'); ?>">
				<i>Specific</i></a> Date
	</td> 
	</tr>

	<tr>						
	<td id='hd3' style="background-color: #e1e1f0;">	
		 Show Books Added Since <a class='centerx' href="<?php echo url_for('selectbeginning.php'); ?>">
				<i>December 17, 2023</i></a>
	</td> 
	</tr>

</table>

<br><br>

	<h2><a class="actionsx" href="<?php echo url_for('update.php'); ?>">
				Choose</a> Another Update Option</h2>
				<br>

	<h2>	<a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2>


<br>
<br>
<br>
<?php include(SHARED_PATH . '/library_footer.php'); ?>


