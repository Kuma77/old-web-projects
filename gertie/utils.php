<?php
					  
header("Vary: Accept");
header("Content-Type: application/xhtml+xml; charset=utf-8"); //This is to set the output file content to xhmtl and make it valid

//your config
$DATABASE="MySQL"; //the database you will use. Don't forget to 
//configure the connection information in db_connect, located in 
//utils_$DATABASE.php

if(isset($_SESSION['language']) && $_SESSION['language'] !=NULL){
$LANGUAGE=$_SESSION['language'];
} else {
$LANGUAGE="fr"; //the website's default language
};

if ($DATABASE=="MySQL"){
require("utils_mysql.php"); //require utils_mysql or utils_postgresql depending on the database you're using
} elseif ($DATABASE=="PostgreSQL"){
require("utils_postgresql.php");
}

$languagefiletoinclude="lang_".$LANGUAGE.".php";

if (!include($languagefiletoinclude)){
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\"  xml:lang=\"en\">	
	<body>No language file found.</body></html>";
	
	exit();
}
	

$TIME=date("F j, Y, g:i a");



?>
