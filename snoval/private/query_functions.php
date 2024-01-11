<?php
	
function books_by_author(){
	global $db;
	$sql ="select author.firstname as 'firstname', ";
	$sql .="author.lastname as 'lastname', ";
	$sql .="author.id as 'authorid', ";
	$sql .="genre.genre as 'subject', ";
	$sql .="genre.id as 'subjectid', ";
	$sql .="title.title as 'title', ";
	$sql .="title.id as 'tid', ";
	$sql .="title.descflag as 'descflag' ";
	$sql .="from title ";
	
	$sql .="join author ";
	$sql .="on title.authorID = author.id ";
	
	$sql .="join genre ";
	$sql .="on title.genreID = genre.id ";
	$sql .="where genre.id <> '10' ";
	$sql .="and title.authorID <> '638' ";
	
	$sql .="order by author.lastname, author.firstname, title.title ";	
//	$sql .="limit 5 ";
//	echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);	
	return $result;
}

function select_date(){
	global $db;
	$sql ="select distinct date(entry_date) as 'dateentered' ";
	$sql .="from title ";
	$sql .="order by dateentered desc ";
	$dresult = mysqli_query($db, $sql);
	confirm_result_set($dresult);	
	return $dresult;
}

function books_by_date(){
	global $db;
	$sql ="select author.firstname as 'firstname', ";
	$sql .="author.lastname as 'lastname', ";
	$sql .="author.id as 'authorid', ";
	$sql .="genre.genre as 'subject', ";
	$sql .="genre.id as 'subjectid', ";
	$sql .="dayname(title.entry_date) as 'weekday', ";
	$sql .="monthname(title.entry_date) as 'month', ";
	$sql .="day(title.entry_date) as 'day', ";
	$sql .="year(title.entry_date) as 'year', ";
	$sql .="title.title as 'title' ";
	$sql .="from title ";
	
	$sql .="join author ";
	$sql .="on title.authorID = author.id ";
	
	$sql .="join genre ";
	$sql .="on title.genreID = genre.id ";
	$sql .="where genre.id <> '10' ";
	$sql .="and title.authorID <> '638' ";
	
	$sql .="order by title.id desc, author.lastname, author.firstname, title.title ";	
	$sql .="limit 10 ";
//	echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);	
	return $result;
}

function handicraft_books(){
	global $db;
	$sql ="select author.firstname as 'firstname', ";
	$sql .="author.lastname as 'lastname', ";
	$sql .="author.id as 'authorid', ";
	$sql .="genre.genre as 'subject', ";
	$sql .="genre.id as 'subjectid', ";
	$sql .="title.title as 'title' ";
	$sql .="from title ";
	
	$sql .="join author ";
	$sql .="on title.authorID = author.id ";
	
	$sql .="join genre ";
	$sql .="on title.genreID = genre.id ";
	$sql .="where genre.id = '10' ";
	$sql .="order by author.lastname, author.firstname, title.title ";	
//	echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);	
	return $result;
}

function books_by_genre($selected){
	global $db;
//	session_start();
	$sql ="select author.firstname as 'firstname', ";
	$sql .="author.lastname as 'lastname', ";
	$sql .="author.id as 'authorid', ";
	$sql .="genre.genre as 'subject', ";
	$sql .="genre.id as 'subjectid', ";
	$sql .="title.title as 'title' ";
	$sql .="from title ";
	
	$sql .="join author ";
	$sql .="on title.authorID = author.id ";
	
	$sql .="join genre ";
	$sql .="on title.genreID = genre.id ";
	
	$sql .="where genre.genre ='" . $selected . "' ";
	
	$sql .="order by author.lastname ";
	
	
//	echo $sql;
	$result = mysqli_query($db, $sql);
	$num=mysqli_num_rows($result);
	confirm_result_set($result);	
	return $result;
	
	$num = $_SESSION['num'];

}


function select_subject(){
	global $db;
	
//	$sql ="select * from month ";
	$sql ="select sum(title.titlenum) as 'Title Total', ";
	$sql .="genre.genre as 'subject' ";
	
	$sql .="from title ";
	$sql .="join genre ";
	$sql .="on title.genreID = genre.id ";
	$sql .="group by genre.genre ";
	
//	echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
//	echo $monthid;
	return $result;
}



?>