<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<div id="content">

<?php

connect_db();

$query1 = run_query("SELECT * FROM film");
$num1 = count_elements($query1);

echo "<p>", $LANG_AT_THE_MOMENT, " $num1 ", $LANG_MOVIES_IN_GRENOBLE, "</p>";

for($i=0; $i<$num1; $i++){
  $line1 = fetch_obj($query1);
  $urltitle=rawurlencode($line1->titre);
  $urlproducer=rawurlencode($line1->metteurscene);
        
  echo "<div class=\"movie\">
  		<table>
  		<tr>
  		<td>
  		<span class=\"thumbnail\">
  		<img src=\"posters/thumbs/", accent_encode($line1->titre), "_thumb.jpg\" alt=\"",accent_encode($line1->titre),"\" title=\"", accent_encode($line1->titre),"\"/></span>
  		</td>";

  echo "<td><span class=\"descriptive\">
  		<b>$LANG_MOVIE:</b> ", "<a href=\"moviedetails.php?movie=$urltitle\">", accent_encode($line1->titre), "</a>", "<br />", 
  		"<b>$LANG_BY:</b> <i>", "<a href=\"producerdetails.php?producer=$urlproducer\">", accent_encode($line1->metteurscene), "</a></i><br />", "<b>$LANG_WITH: </b>"; 

  	   
  $title=string_encode($line1->titre);
  $query2 = run_query("SELECT * FROM acteur where titre='$title'");
  $num2 = count_elements($query2);

	for($j=0; $j<$num2; $j++){
  	$line2 = fetch_obj($query2);
  	$urlactor=rawurlencode($line2->nomact);
	echo "<i><a href=\"actordetails.php?actor=$urlactor\">", accent_encode($line2->nomact), "</a></i>";
	
	if ($j!=$num2-1){
	echo ", ";}
	}	


  echo "</span> </td></tr></table></div>";
  


  	   
  echo "<br /><br /><br />";
} 

disconnect_db();

?>
</div>

<?php 
require("footer.php");
?>



</body>
</html>