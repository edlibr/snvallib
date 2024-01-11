<?php require_once('private/initialize.php'); ?> 



<?php 
//$page_title = 'Sno Valley Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>


<?php
$book_author = handicraft_books();
?>

<div id="content">
  <div class="Subjects listing">
    
<br />	
		<table>	
			<tr>
				<td id='hd1'>
					<a href="<?php echo url_for('index.php'); ?>
					">&laquo Return to Home Page </a>	</td>
				<td id='hd2'>	
					<h1>Handicraft Books </h1>
				</td> 
			</tr>
		</table>

  	<table class='details'>
		
		<br />
		<thead>
  	  
		<tr>		 
        	<td class='number'></td>
			<td class='title' style='text-align: center;'><b>Title</b></td>	
  	  	</tr>

</thead>	  
<tbody>	  

	  <?php $num_rows = 0 ;?> 

      <?php while($subject = mysqli_fetch_assoc($book_author))
	  
	  { $num_rows++;
		?> 
		
		<tr>         
		  	<td class='numberd'><i><?php echo $num_rows; ?></i></td> 		  
  		  	<td class='title'><?php echo h($subject['title']); ?></td>		  
      	</tr>
		  
		  <?php } ?>
</tbody>	  
   </table>
   
  
<br />
<br />
<?php

mysqli_free_result($book_author);
	
?>

<!--  </div> -->

<!-- </div> -->

<?php include(SHARED_PATH . '/library_footer.php'); ?>