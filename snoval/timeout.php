<?php require_once('private/initialize.php'); 
include('connect.php');
?>
<?php $page_title = 'Sno Valley Library Books'; ?>
<?php include(SHARED_PATH . '/library_header.php'); ?>

<?php 
date_default_timezone_set('America/Los_Angeles');

?>

<br /> 	 
<br />
<br />
<br />
<h2>
You have been logged out due to inactivity.</h2> <br /> 
<h2>
Please click <a class="actions" href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<u>here</u>"; ?> </a> to login again.
</h2>

<br /> 	 
<hr />
<br />
<br />

<img src="images/owl.jpg" alt="Logout">







 <footer class='bottom'>
	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>

