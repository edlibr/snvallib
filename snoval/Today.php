<?php require_once('private/initialize.php'); 
include('connect.php');
?>
<?php $page_title = 'Reunion Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>

<?php 
date_default_timezone_set('America/Los_Angeles');
?>
<br />
<br />



	
		
		
		<form>
		<input type = "button" value = "Click me" />
		</form>

<h1>
<?php
$today = date("l, F d, Y");

echo "Today is - " . $today;
echo "<br />";
$time = date("H:i:s");

echo "Time is - " . $time;

?>
</h1>