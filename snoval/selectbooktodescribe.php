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

<?php $page_title = 'Reunion Library Books'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php
	
if(isset($_POST['Submit'])){
	
	$search = trim((string) ($_POST['search'] ?? ' '));
	$search = addslashes($_POST['search']);
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
							<h2>Select Book You Want to Describe</h2>
		<br>
				
<!--			<div id="content">
			  <div class="Subjects listing"> -->
    
	<div class="Subjects listing">
    
	<table class="details">
		  
	  <br>
	  <tr>		 
		  <td class='number'></td>
		  <td class='author'><b>Author</b></td>
		  <td class='title' style='text-align: center;'><b>Title</b></td>
		  <td class='subject'><b>Subject</b></td>	
		  </tr>

  <?php $num_rows = 0 ;?> 		  
			 
			 
<!--			  <table class="details">
					
				<br />
			  	<tr> -->
<!--			      <th id='td-nh'></th> -->
<!--				  <th id='td-dc'>Author</th>
				  <th>Title</th>	
				  <th id='td-dgh'>Add Description</th>	    
			  	</tr> -->

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
		  			<td class='numberd'><i><?php echo $num_rows; ?></i></td> 
  		  			<td class='author' style='text-align: left;'><?php echo h($row['firstname']) . '&nbsp;' . h($row['lastname']); ?></td>					
					<td class="title"> <i><a href="<?php echo url_for('insertdescription.php? id=' . h(u($row['tid'])));?>" target="_blank" >
					<?php echo h($row['title']);?></a></i></td>
  		  			<td class='subject' style='text-align: left;'><?php echo h($row['subject']); ?></td>
      	  		</tr>


			
<!--
        		<tr>
	  			  	<td id='td-ds'><?php echo h($row['firstname']) . '&nbsp;' . h($row['lastname']); ?></td>
	  			  	<td> <?php echo h($row['title']); ?> </td>
 
<td>					<a class="centerx" href="<?php echo url_for('insertdescription.php?
							  		  		id=' . h(u($row['tid']))); ?>"><i>Add Description</i> </a> 
</td>			-->								
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
							
<br>

<br>
<br>
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('adddescription.php'); ?>">Describe</a> a Different Book </h2>
<br>
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "<i>Choose</a> Another Update Option</i>"; ?>  </h2>				
<br />				
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2> 
<br />

 <footer class="bottom">
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
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
   

     


