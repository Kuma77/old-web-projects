<?php						  

$db_connection; //This global var will hold the connection to the database

function connect_db(){ //This function connects to the database
  $host='postgres-info';
  $user='invite';
  $password='invite';
  $dbname='cinema';
  
  global $db_connection;
  $db_connection=pg_connect("host=$host user=$user password=$password dbname=$dbname");
}

function disconnect_db(){ //This function disconnects from the database

pg_close($GLOBALS['db_connection']);
}

function run_query($query_string){ //This function runs a query that is given to it
$query_results = pg_query($GLOBALS['db_connection'], $query_string);
return $query_results;
}

function count_elements($query_results){ //This function counts the number of elements returned by a query
	$num = pg_num_rows($query_results);
	return $num;
}

function fetch_obj($query_results){ //this function fetches an object from a query
	$result_line=pg_fetch_object($query_results);
	return $result_line;
}

function string_encode($string){ //this function is used when passing variables containing special characters to a query
	return pg_escape_string($string);
}

function accent_encode($string){ //This function displays the accents properly (important when using lang_french)
  return $string;
}
?>
