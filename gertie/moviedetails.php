<?php 
require("head.php");
?>
<body>

<?php 
require("header.php");
?>

<div id="content">

<?php

$movie=$_GET['movie']; //we get the movie we want to display the details of
$time = date("H:i"); //we store the current time of the day

$synopsis_location=str_replace(" ", "", 'synopsis/'.$LANGUAGE.'/'.accent_encode($movie)); //this is needed to access the movie's synopsis file, which is the movie's name without spaces

$synopsis_location= html_entity_decode($synopsis_location);

if (is_file($synopsis_location)){
  $lines = file($synopsis_location);
  foreach ($lines as $line_num => $line) {
    $synopsis=$synopsis.htmlspecialchars($line);
    $synopsis=$synopsis."<br />";
  }
} else {
  $synopsis=$LANG_NO_SYNOPSIS;
}

connect_db();

$movie_sql=string_encode($movie);

$producer=fetch_obj(run_query("SELECT metteurscene FROM film WHERE titre='$movie_sql'"))->metteurscene;
$urlproducer=rawurlencode($producer);
$producer= "<a href=\"producerdetails.php?producer=$urlproducer\">".$producer."</a>";

  $query1=run_query("SELECT * FROM acteur WHERE titre='$movie_sql'");
  $num1 = count_elements($query1);

	for($i=0; $i<$num1; $i++){
  	$line1 = fetch_obj($query1);
  	$urlactor=rawurlencode($line1->nomact);
	$actors=$actors."<a href=\"actordetails.php?actor=$urlactor\">".accent_encode($line1->nomact)."</a>";
	
	if ($i!=$num1-1){
  	$actors=$actors.", ";
	}	
  }

$time_tosearch=str_replace (":", ".", $time);

//$query2=run_query("SELECT * FROM seance WHERE numsalle=(SELECT numsalle FROM salle WHERE titre='$movie_sql' and heure>'$time_tosearch') ORDER BY heure ASC LIMIT 1");

$query2=run_query("SELECT * FROM seance,salle WHERE (seance.numsalle=salle.numsalle AND salle.titre='$movie_sql' and seance.heure>'$time_tosearch') ORDER BY seance.heure ASC LIMIT 4");

$num2=count_elements($query2);


if ($num2>0){


	$line2=fetch_obj($query2);
	$next_projection_theater=accent_encode($line2->nomcine);
	$next_projection_time=accent_encode(str_replace (".", ":", $line2->heure));
	$url_theater=rawurlencode($line2->nomcine);

	$next="$LANG_IT_IS $time. $LANG_NEXT_PROJECTION $next_projection_time, $LANG_AT_THEATER <a href=\"theaterdetails.php?theater=$url_theater\">$next_projection_theater</a>.";
} else {
$next="$LANG_NO_MORE_PROJECTIONS";
}


$query3=run_query("SELECT * FROM salle natural join seance WHERE titre='$movie_sql'");

$num3=count_elements($query3);

for ($i=0;$i<$num3;$i++){
	$line3=fetch_obj($query3);
	$all_projections=$all_projections.accent_encode($line3->nomcine).", à ".str_replace (".", ":", accent_encode($line3->heure))." $LANG_FOR $line3->prix $LANG_CURRENCY".".<br />";
}




disconnect_db();

echo "<h1>", accent_encode($movie),"</h1>";

echo "<table><tr><td><img src=\"posters/", accent_encode($movie),".jpg\" alt=$LANG_NO_PIC /></td>";
echo "<td><div id=\"actors_producer\"><i>$LANG_BY ", $producer, "</i><br />";
echo "<i>$LANG_WITH ", $actors, "</i></div></td></tr></table>";

echo "<h2 id=\"synopsis\">$LANG_SYNOPSIS: </h2>$synopsis";
echo "<p id=\"next_projection\">$next</p>";

echo "<p id=\"all_projections\">$LANG_ALL_PROJECTIONS:</p>";
echo "$all_projections";

?>



</div>

<?php 
require("footer.php");
?>



</body>
</html>
