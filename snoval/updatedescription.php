<?php session_start(); 
require_once('private/initialize.php'); 
include('connect.php');
include(SHARED_PATH . '/library_header.php'); 
date_default_timezone_set('America/Los_Angeles');
?>
<br />
<?php
$yid = $_SESSION['yid'];
$titlereview=($_POST['display']);
?>

<?php 
if(isset($_POST['Submit'])){
	
	$display = trim((string) ($_POST['display'] ?? ' '));
	$display = addslashes($_POST['display']);
		if ( isset($display[0]))
		{
		
$updatereview = "update title set descflag ='Y', description = '$display' 
				where title.id = '$yid'";

			$selectresult=mysqli_query($con,$updatereview);
			if($selectresult){
			
			$reviewdisplay = "select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', genre.genre as 'subject', title.id as 'tid',
			title.description
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where title.id = '$yid'"; 
			
			$display=mysqli_query($con,$reviewdisplay);
			if ($display){ 
				$num=mysqli_num_rows($display);
				if (mysqli_num_rows($display)>0) {
					
					while ($displayreview = mysqli_fetch_assoc($display)){
				
				?>
				<h1 style='text-align: center;'><b><i>Description Completed</i></b></h1> 
				<h1 style='text-align: center;'><i><u><?php echo h($displayreview['title']); ?></u></i></h1>
				<h2>By: <?php echo h($displayreview['firstname']) . '&nbsp;' . h($displayreview['lastname']); ?> </h2>
<!-- 		  	<table class='rev'>
		  		<tr> -->	
					  
<!--	  			<td id='addn' >Title</td>
		  			<td ><?php echo h($displayreview['title']); ?></td>			  
		  	    </tr>
		  		<tr>
		  		 	<td id='addn' >Author</td>			  
		  			<td ><?php echo h($displayreview['firstname']) . '&nbsp;' . h($displayreview['lastname']); ?></td>
		  		</tr>			  
		  		<tr>
		  		      <td id='addn'>Subject</td>
		  			  <td ><?php echo h($displayreview['subject']); ?></td>
		  		 </tr>
	 			</table> -->
				<br />
				
	 			<table class='rev'>
<!--  		  		<tr>
  		  		      <td>Title Review</td>
				</tr> -->
			
				<tr>
  		  			  <td id='addn2'><?php echo h($displayreview['description']); ?></td>
  		  		 </tr>
		  	  </table>
<?php 
			}
			}								
			}	
			}	
			}	}
?>
<br>
<br>

<br>
<br>
<br>
<br>

<?php include(SHARED_PATH . '/library_footer.php'); ?>