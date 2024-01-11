<?php require_once('private/initialize.php'); 
include('connect.php');
?>
<?php 
//$page_title = 'Reunion Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>

<?php
$book_author = books_by_author();
?>

<!--<div style="overflow: auto;" "max-width: 40%;"> -->
<!-- <div class="Subjects listing"> -->
    
<br>	
		<table>	
			<tr>
				<td id='hd1'>
					<a href="<?php echo url_for('index.php'); ?>
					">&laquo Return to Home Page </a>	</td>
				<td id='hd2'>	
					<h1>All Books by Author </h1>
				</td> 
			</tr>
		</table>

		<br>
  	<table class='details'>
		<thead> 
  	  <tr>		 
        <td class='number'></td>
		<td class='author'><b>Author</b></td>
		<td class='title' style='text-align: center;'><b>Title</b></td>
		<td class='subject'><b>Subject</b></td>	
  	  </tr>
	 </thead>	  

	<?php $num_rows = 0 ;?> 

      <?php while($subject = mysqli_fetch_assoc($book_author))
	  
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

<!--  		  <td class='title'><?php echo h($subject['title']); ?></td>		  -->
  		  <td class='subject' style='text-align: left;'><?php echo h($subject['subject']); ?></td>
      	  </tr>
		  
		  <?php } ?>
	  
   </table>
   
<br>
<br>
<?php
mysqli_free_result($book_author);	
?>

<!--</div>-->

<!-- </div> -->

<?php include(SHARED_PATH . '/library_footer.php'); ?>