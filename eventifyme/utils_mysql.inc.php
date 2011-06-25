<?php						  

class database{
	var $dbConnection; //This var will hold the connection to the database
	
	var $host='localhost'; //These should probably be passed to the constructor instead, but what the heck.
	var $user='noxneo';
	var $pass='rabbids2006';
	var $dbname='noxneo_eventifyme';
		
	function __construct(){ //This function connects to the database
		$this->dbConnection=mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this->dbname);
	}
	
	function __destruct(){ //This function disconnects from the database
		@mysql_close($this->dbConnection); //yes very ugly hack but what the hell.
	}
	
	function run_query($query_string){ //This function runs a query that is given to it
		$query_results = mysql_query($query_string, $this->dbConnection) or die (mysql_error());
		
		return $query_results;
	}
	
	function count_objects($query_results){ //This function counts the number of elements returned by a query
		return mysql_num_rows($query_results);
	}
	
	function fetch_obj($query_results){ //this function fetches an object from a query
		$result_line=mysql_fetch_object($query_results);
		return $result_line;
	}
}
?>
