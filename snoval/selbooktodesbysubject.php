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
			and title.descflag='n'
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
								
							<a href="<?php echo url_for('adddescriptionbysubject.php'); ?>
														">&laquo Previous Screen</a>	</td>
							<td id='hd2'>	
							<h1>Click on Title to Add Description</h1>
<!--						<h1> <?php echo $num . "&nbsp;Books in" . "&nbsp;" . h($selected); ?> </h1> -->
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
							
					<?php if ($subject['descflag'] == 'Y') {
					?>
  		  			<td class='title'> <?php echo h($subject['title']); ?></td> 
					
					<?php }else{ 
					?>

					<td class="title"> <i><a href="<?php echo url_for('insertdescription.php? id=' . h(u($subject['tid'])));?>" target="_blank" >
					<?php echo h($subject['title']);?></a></i></td>

<!--					<td class="title"> <i><a href="<?php echo url_for('selectdescription.php? id=' . h(u($subject['tid'])));?>" target="_blank">
					<?php echo h($subject['title']);?></a></i></td> -->
					<?php }?>

					<td class='subject' style='text-align: left;'><?php echo h($subject['subject']); ?></td>
      	  				</tr>

						  <?php } ?>
				   </table>
  				
	<?php
	}
} ?>

<br>
<br>
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "<i>Choose</a> Another Update Option</i>"; ?>  </h2>				
<br />				
<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2> 
<br>


<br>
<br>
<br>
<footer>
 &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
 </footer>	
 
 <?php	
	}
}
	?>
	