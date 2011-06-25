<?php session_start(); 
// var_dump($_POST); echo "<br />";
// var_dump($_GET); echo "<br />";
// var_dump($_SESSION); echo "<br />";

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="author" content="Guillaume Ardaud" />
<link type="text/css" href="css/style.css" rel="stylesheet" />
<link type="text/css" href="css/smoothness/jquery-ui-1.7.1.custom.css" rel="stylesheet" />	

<title>Eventify Me!</title>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script> 
</head>

<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
mode : "textareas",
theme : "simple"
});
</script>
<?php require("star_rating/includes/rating_functions.php"); ?>
<link href="star_rating/css/rating_style.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="star_rating/js/rating_update.js"></script>


<?php
require("utils_mysql.inc.php");
require("functions.inc.php");

$member=loggedInUser();

if (isset($_GET['action'])){
	if ($_GET['action']=='logout'){
		unset($_SESSION['user']);
		session_destroy(); 
	}
}

if (isset($_POST['login_name'])){
	//try to login user	
	if(login_user($_POST['login_name'],$_POST['login_pass'])){
		$_SESSION['user']=$_POST['login_name'];
		$member=loggedInUser();
	}

}
?>

<body>

<div id="banner">
</div>

<div id="menu">
<span><a href="index.php">Home</a></span>


<?php
if (!empty($_SESSION['user'])){ //if user connected
?>
<span><a href="profile.php">My Profile</a></span>
<span><a href="events.php">My events</a></span>
<span><a href="friends.php">My friends</a></span>
<span>You're logged in as: <?php echo $member['login'];?>. (<a href="index.php?action=logout" class="no-decoration">logout?</a>)</span>
<?php
} else {
?>
<span>Not logged in (need to <a href="register.php" class="no-decoration">register</a>?)</span>
<?php
}
?>
</div>

<script type="text/javascript">
	$(function() {
		$("#research").accordion({
		collapsible: true,
		autoHeight: false,
		active: false
		});
		
						
	});
	</script>
	
<div id="content">
<?php
if (empty($_SESSION['user'])){ //if user connected
?>
<form action="index.php" method="post"><span class="highlight">Login: &nbsp;</span><input type="text" name="login_name"/>&nbsp;<input type="password" name="login_pass"/>&nbsp;<input type="submit" value="Login"/></form> 
<?php } ?>
<br />
<div id="research">
	<h3><a href="#">Search for...</a></h3>
	<div>
	<form method="get" action="search.php">
	<fieldset>
		<input type="radio" name="type" value="user" checked/>A user?
		<input type="radio" name="type" value="event"/>An event?
		<br />
		<br />
		<label for="name">Type what you're looking for...</label>
		<input type="text" name="name" class="text ui-widget-content ui-corner-all" />
		<br />
		<br />
		<input type="submit" class="ui-button ui-state-default ui-corner-all" value="And search!"/>
		</fieldset>
	</form>	</div>
</div>

<br />
<br />