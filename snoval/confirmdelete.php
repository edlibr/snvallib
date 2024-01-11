<?php session_start(); 
$id = $_GET['id'] ?? '1';
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
//$yeard = $_GET['id'] ?? '1';
?>

<?php $page_title = 'Sno Valley Library Books'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php 

		$sql="select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', genre.genre as 'subject', title.id as 'tid'
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where title.id = '". mysqli_real_escape_string($con, $id) . "'";
			
			$result=mysqli_query($con,$sql);
			if($result){			
			?>
<br>

 
	<table class="details">
		<br />
		<?php
		while ($row=mysqli_fetch_assoc($result)) {
			$_SESSION['titledelete'] = $row['title'];
			?>
	<h2>Confirm Request to Delete Title</h2> - <br><br> <h1 style="text-align:center;" ><?php echo "<i><u>" . h($row['title']) . "</i></u>"?></h1>
	<br>
	<br>
	</table>
	<?php 
	}
	}
?>
	<br>
	<table class="button">
		<td class="button">
	<form action="" method="post"> 	
	<button class='button' name="Submit"><b>Confirm Delete</b></button> 		
	</form>
	</td>
</table>
</div>
</div>


<?php
	
if(isset($_POST['Submit'])){
	
	
/*	echo $_SESSION['title']; */
	echo "<br />";
	
		$sql="delete from title where title.id = '". mysqli_real_escape_string($con, $id) . "'";
			$result=mysqli_query($con,$sql);
			if($result){
	 			redirect_to(url_for('deletecomplete.php'));						
			} else
			{
				echo "Delete Failed";
			}
			} ?>
	 	
							
<br>
<br>
<hr>
<br />

<br />
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('delete.php'); ?>">Delete</a> a Different Title </h2>

<br />

<h2 class='centerx'><a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "<i>Choose</a> Another Update Option</i>"; ?>  </h2>
				
<br />
				
	<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2> 
	
<footer class="bottom">
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
    

     


