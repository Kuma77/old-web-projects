<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<div id="content">

<?php

$producer=$_GET['producer']; //we get the producer we want to display the details of

$biography_location=str_replace(" ", "", 'biography/'.$LANGUAGE.'/'.accent_encode($producer)); //this is needed to access the producer's biography file, which is the producer's name without spaces


$biography_location= html_entity_decode($biography_location);



if (is_file($biography_location)){
  $lines = file($biography_location);
  foreach ($lines as $line_num => $line) {
    $biography=$biography.htmlspecialchars($line);
    $biography=$biography."<br />";
  }
} else {
  $biography=$LANG_NO_BIO." ".$LANG_PRODUCER2.".";
}

connect_db();

$query=run_query("SELECT titre FROM film where metteurscene='$producer'");
$num=count_elements($query);

echo "<ul>";
	for($i=0; $i<$num; $i++){
  	$line = fetch_obj($query);
  	$urlmovie=rawurlencode($line->titre);
	$filmography=$filmography."<li><a href=\"moviedetails.php?movie=$urlmovie\">".accent_encode($line->titre)."</a></li>";
	}	
echo "</ul>";

disconnect_db();

echo "<h1>", accent_encode($producer),"</h1>";

echo "<table><tr><td><img src=\"producers_pictures/", accent_encode($producer),".jpg\" alt=$LANG_NO_PIC /></td>";
echo "<td><b>$LANG_FILMOGRAPHY:</b><br /><br />";
echo"$filmography</td>";
echo "</tr></table>";

echo "<p id=\"biography\"><h2>$LANG_BIOGRAPHY: </h2>$biography</p>";

?>



</div>

<?php 
require("footer.php");
?>



</body>
</html>