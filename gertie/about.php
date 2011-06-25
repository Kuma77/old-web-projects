<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<?php

echo("<div id=\"content\">
<h1>$LANG_ABOUT_GERTIE</h1>
$LANG_ABOUT_GERTIE_TEXT
<h1>$LANG_WHY_GERTIE</h1>
$LANG_WHY_GERTIE_TEXT
<h1>$LANG_TECHNICAL_DETAILS</h1>
$LANG_TECHNICAL_DETAILS_TEXT

<h5>
Language:$LANGUAGE -
Database used:$DATABASE -
Server time: $TIME
</h5>
</div>");

?>

<?php 
require("footer.php");
?>



</body>
</html>