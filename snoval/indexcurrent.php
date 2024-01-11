<?php require_once('private/initialize.php'); 
include('connect.php');
?>
<?php 
//$page_title = 'Reunion Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>

<?php 
date_default_timezone_set('America/Los_Angeles');
?>

<h2>
<?php
$today = date("l, F d, Y");

echo "Welcome to the Sno Valley Senior Center Library <br /> Today is - " . $today;

?>
</h2>

<br />
<hr />
<br />

<form action="choice.php" method="post">
      <dl>
        <dt><i>Enter Keyword Search</i>
		&nbsp;
        
		<input type="hidden" name="choice" value="title">
		<input type="text" placeholder="Enter Search" name="search" autofocus="autofocus"> 
		
<!---		<input type="submit" value="search"> -->
		<button name="Submit"><b>Search </b></button> 
		</dt>
      </dl>
</form>

<br />
<hr />
<br />

<?php

$query="select sum(title.titlenum), genre.genre as 'subject'
	from title
	join genre on title.genreID=genre.id
	where genre.id <>10
	group by genre.genre
	order by sum(title.titlenum) desc";
$result = mysqli_query($con, $query);

	if($result){
	$num=mysqli_num_rows($result);
//	echo $num;
}
?>	

<div class="dropdown" >		

<form action="choice.php" method="post"> 	
	<input class="dropdown" type="submit" value="Select Subject" name="submit">	
	<input type="hidden" name="choice" value="dropdown">
<select name="loc[]" required> 
	<dl>
		<dt>
<option  value="">Select Item</option>

<?php
while ($row=mysqli_fetch_assoc($result)) {
	?>
<option value="<?php echo $row['subject'];  ?>"> 
	<?php  echo $row['subject'];  echo "<br/>"; ?>
	
</option>
<?php 
}
?>

</select>
</dt>
	</dl>	
</form>
</div>		   		
 <br />
 

<hr />
<br />
<table class="center">	
	<tr>
							
	<td id='hd3'>	
		<a class="actions2" href="<?php echo url_for('booksbyauthor.php'); ?>">
				<?php echo "Browse All Books By Author"; ?> </a>
	</td> 
	</tr>
</table>

<hr />
<br />
<table class="center">	
	<tr>
							
	<td id='hd3'>	
		<a class="actions2" href="<?php echo url_for('handicraftbooks.php'); ?>">
				<?php echo "Browse Handicraft Books"; ?> </a>
	</td> 
	</tr>
</table>

<hr />
<br />
		
<table class="center">	
	<tr>
							
	<td id='hd3'>	
		<a class="actions2" href="<?php echo url_for('snovalleylogin.php'); ?>">
				<?php echo "Add Book to the Collection"; ?> </a>
	</td> 
	</tr>
</table>

<br />
<hr />
<br />
<img src="images/snv.png" alt="Sno Valley Senior Center">

<!--<p class="center">Image by <a href="https://pixabay.com/users/luboshouska-198496/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1204029">
	Lubos Houska</a> from <a href="https://pixabay.com//?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1204029">Pixabay</a></p>
-->
<br />
<br />

<?php include(SHARED_PATH . '/library_footer.php'); ?>

