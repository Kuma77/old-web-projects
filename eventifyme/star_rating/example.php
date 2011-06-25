<? 
/*
Dynamic Star Rating Redux 1.7
Developed by Jordan Boesch
www.boedesign.com
Licensed under Creative Commons - http://creativecommons.org/licenses/by-nc-sa/2.5/ca/

Used CSS from komodomedia.com.
*/

include("includes/rating_functions.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>AJAX Dynamic Star Rating 1.7 - By Jordan Boesch - www.boedesign.com</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="css/rating_style.css" rel="stylesheet" type="text/css" media="all">
	<script type="text/javascript" src="js/rating_update.js"></script>	
</head>
<body>

	<h1 style="background:#134664;color:#D5FDFF;padding:10px;">Unobtrusive Dynamic Star Rating 1.7 - By Jordan Boesch</h1>	
	
	<?
	/*
	
	USAGE:
	id = integer (number)
	show 3/5 = boolean (true/false)
	show percentage = boolean (true/false)
	show votes = boolean (true/false); 
	allow vote = 'novote' (string) OPTIONAL, if not using, leave empty or NULL
	
	pullRating(id, show 3/5, show percentage, show votes, allow vote);
	
	USAGE FOR TOP VOTES:
	id = integer (number)
	table_name = name of the table that are holding your items you are rating (string)
	table_id = the id of the field in the table you are rating. This is usually 'id' or 'article_id'
	table_title = the title of the field in the table you are rating.  This is something like 'article_title'
	*/
	?>
	
	<h3>Variation 1 (The most prefered method)</h3>

	<? echo pullRating(11,true,false,true); ?>
	
	<h3>Variation 2</h3>
	
	<? echo pullRating(44,true,false,false); ?>
		
	<h3>Variation 3</h3>
	
	<? echo pullRating(35,false,false,false); ?>
	
	<h3>Variation 4</h3>
	
	<? echo pullRating(21,true,true,true); ?>
	
	<h3>Variation 5</h3>
	
	<? echo pullRating(25,false,true,true); ?>
	
	<h3>Variation 6 (With the 'novote' attribute)</h3>
	
	<? echo pullRating(45,false,true,true,'novote'); ?>

	<h3>Top 10 Votes</h3>
	
	<? echo getTopRated(10,'articles','id','name'); ?>

	
</body>
</html>