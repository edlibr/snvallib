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
<br />
<br />
<div class="dropdown">
	
	
	<?php echo "<h2>Welcome - "; echo $name;  echo "</h2>";?> 


</div>
<br>	 
<hr>
<br>
<h2>
<?php
echo "Choose from one of the Following Update Options  <br />";
?>
</h2>

<br>
<br> 	 

<table class="center">	
	<tr>						
	<td id='hd3' style="background-color: #e1e1f0;">	
		 <a class='centerx' href="<?php echo url_for('addauthor.php'); ?>">
				<i>Add</i></a> a New Book to the Collection
	</td> 
	</tr>

	<tr>						
	<td id='hd3' style="background-color: #e1e1f0;">	
		Add to the <a class='centerx' href="<?php echo url_for('addhandicraft.php'); ?>">
		<i>Handicraft</i></a> Collection
	</td> 
	</tr>

	<tr>
	<td id='hd3'style="background-color: #e1e1f0;">	
		<a class='centerx' href="<?php echo url_for('delete.php'); ?>">
				<i>Delete</i></a> a Book from the Collection
	</td>
	</tr>

	<tr>
	<td id='hd3'style="background-color: #e1e1f0;">	
		<a class='centerx' href="<?php echo url_for('adddescription.php'); ?>">
				<i>Add/Update</i></a> a Book Description
	</td>
	</tr>

	<tr>
	<td id='hd3'style="background-color: #e1e1f0;">	
		<a class='centerx' href="<?php echo url_for('adddescriptionbysubject.php'); ?>">
				<i>Add</i></a> a Book Description from Subject
	</td>
	</tr>

	<tr>
	<td id='hd3'style="background-color: #e1e1f0;">	
		<a class='centerx' href="<?php echo url_for('booksbydateentered.php'); ?>">
				<i>Show</i></a> Books Added by Date
	</td>
	</tr>
</table>

<br /><br />
	<h2>	<a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2>


<br>
<br>
<br>
<?php include(SHARED_PATH . '/library_footer.php'); ?>


