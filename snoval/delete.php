<?php session_start(); 
require_once('private/initialize.php'); 
include('connect.php');
include(SHARED_PATH . '/library_header.php'); 
date_default_timezone_set('America/Los_Angeles');
if (!isset($_SESSION['username'])){
	redirect_to(url_for('reunionlogin.php'));
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


<?php echo "<h2>Welcome - ";  echo $name;  echo "</h2>";?> 

<br>
<br>

<?php
echo "<h2>Enter Title You Want to Delete</h2>";
?>
<br>
<hr>
<br />

<form action="selectdelete.php" method="post">
      <dl>
        <dt ><i>&nbsp;Search Title to Delete</i>
		&nbsp;
        
		<input type="hidden" name="choice" value="title">
		<input class='delete' type="text" placeholder="Enter Search" name="search" autofocus="autofocus" required> 
		<button name="Submit"><b>Search </b></button> 
		</dt>
      </dl>
</form>

<br />
<br />
<hr>
<br />
	
	<h2><a class="actionsx" href="<?php echo url_for('update.php'); ?>">
				<i><u>Choose</u></i></a> Another Update Option</h2>
				
<br />
	
	<h2><a class="actionsx" href="<?php echo url_for('snovalleylogout.php'); ?>">
				<u><i>Logout</i></u></a></h2>
	
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
