<?php require_once('private/initialize.php'); 
include('connect.php');
?>

<?php include(SHARED_PATH . '/library_header.php'); ?>

<br />
<br />


<?php
		
if(isset($_POST['createrecord'])){

	$title = addslashes($_POST['inserttitle']);						
		$sql="insert into title (authorID, genreID, title, titlenum) values ('638', '10', 
		'" . mysqli_escape_string($con, $title) . "', '1')";
		
		$result=mysqli_query($con,$sql);
	
			if($result){
				
				$select = "select title.authorID, title.genreID, title.title as 'title', author.firstname as 'firstname', 
				author.lastname as 'lastname', genre.genre as 'genre' 
					from title 
					join author on title.authorID = author.id
					join genre on title.genreID = genre.id
					where title = '" . mysqli_escape_string($con, $title) . "'
					order by title.id desc
					limit 1";
				
				$newresult=mysqli_query($con,$select);
				
				if ($newresult){
	while($newsubject = mysqli_fetch_assoc($newresult)) {
			
 	 ?>

	<h2>This Handicraft Title Has Been Added to the System</h2>

	<br>
	<br>     
		   <table class='add'>
		    <tr>
			  <td class='dgadd'>Title</td>
			  <td class='dgadd2'><?php echo h($newsubject['title']); ?></td>		  
	    	  </tr>
			  <tr>
		      <td class='dgadd'>Subject</td>
			  <td class='dgadd2'><?php echo h($newsubject['genre']); ?></td>
		  </tr>
	  </table>

	<br>
	<br>
	<hr style='background-color:#DCDCDC;height: 4px'>

	<h2 class='centerx'> <a class='centerx' href="<?php echo url_for('addhandicraft.php'); ?>"> Add</a> Another Handicraft Title </h2>
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
		
?>




 <footer class='bottom'>
	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>

