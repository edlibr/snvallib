<?php require_once('private/initialize.php'); 
include('connect.php');
?>

<?php include(SHARED_PATH . '/library_header.php'); ?>


<br />
<br />
<br />
<br />

<div class='user'>
<form action="processuser.php" method="post">
      <dl>
        <dt>
			<i>Enter User's Name</i> 
			<input type="text" placeholder="User's Name" name="name" autofocus="autofocus" autocomplete="off"> <br/>
			<i>Create Username</i>
		
        
<!--		<input type="hidden" name="choice" value="title"> autofocus="autofocus"-->
		<input type="text" placeholder="User Name" name="username" autofocus="autofocus" autocomplete="off"> (Required)<br />
		<i>Create Password</i>
		<input type="password" placeholder="Password" name="password"> (Required)<br />
		<i>Confirm Password</i>
		<input type="password" placeholder="Confirm Password" name="confirm_password"> (Required)<br />
		
		</dt>
      </dl>
<br />
<button name="createrecord"><b>Add User</b></button> 

</form>

</div>	  
	  





 <footer class='bottom'>
	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>

