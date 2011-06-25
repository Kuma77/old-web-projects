<?php
//error_reporting(E_ALL);
$server = 'localhost';
$dbuser = 'noxneo';
$dbpass = 'rabbids2006';
$dbname = '_eventifyme';

$x = mysql_connect($server,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname,$x);
?>