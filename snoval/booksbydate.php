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

<?php
$book_author = books_by_date();
?>

<!--<div style="overflow: auto;" "max-width: 40%;"> -->
<!-- <div class="Subjects listing"> -->

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
						 
  		 
					<?php
					} else {;	
					 ?>	
				
<?php 

		$sql="select author.firstname as 'firstname', author.lastname as 'lastname',
			title.title as 'title', title.id as 'tid', 
			title.descflag as 'descflag', genre.genre as 'subject',
			date(title.entry_date) as 'date_entered', 
			date_format(title.entry_date, '%M %d, %Y') as 'entry_date'
			from title
			join author on title.authorID = author.id
			join genre on title.genreID = genre.id
			where date(title.entry_date) >= '". mysqli_real_escape_string($con, $selected) . "'
			order by date_entered desc";
//			order by author.lastname, author.firstname, title.title";
	
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
								
							<a href="<?php echo url_for('selectdate.php'); ?>
														"> Select Another Date </a>	</td>
						
				<?php		if ($num==1) { ?>
							<td id='hd2'>	
						<h1> <?php echo $num . "&nbsp;Book Selected"; ?> </h1>
							 </td> 
				<?php }else
				{?>
			<td id='hd2'>	
						<h1> <?php echo $num . "&nbsp;Books Selected"; ?> </h1>
							 </td>
				<?php
				}
				?>
						</tr>
						</table>
					
					<table class="detailsdate">
						<br>
				  	  
					<tr>		 
        				<td class='number'></td>
						<td class='author'><b>Author</b></td>
						<td class='titledate' style='text-align: center;' ><b>Title</b></td>
						<td class='subjectdate'><b>Subject</b></td>
						<td class='subject'><b>Date Added</b></td>	
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
  		  			<td class='titledate'> <?php echo h($subject['title']); ?></td> 
					<?php }else{ 
					?>

<!--<a href="../html-link.htm" target="popup" onclick="window.open('../html-link.htm','name','width=600,height=400')"> -->
<!--					<td class="titledate"> <i> <a href="<?php echo url_for('selectdescription.php? id=' . h(u($subject['tid'])));?>" target="popup" onclick="window.open('selectdescription.php? id=' . h(u($subject['tid'])));?>','name','width=600,height=400')"><?php echo h($subject['title']);?></a></i></td> -->

					<td class="titledate"> <i><a href="<?php echo url_for('selectdescription.php? id=' . h(u($subject['tid'])));?>" target="_blank">
					<?php echo h($subject['title']);?></a></i></td> 
					<?php }?>

					<td class='subjectdate' style='text-align: left;'><?php echo h($subject['subject']); ?></td>
					<td class='subject' style='text-align: left;'><?php echo h($subject['entry_date']); ?></td>
      	  				</tr>

						  <?php } ?>
				   </table>
  				
	<?php
} 
					}
				}
			}
?>

<br>
<br>
<br>

<h2><a class="actionsx" href="<?php echo url_for('booksbydateentered.php'); ?>">
				Select</a> Another Date Option</h2>
				<br>
	
	<h2><a class="actionsx" href="<?php echo url_for('update.php'); ?>">
				Choose</a> Another Update Option</h2>

				<br>

	<h2>	<a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2>


<br>
<br>
<br>
<br>


<!--</div>-->

<!-- </div> -->

<?php include(SHARED_PATH . '/library_footer.php'); ?>