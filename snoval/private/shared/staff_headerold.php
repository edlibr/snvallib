<?php
 if(!isset($page_title)) { $page_title = "Bike Rides"; } 
?>

<!doctype html>

<html lang="en">
  <head>
    <title><?php echo h($page_title); ?></title>
    <meta charset="utf-8">
	<link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/stafftest.css'); ?>" />
  </head>

  <body>
  <header>
	  <h1>Bike Riding Information</h1>
  </header>
  
  