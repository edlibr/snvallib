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
<?php
		
if(isset($_POST['createrecord'])){
//	$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
//	$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
//	$title = mysqli_real_escape_string($con, $_POST['inserttitle']);
//	$lastname = addslashes($_POST['lastname']);
//	$firstname = addslashes($_POST['firstname']);
	$lastname = ($_POST['lastname']);
	$firstname = ($_POST['firstname']);
//	$title = addslashes($_POST['inserttitle']);
	$title = ($_POST['inserttitle']);
//	$genre = addslashes($_POST['genre']);
//	$genre = $con -> real_escape_string($_POST['genre']) ?? '';
//	$firstname = $con -> real_escape_string($_POST['firstname']) ?? '';
//	$title = $con -> real_escape_string($_POST['inserttitle']) ?? '';
	$genre = $_POST['genre'] ?? '';
			
//		$selectauthor="select * from author where firstname = '$firstname'  and
//			lastname = '$lastname'";
		
		$selectauthor="select * from author where firstname = '" . mysqli_escape_string($con, $firstname) . "' and
			lastname = '" . mysqli_escape_string($con, $lastname) . "'";
		
//		$selectauthor="select * from author where lastname = '" . mysqli_escape_string($con, $lastname) . "'";
		
		$selectresult=mysqli_query($con,$selectauthor);
		$selectsubject = mysqli_fetch_assoc($selectresult);
		
//		echo $selectsubject['firstname'];
		
		if ($selectsubject) { ?>			
				
<?php		

$authorid = $selectsubject['id'];	
				
		}
		
		else {
						
		$sql="insert into author (firstname, lastname) values ('" . mysqli_escape_string($con, $firstname) . "',
		'" . mysqli_escape_string($con, $lastname) . "')";
	
		$result=mysqli_query($con,$sql);
	
			if($result){
			
				$select = "select * from author order by id desc limit 5";
				$newresult=mysqli_query($con,$select);
				$subject = mysqli_fetch_assoc($newresult); 
				
				?>
				
<?php	
$authorid = $subject['id'];			
 				}
		else {
		echo mysqli_error($db);
		}		
			}
	
