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

$query1 = run_query("SELECT distinct(nomact)  FROM acteur ORDER BY nomact ASC");
$num1 = count_elements($query1);

for($i=0; $i<$num1; $i++){
  $line1 = fetch_obj($query1);
  $urlactor=rawurlencode($line1->nomact);
        
  echo "<div class=\"actor\">
  		<table>
  		<tr>
  		<td>
  		<span class=\"thumbnail\">
  		<img src=\"actors_pictures/thumbs/", accent_encode($line1->nomact), "_thumb.jpg\" alt=\"",accent_encode($line1->nomact),"\" title=\"", accent_encode($line1->nomact),"\"/></span>
  		</td>";

  echo "<td><span class=\"descriptive\">
  		<b>$LANG_ACTOR:</b> ", "<a href=\"actordetails.php?actor=$urlactor\">", accent_encode($line1->nomact), "</a>", "<br />"; 

  echo "</span> </td></tr></table>";
  echo "\n</div>\n<br />\n\n";
} 

disconnect_db();

?>
</div>

<?php 
require("footer.php");
?>



</body>
</html>