<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<div id="content">

<?php

$theater=$_GET['theater'];

connect_db();

$adress= fetch_obj(run_query("SELECT adresse FROM cine"))->adresse;
$price_average= fetch_obj(run_query("SELECT AVG(prix) AS price FROM salle WHERE nomcine='$theater'"))->price;

$query1 = run_query("SELECT *  FROM salle where nomcine='$theater'");
$num1 = count_elements($query1);


$projections=$projections."<div id=\"projections\"><table><tr><th>$LANG_MOVIE</th><th>$LANG_HOURS</th><th>$LANG_PRICE</th></tr>";
for($i=0; $i<$num1; $i++){
  $line1 = fetch_obj($query1);
  $urlmovie=rawurlencode($line1->titre);
  $sqlmovie=string_encode($line1->titre);
  $projections=$projections."<tr><td><a href=\"moviedetails.php?movie=$urlmovie\">".accent_encode($line1->titre)."</a>:</td><td>";
  
 	 $query2 = run_query("SELECT heure FROM salle natural join seance where nomcine='$theater' and titre='$sqlmovie'");
	 $num2 = count_elements($query2);
	 
	 for($j=0; $j<$num2; $j++){
	 	$projections=$projections;
	 	$line2=fetch_obj($query2);
	 	$projections=$projections.str_replace(".", ":", $line2->heure);
	 		if ($j==$num2-1){
	 		$projections=$projections.".</td>";
	 		}else{
	 		$projections=$projections.", ";}
	 }
  
  $projections=$projections."<td>$line1->prix $LANG_CURRENCY</td>";
  $projections=$projections."</tr>";
}

$projections=$projections."</table></div>";

disconnect_db();

echo "<h1>", accent_encode($theater),"</h1>";
echo "<p id=\"picture_cine\"><img src=\"photos_cinemas/", accent_encode($theater),".png\" alt=\"", accent_encode($theater), "\" /></p>";
echo "$LANG_ADRESS: <i>", $adress, "</i> (voir sur <a href=\"http://maps.google.fr/?q=$adress\">Google Maps</a>)<br /><br />";
echo $description;

echo $projections, "<br /><br />";
echo "$LANG_PRICE_AVG: ", round($price_average,2), $LANG_CURRENCY;
?>


</div>

<?php 
require("footer.php");
?>



</body>
</html>