// Select Genre from form in this section
	
	
		if (!empty($_POST['genre'])){ ?>
					
<?php  $num_rows = 0 ; ?>					  	  
		<?php
			foreach ($_POST['genre'] as $selected){}
				if ($selected == "Select Subject"){ ?>
					<br />
					<div class="flex-container2"> 
						
			<a class="actions" href="<?php echo url_for('index.php'); ?>" > <?php echo 'Click Here to Select a Subject'; ?> </a>	
					 </div>
					 
	 <footer class="bottom">
	   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
	   </footer>

	     </body>
	 </html>
	 
	 
	 		<?php
	 	} else {	
	 	?>	
				
	 <?php 
//	 echo $selected;
			$sql="select * from genre where genre = '". mysqli_real_escape_string($con, $selected) . "'"; 
	 		$result=mysqli_query($con,$sql);
	
	 	if($result){
	 	$num=mysqli_num_rows($result);
	 	?>
	
		<div id="content">
		<div class="Subjects listing">
    
				<br />	

					  <?php $num_rows = 0 ;?> 

				      <?php while($subject = mysqli_fetch_assoc($result))
	  
					  { $num_rows++;
						?>  
				       
						  <?php 
//						  $genreid=$subject['id'];
						  $genreid = addslashes($subject['id']);
						  $genreid = mysqli_real_escape_string($con, $subject['id']);
//						  $genre=$subject['genre'];	
						  $genre = addslashes($subject['genre']);
						  $genre = mysqli_real_escape_string($con, $subject['genre']);	  
					  
					  } }?>
				   
<?php 

	} 	

		$selecttitle="select title.authorID, title.genreID, title.title as 'title', author.firstname as 'firstname', 
						author.lastname as 'lastname', genre.genre as 'genre' 
							from title 
							join author on title.authorID = author.id
							join genre on title.genreID = genre.id
							where title = '" . mysqli_escape_string($con, $title) . "'
							and author.lastname = '" . mysqli_escape_string($con, $lastname) . "'
							and author.firstname = '" . mysqli_escape_string($con, $firstname) . "'";
		
//		$selecttitle="select * from title where title = '" . mysqli_escape_string($con, $title) . "'";
		$newresult=mysqli_query($con,$selecttitle);
		$newsubject = mysqli_fetch_assoc($newresult);
		
		if ($newsubject) {
			
				?>
			
			<h2>This Book is Already in the System</h2>
			<br>
			<br>
			<table class='add'>
		    <tr>
			  <td class='dgadd'>Title</td>
			  <td class='dgadd2'><?php echo h($newsubject['title']); ?></td>		  
	    	  </tr>
			  <tr>
		      <td class='dgadd'>Author</td>
			  <td class='dgadd2'><?php echo h($newsubject['firstname']) . '&nbsp;' . h($newsubject['lastname']); ?></td>
		  	  </tr>
			  <tr>
		      <td class='dgadd'>Subject</td>
			  <td class='dgadd2'><?php echo h($newsubject['genre']); ?></td>
		  </tr>
	  </table>
			  
			  <br>
			  <br>
			  <hr>
			  
<!---		<a class="actions" href="<?php echo url_for('addauthor.php'); ?>" > <?php echo 'Add a Different Title'; ?> </a> -->			
			<br />
			<br />
			
<!---			<a class="actions" href="<?php echo url_for('index.php'); ?>" > <?php echo 'Return to Home Page'; ?> </a> -->
			  
			<h2 class='centerx'> <a class='centerx' href="<?php echo url_for('addauthor.php'); ?>"> Add</a> a Different Book </h2>
	<br />
	
	<h2 class='centerx'><a class='centerx' href="<?php echo url_for('update.php'); ?>">
					<?php echo "<i>Choose</a> Another Update Option</i>"; ?>  </h2>
	
	<br />
	
		<h2><a class="centerx" href="<?php echo url_for('snovalleylogout.php'); ?>">
					<i>Logout</i></a></h2>	

	<?php			
		}
		
		else {
						
		$sql="insert into title (authorID, genreID, title, titlenum) values ('" . mysqli_escape_string($con, $authorid) . "',
			'" . mysqli_escape_string($con, $genreid) . "',
			'" . mysqli_escape_string($con, $title) . "',
			'1')";
	
		$result=mysqli_query($con,$sql);
	
			if($result){

				$select = "select title.authorID, title.genreID, title.title as 'title', author.firstname as 'firstname', 
				author.lastname as 'lastname', genre.genre as 'genre' 
					from title 
					join author on title.authorID = author.id
					join genre on title.genreID = genre.id
					where title = '" . mysqli_escape_string($con, $title) . "'
						and author.lastname = '" . mysqli_escape_string($con, $lastname) . "'
						and author.firstname = '" . mysqli_escape_string($con, $firstname) . "'";
				$newresult=mysqli_query($con,$select);
				
				if ($newresult){
	while($newsubject = mysqli_fetch_assoc($newresult)) {
			
 	 ?>

	<h2>This Book Has Been Added to the System</h2>
	<br>
	<br>     
		   <table class='add'>
		    <tr>
			  <td class='dgadd'>Title</td>
			  <td class='dgadd2'><?php echo h($newsubject['title']); ?></td>		  
	    	  </tr>
			  <tr>
		      <td class='dgadd'>Author</td>
			  <td class='dgadd2'><?php echo h($newsubject['firstname']) . '&nbsp;' . h($newsubject['lastname']); ?></td>
		  	  </tr>
			  <tr>
		      <td class='dgadd'>Subject</td>
			  <td class='dgadd2'><?php echo h($newsubject['genre']); ?></td>
		  </tr>
	  </table>
			 
	  <br>
	  
<!---	<a class="actions" href="<?php echo url_for('addauthor.php'); ?>" > <?php echo 'Add Another Title'; ?> </a> -->
		
	<br>
	<hr>
	<br>
	
<!--	<a class="actions" href="<?php echo url_for('index.php'); ?>" > <?php echo 'Return to Home Page'; ?> </a> -->			
	<h2 class='centerx'> <a class='centerx' href="<?php echo url_for('addauthor.php'); ?>"> Add</a> Another Book </h2>
	<br />
	
	<h2 class='centerx'><a class='centerx' href="<?php echo url_for('update.php'); ?>">
					<?php echo "<i>Choose</a> Another Update Option</i>"; ?>  </h2>
	
	<br />
	
		<h2><a class="centerx" href="<?php echo url_for('snovalleylogout.php'); ?>">
					<i>Logout</i></a></h2>

<?php 			}	
}
			}	
				else {
				echo mysqli_error($db);
		}		
			}		
		}
}	
?>

 <footer class='bottom'>
	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>

