<?php require_once('private/initialize.php'); 
include('connect.php');
?>

<?php include(SHARED_PATH . '/library_header.php'); ?>


<br />
<br />
<br />
<h1 style='text-align: center'>Add Handicraft Title </h1>
<br />

<form action="addhandititle.php" method="post">
      
<table class='central'> 
	  <tr>
	  <td class="addtitle">   
         <i>Enter Title</i> 
<input type="text" placeholder="Title" name="inserttitle" autofocus="autofocus" required> (Required)<br />
	</td>
</tr>
   </table>  	

	  
<div class="dropdown">
<table class='centerx'>
<tr>
	<td>
<br />
<br />
<button name="createrecord"><b>Add New Handicraft Book</b></button> 	

</td>
</tr>
</table>

</div>
</form>

<br>
<hr style='background-color:#DCDCDC;height: 4px'>
<br>
	<h2 class='centerx'><i><a class='centerx' href="<?php echo url_for('update.php'); ?>">
				<?php echo "Choose</a> Another Update Option</i>"; ?>  </h2>
				
<br>
				
	<h2 class='centerx'><a class='centerx' href="<?php echo url_for('snovalleylogout.php'); ?>">
				<?php echo "<i>Logout</i>"; ?> </a> </h2>

 <footer class='bottom'>
	 
   &copy: <?php echo date('Y')?> - <a href="mailto:edh@silverreadslibrary.com">Ed Hahn</a>
   </footer>

     </body>
 </html>

