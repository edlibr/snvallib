<?php require_once('private/initialize.php'); 
include('connect.php');
?>

<?php 
//$page_title = 'Reunion Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php
	
switch ($_POST['choice']) {  

case "title":
	
if(isset($_POST['Submit'])){
	$search = trim((string) ($_POST['search'] ?? ' '));
	$search = addslashes($_POST['search']); 
	$search = mysqli_real_escape_string($con, $_POST['search']);
		if ( isset($search[0]))
		{
	
		$sql="select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', genre.genre as 'subject',
			title.id as tid,
			title.description as 'description',
			title.descflag
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where (title.title like '%$search%'
			or author.lastname like '%$search%'
			or author.firstname like '%$search%'
			or title.description like '%$search%')
			and genre.id <>'10'
			and title.authorID <>'638'
			order by author.lastname, author.firstname, title.title";
	
			$result=mysqli_query($con,$sql);
	
			if($result){
				$num=mysqli_num_rows($result);
	 			echo "<br>";
	 				
				
					if (mysqli_num_rows($result)>0) {
						if ($num==1) { ?>
							
							<table>	
							<tr>
								<td id='hd1'>
								
								<a href="<?php echo url_for('index.php'); ?>
															">&laquo Return to Home Page </a>	</td>
								<td id='hd2'>	
								<h1><?php echo $num . "&nbsp;Record Found" ?></h1> </td> 
							</tr>
							</table>
							<?php 
							}
						else {?>
						<table>	
						<tr>
							<td id='hd1'>
								
							<a href="<?php echo url_for('index.php'); ?>
														">&laquo Return to Home Page </a>	</td>
							<td id='hd2'>	
							<h1><?php echo $num . "&nbsp;Records Found" ?></h1> </td> 
						</tr>
						</table>
						
							<?php }?>
			<div id="content">
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
			<?php		
			
			while ($row=mysqli_fetch_assoc($result)) {
			$num_rows++; ?>

				<tr>         
		  			<td class='numberd'><i><?php echo $num_rows; ?></i></td> 
  		  			<td class='author' style='text-align: left;'><?php echo h($row['firstname']) . '&nbsp;' . h($row['lastname']); ?></td>	
					
			<?php if ($row['descflag'] == 'N') {
				?>
  		  			<td class='title'> <?php echo h($row['title']); ?></td> 

				<?php }else{ 
					?>
					
					<td class="title"> <i><a href="<?php echo url_for('selectdescription.php? id=' . h(u($row['tid'])));?>" target="_blank" >
					<?php echo h($row['title']);?></a></i></td>
					<?php }?>

  		  			<td class='subject' style='text-align: left;'><?php echo h($row['subject']); ?></td>
      	  		</tr>
		
			<?php			
			} ?>
	 	
	</table>
</div>
</div>
<br>
<br>
 <footer>
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>
		<?php 
			} 
			
			
		 else { ?>
			<div class="flex-container2"> 
				
				<a class="actions" href="<?php echo url_for('index.php'); ?>" > 
					<?php echo "<b>" . 'No Record Found - Click to Return to Search' . "</b>"; ?> </a>
				
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
		<br>
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

<?php 
		break;

case "dropdown": 

		if (isset($_POST['submit'])){ 		 
			if (!empty($_POST['loc'])){ ?>
						
	<?php  $num_rows = 0 ; ?>					  	  
			<?php
				foreach ($_POST['loc'] as $selected){}
					if ($selected == "Select Subject"){ ?>
						<br>
						<div class="flex-container2"> 
							
				<a class="actions" href="<?php echo url_for('index.php'); ?>" > <?php echo 'Click Here to Select a Subject'; ?> </a>	
						 </div>
						 
  		 <footer class="bottom">
  		   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
  		   </footer>

  		     </body>
  		 </html>
					<?php
					} else {;	
					 ?>	
				
<?php 

		$sql="select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', title.id as 'tid', 
			title.descflag as 'descflag', genre.genre as 'subject'
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where genre.genre = '". mysqli_real_escape_string($con, $selected) . "'
			order by author.lastname, author.firstname, title.title";
	
		$result=mysqli_query($con,$sql);
	
	if($result){
	$num=mysqli_num_rows($result);
	?>
				
				<div id="content">
				  <div class="Subjects listing">
    
				<br>	


						<table>	
						<tr>
							<td id='hd1'>
								
							<a href="<?php echo url_for('index.php'); ?>
														">&laquo Return to Home Page </a>	</td>
							<td id='hd2'>	
						<h1> <?php echo $num . "&nbsp;Books in" . "&nbsp;" . h($selected); ?> </h1>
							 </td> 
						</tr>
						</table>
					
					<table class="details">
						<br>
				  	  
					<tr>		 
        				<td class='number'></td>
						<td class='author'><b>Author</b></td>
						<td class='title' style='text-align: center;'><b>Title</b></td>
						<td class='subject'><b>Subject</b></td>	
  	  				</tr>

					  <?php $num_rows = 0 ;?> 

				      <?php while($subject = mysqli_fetch_assoc($result))
	  
					  { $num_rows++;
						?>  

						<tr>         
		  					<td class='numberd'><i><?php echo $num_rows; ?></i></td> 
  		  					<td class='author' style='text-align: left;'><?php echo h($subject['firstname']) . '&nbsp;' . h($subject['lastname']); ?></td>		
							
					<?php if ($subject['descflag'] == 'N') {
					?>
  		  			<td class='title'> <?php echo h($subject['title']); ?></td> 
					
					<?php }else{ 
					?>

					<td class="title"> <i><a href="<?php echo url_for('selectdescription.php? id=' . h(u($subject['tid'])));?>" target="_blank">
					<?php echo h($subject['title']);?></a></i></td>
					<?php }?>

					<td class='subject' style='text-align: left;'><?php echo h($subject['subject']); ?></td>
      	  				</tr>

						  <?php } ?>
				   </table>
  				
	<?php
} ?>

<br>
<br>
<br>
<footer>
 &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
 </footer>	
 
 <?php	
	}	
	?>
	
<?php			}
?>			
  			
<?php

} ?>

</body>
 </html>

<?php 
}	
?>

<br>
<br>
<br>