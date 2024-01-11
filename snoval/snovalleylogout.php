<?php session_start(); ?>
<?php require_once('private/initialize.php'); 
include('connect.php');
?>

<?php include(SHARED_PATH . '/library_header.php'); 

unset($_SESSION['username']);
unset($_SESSION['id']);
redirect_to(url_for('snovalleylogin.php'));
?>

 <footer class='bottom'>	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>

