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

$query1 = run_query("SELECT * FROM cine");
$num1 = count_elements($query1);
echo "<p>$LANG_THERE";

if ($num1<1){
	echo $LANG_IS;
} else {
	echo $LANG_ARE;}

echo " $num1 $LANG_THEATER2";

if ($num1>1){
	echo "s ";
}

echo " $LANG_IN_GRENOBLE:</p>\n";

for($i=0; $i<$num1; $i++){
  $line1 = fetch_obj($query1);
  $urltheater = rawurlencode($line1->nomcine);


  echo "<b>$LANG_NAME :</b> ", "<a href=\"theaterdetails.php?theater=$urltheater\">", accent_encode($line1->nomcine), "</a>","<br />", 
  "<b>$LANG_ADRESS :</b> <i>", accent_encode($line1->adresse), "</i><br />";
 
  echo "<br /><br />";
} 

disconnect_db();

?>


</div>

<?php 
require("footer.php");
?>



</body>
</html>