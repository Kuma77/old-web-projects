<?php 
require("head.php");
?>

<body>

<?php 
require("header.php");
?>

<div id="content">
<?php
require("functions.php");

echo $LANG_WELCOME;

display_random_home();

?>
</div>

<?php 
require("footer.php");
?>



</body>
</html>