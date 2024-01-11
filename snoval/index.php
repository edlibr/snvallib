<?php require_once('private/initialize.php'); 
include('connect.php');
?>
<?php 
//$page_title = 'Reunion Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>

<?php 
date_default_timezone_set('America/Los_Angeles');
?>
<br>
<h2>
<?php
$today = date("l, F d, Y");

echo "Welcome to the Library Website <br> Today is - " . $today;
?>
</h2>
<br>
<hr>
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
<br>
<hr>
<br>
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
}
?>	

<div class="dropdown">		

<form action="choice.php" method="post"> 	
	<input class="dropdowni" type="submit" value="Select Subject" name="submit">
	<input type="hidden" name="choice" value="dropdown">
<select style="text-align: center;" name="loc[]" required> 
<table class='centerx'>
<tr>
	<td>
<option style="text-align: center;" value="">Select Item</option>

<?php
while ($row=mysqli_fetch_assoc($result)) {
	?>
<option value="<?php echo $row['subject'];  ?>"> 
	<?php  echo $row['subject'];  ?>
	
</option>
<?php 
}
?>

</select>
</td>
</tr>
</table>	
</form>
</div>		   		
 <br />
 

 <hr>
<br />
<table class="center">	
	<tr>
							
	<td id='hd3'>	
		<a class="actions2" href="<?php echo url_for('booksbyauthor.php'); ?>">
				<?php echo "Browse All Books By Author"; ?> </a>
	</td> 
	</tr>
</table>
<br>
<br>
<table class="center">	
	<tr>
							
	<td id='hd3'>	
		<a class="actions2" href="<?php echo url_for('handicraftbooks.php'); ?>">
				<?php echo "Browse Handicraft Books"; ?> </a>
	</td> 
	</tr>
</table>

<br>
<br>
<table class="center">	
	<tr>
							
	<td id='hd3'>	
		<a class="actions2" href="<?php echo url_for('snovalleylogin.php'); ?>" target="_blank">
				<?php echo "Add Book to the Collection (Valid ID Required)"; ?> </a>
	</td> 
	</tr>
</table>

<br>
<br>
<br>
<figure>
<img src="images/snovalley.jpg" alt="Sno Valley Senior Center" title="Sno Valley Senior Center">
<figcaption style='text-align: center;'><h4>Sno Valley Senior Center</h4></figcaption>
</figure>
<br />
<br />

<?php include(SHARED_PATH . '/library_footer.php'); ?>

