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

<i>
<?php echo "<h2>Welcome - ";  echo $name;  echo "</h2>";?> </i>

<br />
	 


<?php
echo "<h2>Search Title You Want to Add a Description</h2>";
?>


<br />
<hr />
<br />

<form action="selectbooktodescribe.php" method="post">
      <dl>
        <dt class='delete'><i>&nbsp;Search Title to add a Description</i>
		&nbsp;
        
		<input type="hidden" name="choice" value="title">
		<input type="text" placeholder="Enter Search" name="search" autofocus="autofocus" required> 
		<button name="Submit"><b>Search </b></button> 
		</dt>
      </dl>
</form>

<br />
<br />
<hr class='login'/>
<br />
	
	<h2><a class="actionsx" href="<?php echo url_for('update.php'); ?>">
				Choose</a> Another Update Option</h2>
	
<br />
	
	<h2><a class="actionsx" href="<?php echo url_for('snovalleylogout.php'); ?>">
				Logout</a></h2>
	
<?php

$query="select sum(title.titlenum), genre.genre as 'subject'
	from title
	join genre on title.genreID=genre.id
	group by genre.genre
	order by sum(title.titlenum) desc";
$result = mysqli_query($con, $query);

	if($result){
	$num=mysqli_num_rows($result);
//	echo $num;
}
?>	

 <footer class='bottom'>
	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>
