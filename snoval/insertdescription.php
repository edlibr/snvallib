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


<?php
/*$book_author = books_recommend(); */

$yid = $_GET['id'] ?? '1';
$_SESSION['yid']=$yid;
$selectreview = "select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', genre.genre as 'subject', title.id as 'tid',
			title.description as 'description'
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where title.id = '$yid'";

			$selectresult=mysqli_query($con,$selectreview);
			if($selectresult){
			while($selectsubject = mysqli_fetch_assoc($selectresult)){
				$_SESSION['description']=$selectsubject['description'];
				?>
				<h2>Enter or Update Description for </h2> 
				<h1 style='text-align: center';><i><?php echo h($selectsubject['title']); ?></i></h1>
				<h2>By: <?php echo h($selectsubject['firstname']) . '&nbsp;' . h($selectsubject['lastname']); ?> </h2>

				<br>
				
	 			<table class='button2'>
			
				<tr> 
				<form action="updatedescription.php" method="post">
				<td class='button'>	
 					<textarea name="display" autofocus><?php echo h($selectsubject['description']); ?></textarea>
					
					</td>
					</tr>
					<tr class='button'>
					<td class='button'>
					<br>
						<button class='button' name="Submit"><b>Enter/Update Description</b></button> 
					</td>
				</tr>

				</form> 		  		 
		  	  </table>

<?php 
			}								
			}			
?>
<br>
<br>

<br>
<br>
<br>

<?php include(SHARED_PATH . '/library_footer.php'); ?>