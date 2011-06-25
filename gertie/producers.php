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

$query1 = run_query("SELECT distinct(metteurscene)  FROM film ORDER BY metteurscene ASC");
$num1 = count_elements($query1);

for($i=0; $i<$num1; $i++){
  $line1 = fetch_obj($query1);
  $urlproducer=rawurlencode($line1->metteurscene);
        
  echo "<div class=\"producer\">
  		<table>
  		<tr>
  		<td>
  		<span class=\"thumbnail\">
  		<img src=\"producers_pictures/thumbs/", accent_encode($line1->metteurscene), "_thumb.jpg\" alt=\"",accent_encode($line1->metteurscene),"\" title=\"", accent_encode($line1->metteurscene),"\"/></span>
  		</td>";

  echo "<td><span class=\"descriptive\">
  		<b>$LANG_PRODUCER:</b> ", "<a href=\"producerdetails.php?producer=$urlproducer\">", accent_encode($line1->metteurscene), "</a>", "<br />"; 

  echo "</span> </td></tr></table></div>";
  echo "<br />";
} 

disconnect_db();

?>
</div>

<?php 
require("footer.php");
?>



</body>
</html>