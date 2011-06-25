<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<div id="content">


<?php
 
 if ((isset($_POST['style']) && $_POST['style']!=NULL) || (isset($_POST['language']) && $_POST['language']!=NULL)){
    echo "<b class=\"pref_ok\"><a href=\"index.php\">$LANG_PREFERENCE_SAVED</a></b>";
    $_SESSION['language']=$_POST['language'];
    $_SESSION['style']=$_POST['style'];
    ?>

<script language="JavaScript">
window.location="index.php";
</script>

<?php
}

	echo "<h1>", $LANG_CONFIG, "</h1>";
	echo "$LANG_ABOUT_CONFIG";

  echo "<h2>$LANG_APPEARANCE</h2>";
  echo "$LANG_ABOUT_APPEARANCE";

  echo "<form method=\"post\" action=\"config.php\">
  <select name=\"style\">
  <option value=\"olivegreen.css\">Vert olive</option>
  <option value=\"black_red.css\">Rouge et noir</option>
  <option value=\"ocean_blue.css\">Bleu océan</option>
  </select>";

  echo "<h2>$LANG_LANGUAGE</h2>";
  echo "$LANG_ABOUT_LANGUAGE <br />";

  echo "<select name=\"language\">
  <option value=\"fr\">Français</option>
  <option value=\"en\">English</option>
  </select>";



  echo "<br /><br /><br /><input type=\"submit\" value=\"Ok\" />";
  echo "</form>";

?>
</div>

<?php 
require("footer.php");
?>



</body>
</html>