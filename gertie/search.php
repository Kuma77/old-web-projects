<?php
/*
This page searches for expressions given to it via a POST request in the database, and searches for them.

Its order of search is:
-Movie (ie a movie's name)
-Theater (ie a theater's name)
-Producer (ie a producer's name)
-Actor (ie an actor's name)

??Look into a movie's synopsis ??
??suggest different terms ??

*/
?>

<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<div id="content">

<div id="search_header">
<?php

$numresults=0;

if (!isset($_GET['pass']) || $_GET['pass']==NULL){
	$pass=0;
} else {
 $pass=$_GET['pass'];
}
	
	
	
if (!isset($_GET['search']) || $_GET['search']==NULL){
	echo $LANG_NO_SEARCH_TOKEN;
}
else{
	$tokens=$_GET['search']; //here we get every word, and put it in an array. If the array is empty, we display a message.
	$array=explode(' ', $tokens);
	$array_length=count($array);

	echo $LANG_SEARCH_RESULTS_FOR; //quick hack to have a different string depending on the plurality of the search tokens
	
	if ($array_length>1){
	echo "$LANG_PLURAL";} 
	
	echo " $LANG_TERM";
	
	if ($array_length>1){
	echo "s";} 
	
	echo " $LANG_NEXT";
	if ($array_length>1){
	echo "$LANG_PLURAL";}
	
	echo ": <i>";
	
	for ($i=0;$i<$array_length;$i++){
		if($i==$array_length-1){
		echo $array[$i], ".";
		} else {
		echo $array[$i], ", ";
		}
	$array[$i]="#".$array[$i]."#";
	$array[$i]=$array[$i]."i";
	if ($_GET['pass']==1){
		}	
	}
	
	echo "</i><br /><br />";


//REAL FUN BEGINS

echo "<b>$LANG_SEARCH_RESULTS:</b><br/><br/>";

connect_db();


//For movies
for ($i=0;$i<$array_length;$i++){ //for each token
$query1 = run_query("SELECT titre FROM film");
$num1 = count_elements($query1);

for ($j=0;$j<$num1;$j++){ //for each row of the db
	$line1=fetch_obj($query1);
		if (preg_match($array[$i],$line1->titre)){
			$film=accent_encode($line1->titre);
			$filmurl=rawurlencode($film);
			
			if (!strstr($finalresult, $film)){
			$finalresult=$finalresult."<a href=\"moviedetails.php?movie=$filmurl\">".$film."</a> <i>($LANG_MOVIE)</i><br />";
			$numresults=$numresults+1;
			}
			
		}

	}
}


//Now for actors
for ($i=0;$i<$array_length;$i++){ //for each token
$query1 = run_query("SELECT nomact FROM acteur");
$num1 = count_elements($query1);

for ($j=0;$j<$num1;$j++){ //for each row of the db
	$line1=fetch_obj($query1);
		if (preg_match($array[$i],$line1->nomact)){
			$acteur=accent_encode($line1->nomact);
			$acteururl=rawurlencode($acteur);
			
			if (!strstr($finalresult, $acteur)){
			$finalresult=$finalresult."<a href=\"actordetails.php?actor=$acteururl\">".$acteur."</a> <i>($LANG_ACTOR)</i><br />";
			$numresults=$numresults+1;
			}
			
		}

	}
}

//Now for producers
for ($i=0;$i<$array_length;$i++){ //for each token
$query1 = run_query("SELECT metteurscene FROM film");
$num1 = count_elements($query1);

for ($j=0;$j<$num1;$j++){ //for each row of the db
	$line1=fetch_obj($query1);
		if (preg_match($array[$i],$line1->metteurscene)){
			$metteurscene=accent_encode($line1->metteurscene);
			$metteursceneurl=rawurlencode($metteurscene);
			
			if (!strstr($finalresult, $metteurscene)){
			$finalresult=$finalresult."<a href=\"producerdetails.php?producer=$metteursceneurl\">".$metteurscene."</a> <i>($LANG_PRODUCER)</i><br />";
			$numresults=$numresults+1;
			}
			
		}

	}
}



echo $finalresult;


echo "<br />$numresults $LANG_RESULT$LANG_PLURAL.";

//Not implemented yet
//if ($numresults==0){
//echo "<a href=\"search.php?search=",$_GET['search'],"&amp;pass=",$pass+1,"\">$LANG_BROADER_SEARCH</a>";
//}

disconnect_db();
}
?>
</div>

<div id="results">


</div>

</div>
<?php 
require("footer.php");
?>



</body>
</html>