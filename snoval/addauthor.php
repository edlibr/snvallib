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
	<?php echo "<h2>Welcome - "; echo $name;  echo "</h2>";?> 
<br>
<br>

<form action="addtitle.php" method="post">

<table class='central'> 
	  <tr>
	  <td class="addtitle">   
         <i>Enter Author First Name</i> 
<!--		<input type="hidden" name="choice" value="title"> -->
		<input class="addauthor" type="text" placeholder="First Name" name="firstname" autofocus="autofocus"> 
	</td>
</tr>
<tr>
	<td class="addtitle">	
		 <i>Enter Author Last Name</i> 
		<input class="addauthor" type="text" placeholder="Last Name (Required)" name="lastname" required> 
	</td>
</tr>
<tr>
	<td class="addtitle">	
		 <i>Enter Title</i>	
		<input class="addtitle" type="text" placeholder="Title (Required)" name="inserttitle" required> 
		<br>	
	</td>
</tr>	
   </table>  
	    
<div class="dropdown">	       

<?php

$query="select sum(title.titlenum), genre.id, genre.genre as 'subject'
	from title
	join genre on title.genreID=genre.id
	group by genre.id, genre.genre
	order by sum(title.titlenum) desc";
	
//$query="select genre as 'subject' from genre";	
	
$result = mysqli_query($con, $query);

	if($result){
	$num=mysqli_num_rows($result);
//	echo $num;
}
?>	

<br>
<table class='centerx'>
<tr>
	<td>
<select class='addtitle' name="genre[]" required> 
<option  value="">Select Subject</option> -->

<?php
while ($row=mysqli_fetch_assoc($result)) {
	?>
<option value="<?php echo $row['subject'];  ?>"> 
	<?php  echo $row['subject'];  echo "<br/>"; ?>
</option>
<?php 
}
?>
</select> (Required) 

<br>
<br>
<button class='addtitle' name="createrecord"><b>Add New Book</b></button> 	
</td>
</tr>
</table>

</div>
</form>
<br>
<hr>
<br>
	<h2 class='centerx'><i><a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "Choose</a> Another Update Option</i>"; ?>  </h2>
				
<br>
				
	<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2>


<br>
<br>
<br>
<?php include(SHARED_PATH . '/library_footer.php'); ?>

