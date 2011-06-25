<?php						  

$db_connection; //This global var will hold the connection to the database

function connect_db(){ //This function connects to the database
  $host='localhost';
  $user='noxneo';
  $password='rabbids2006';
  $dbname='noxneo_cinema';
  
  $connexion_bd=@mysql_connect($host, $user, $password) or die(mysql_error());
  mysql_select_db($dbname) or die(mysql_error());
}

function disconnect_db(){ //This function disconnects from the database
mysql_close() or die(mysql_error());
}

function run_query($query_string){ //This function runs a query that is given to it
$query_results = mysql_query($query_string) or die(mysql_error());
return $query_results;
}

function count_elements($query_results){ //This function counts the number of elements returned by a query
	return mysql_num_rows($query_results);
}

function fetch_obj($query_results){ //this function fetches an object from a query
	$result_line=mysql_fetch_object($query_results) or die(mysql_error());
	return $result_line;
}

function string_encode($string){ //this function is used when passing variables containing special characters to a query
	return mysql_real_escape_string($string);
}

function accent_encode($string){ //This function displays the accents properly (important when using lang_french)
  return htmlentities($string);
}

?>
