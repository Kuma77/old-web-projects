<?php 
require("head.php");
?>
<body>

<?php 
require("header.php");
?>

<div id="content">

<?php

$actor=$_GET['actor']; //we get the actor we want to display the details of

$biography_location=str_replace(" ", "", 'biography/'.$LANGUAGE.'/'.accent_encode($actor)); //this is needed to access the actor's biography file, which is the actor's name without spaces


$biography_location= html_entity_decode($biography_location);



if (is_file($biography_location)){
  $lines = file($biography_location);
  foreach ($lines as $line_num => $line) {
    $biography=$biography.htmlspecialchars($line);
    $biography=$biography."<br />";
  }
} else {
  $biography=$LANG_NO_BIO.$LANG_THIS_SUFFIX." ".$LANG_ACTOR2.".";
}

connect_db();

$query=run_query("SELECT titre FROM acteur where nomact='$actor'");
$num=count_elements($query);

$filmography=$filmography."<ul>";
	for($i=0; $i<$num; $i++){
  	$line = fetch_obj($query);
  	$urlmovie=rawurlencode($line->titre);
	$filmography=$filmography."<li><a href=\"moviedetails.php?movie=$urlmovie\">".accent_encode($line->titre)."</a></li>";
	}	
$filmography=$filmography."</ul>";

disconnect_db();

echo "<h1>", accent_encode($actor),"</h1>";

echo "<table><tr><td><img src=\"actors_pictures/", accent_encode($actor),".jpg\" alt=$LANG_NO_PIC /></td>";
echo "<td><b>$LANG_FILMOGRAPHY:</b><br /><br />";
echo"$filmography</td>";
echo "</tr></table>";

echo "<h2 id=\"biography\">$LANG_BIOGRAPHY: </h2>$biography";

?>



</div>

<?php 
require("footer.php");
?>



</body>
</html>