<?php
/*
Dynamic Star Rating Redux
Developed by Jordan Boesch
www.boedesign.com
Licensed under Creative Commons - http://creativecommons.org/licenses/by-nc-nd/2.5/ca/

Used CSS from komodomedia.com.
*/
header("Cache-Control: no-cache");
header("Pragma: nocache");

//require("rating_config.php");
// Cookie settings
$expire = time() + 99999999;
$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost

require_once("../../utils_mysql.inc.php");
$db=new database();

// escape variables
function escape($val){

	$val = trim($val);
	
	if(get_magic_quotes_gpc()) {
       	$val = stripslashes($val);
     }
	 
	 return mysql_real_escape_string($val);
	 
}

	$id = escape($_GET['id']);
	$rating = (int) $_GET['rating'];
	
	// If you want people to be able to vote more than once, comment the entire if/else block block and uncomment the code below it.
	
	if($rating <= 5 && $rating >= 1){
	
		if(@mysql_fetch_assoc(isset($_COOKIE['has_voted_'.$id]))){ //$db->run_query("SELECT id FROM ratings WHERE IP = '".$_SERVER['REMOTE_ADDR']."' AND rating_id = '$id'")) || 
		
			echo 'already_voted';
			
		} else {
			
			setcookie('has_voted_'.$id,$id,$expire,'/',$domain,false);
			$db->run_query("INSERT INTO ratings (rating_id,rating_num,IP) VALUES ('$id','$rating','".$_SERVER['REMOTE_ADDR']."')") or die(mysql_error());
			
		}
		
		if ($id>1000){
			$id=$id-1000;
		}
		
		if (isset($_GET['id'])){
		header("Location:".$_SERVER['HTTP_REFERER']."");
		} else {
		header("Location:".$_SERVER['HTTP_REFERER']."?id=$id");
		}
		
		die;
		
	}
	else {
	
		echo 'You cannot rate this more than 5 or less than 1 <a href="'.$_SERVER['HTTP_REFERER'].'">back</a>';
		
	}



?>
