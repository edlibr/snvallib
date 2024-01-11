<?php session_start(); 
require_once('private/initialize.php'); 
include('connect.php');
include(SHARED_PATH . '/library_header.php'); 
date_default_timezone_set('America/Los_Angeles');
?>
<br />


<?php
/*$book_author = books_recommend(); */

$yid = $_GET['id'] ?? '1';
$selectreview = "select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', genre.genre as 'subject', title.id as 'tid',
			description
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where title.id = '$yid'";

			$selectresult=mysqli_query($con,$selectreview);
			if($selectresult){
			while($selectsubject = mysqli_fetch_assoc($selectresult)){
				?>
<!--				<h1>Review for </h1> -->
				<h1 style='text-align: center;'><i><u><?php echo h($selectsubject['title']); ?></u></i></h1>
				<h2>By: <?php echo h($selectsubject['firstname']) . '&nbsp;' . h($selectsubject['lastname']); ?> </h2>
<!-- 		  	<table class='rev'>
		  		<tr>		  
		  			<td id='addn' >Title</td>
		  			<td ><?php echo h($selectsubject['title']); ?></td>			  
		  	    </tr>
		  		<tr>
		  		 	<td id='addn' >Author</td>			  
		  			<td ><?php echo h($selectsubject['firstname']) . '&nbsp;' . h($selectsubject['lastname']); ?></td>
		  		</tr>			  
		  		<tr>
		  		      <td id='addn'>Subject</td>
		  			  <td ><?php echo h($selectsubject['subject']); ?></td>
		  		 </tr>
	 			</table> -->
				<br />
				
	 			<table class='rev'>
<!--  		  		<tr>
  		  		      <td>Title Review</td>
				</tr> -->
			
				<tr>
  		  			  <td id='addn'><?php echo h($selectsubject['description']); ?></td>
  		  		 </tr>
		  	  </table>
<?php 
			}								
			}			
?>
<br />
<br />
<!--<h2><a href="recommend.php">Return to Book Recommendations</a> </h2>-->

<br />
<br />
<!--<h2><a href="index.php">Return to Home Page</a> </h2> -->

<br />
<br />

<?php include(SHARED_PATH . '/library_footer.php'); ?>