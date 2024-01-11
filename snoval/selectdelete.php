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

<?php $page_title = 'Sno Valley Library Books'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php
	
if(isset($_POST['Submit'])){
	
	$search = trim((string) ($_POST['search'] ?? ' '));
	$search = addslashes($_POST['search']);
	$search = mysqli_real_escape_string($con, $_POST['search']);
		if ( isset($search[0]))
		{
	
		$sql="select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', genre.genre as 'subject', title.id as 'tid'
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where title.title like '%$search%'
			or author.lastname like '%$search%'
			or author.firstname like '%$search%'
			order by author.lastname, author.firstname, title.title";
	
			$result=mysqli_query($con,$sql);
	
			if($result){
				$num=mysqli_num_rows($result);
	 			echo "<br />";			
					if (mysqli_num_rows($result)>0) {
						?>
						<br />
							<h2>Click on <u>Delete Title</u> to Choose the Book You Want to Remove</h2>
		<br>
		<hr>
		<br>					
							
<!--			<div id="content">
			  <div class="Subjects listing"> -->
    
			  <table class="details" >
					
				<br>
			  	<tr>
					<td class='author' style='width: 25%; background-color: #b0b7d0; text-align: center; border: 2px solid black;'><b>Author</b></td>
					<td class='title' style='text-align: center; width: 55%; background-color: #b0b7d0; border: 2px solid black;'><b>Title</b></td>
				  	<td class='subject' style="background: #b0b7d0; width: 20%; border: 2px solid black;"><b>Select to Delete</b></td> 	    
			  	</tr>

			<?php $num_rows = 0 ;?> 
			<?php		
			
			while ($row=mysqli_fetch_assoc($result)) {
			$num_rows++; 
			$_SESSION['tid'] = $row['tid'];
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['title'] = $row['title'];
			$_SESSION['subject'] = $row['subject'];			
			?>

        		<tr>
				<td class='author' style='text-align: left; width: 25%; padding-left: 5px; background: #e1e1f0; border: 2px solid black;'>
					<?php echo h($row['firstname']) . '&nbsp;' . h($row['lastname']); ?></td>
				<td class='title' style='width: 55%; padding-left: 5px; background: #e1e1f0; border: 2px solid black;'>
					<?php echo h($row['title']); ?></td>
				<td class='subject' style="background: #e1e1f0; width: 20%; font-weight: 500; border: 2px solid black;"> <a class="centerx" href="
					<?php echo url_for('confirmdelete.php? id=' . h(u($row['tid']))); ?>"><i> Delete Title</i> </a>
</td>											
<!--	  			  	<td id='td-dg'> -->
<?php 
//echo h($row['subject']); 
?>
<!--</td> -->
		  		</tr>

		
			<?php			
			} ?>
	 	
	</table>
	<!--</div>
							
</div> -->
							
<br />
<br />
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('delete.php'); ?>">Delete</a> a Different Book </h2>
<br />
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "<i>Choose</a> Another Update Option</i>"; ?>  </h2>				
<br />				
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2> 

<br>
<br>
  
 <footer>
   &copy; <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>
		<?php 
			} 
			
			
		 else { ?>
			<div class="flex-container2"> 
				
				<a class="actions" href="<?php echo url_for('delete.php'); ?>" > 
					<?php echo "<b>" . 'Not Record Found - Click to Find Another Title' . "</b>"; ?> </a>
				
			 </div>
			 
			 <footer class="bottom">
			   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
			   </footer>
  
			     </body>
			 </html>
			 
			 <?php
					}
		
				}
	
} else {
	
		?>
		<br />
		<div class="flex-container2"> 
		    
	<a class="actions" href="<?php echo url_for('index.php'); ?>" > <?php echo 'Click Here to Return to Search'; ?> </a>
		 </div>
		 
		 <footer class="bottom">
		   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
		   </footer>

		     </body>
		 </html>
<?php
	
	
}
}	
 
?>      
      
<br />
<br />
<br />
   

     


