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

<div class="date">
  
  <div>
<!--   <div class="Subjects listing"> -->
    
  	<table class='centerx'>
		
		<h1 style='text-align: center;'> Select a Date from the Dropdown to <br>Show when Books were Added</h1>
		<br>
  	  
  <tr style='background: white;'>
		   
  		   <td>
 <!--  <b><h2>Select Records from the following Dates</h2></b> -->
   
  		<?php

  		//$query = "select city from locations order by city";
  		$query="select distinct date_format(entry_date, '%M %d, %Y') as 'entry_date',
		date(entry_date) as 'date_enter'
		from title 
		order by entry_date desc;";
  		$result = mysqli_query($con, $query);

  			if($result){
  			$num=mysqli_num_rows($result);
  		}	
  		?>	

  		<div class="date" align="center">		
<br>
  		<form action="booksbydate.php" method="post"> 	

  		<select class='date' name="loc[]"required> 
		  <option style="text-align: center;" value="">Select Here for Books Added Since</option>

  		<?php
  		while ($row=mysqli_fetch_assoc($result)) {
  			?>

<!--  		<option value="<?php echo $row['date_enter']; echo ", "; ?>"> 
  			<?php  echo $row['date_enter']; "<br>"; ?> -->

		<option value="<?php echo $row['date_enter']; echo ", "; ?>"> 
  			<?php  echo $row['entry_date']; "<br>"; ?> 
	
  		</option>

  		<?php 
  		}

  		?>

  		</select>
		<br>
		<br>
		 <b> <input type="submit" value="Click Here After Selecting Date" name="submit"> </b>

  				<br>
		
  		</form>
  		</div>
		
  			</td>
  	    </tr>
  
  
  	</table>
	
	</div>
	<br>
	<br>

	<br><br>

	<h2><a class="actionsx" href="<?php echo url_for('booksbydateentered.php'); ?>">
				Select</a> Another Date Option</h2>
				<br>
	
	<h2><a class="actionsx" href="<?php echo url_for('update.php'); ?>">
				Choose</a> Another Update Option</h2>

				<br>

	<h2>	<a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2>


<br>
<br>
<br>

	<br>
    </div>
  	<footer class='bottom'>
  	  &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com"> Ed!</a>
  	  </footer>

  	    </body>
  	</html>
	


