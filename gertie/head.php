<?php
session_start();

require("utils.php");



echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">";

echo "<html xmlns=\"http://www.w3.org/1999/xhtml\"  xml:lang=\"$LANGUAGE\">";

echo "<head>
<title>$LANG_PAGE_TITLE</title>
<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />
<meta name=\"author\" content=\"Guillaume Ardaud\" />";

echo "<meta name=\"description\" content=\"Gertie, site de cinémas sur Grenoble\" />
<meta name=\"keywords\" content=\"cinéma, film, grenoble, acteur, metteur en scène\" />
<meta name=\"language\" content=\"$LANGUAGE\" />";

if(isset($_SESSION['style'])){
echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"styles/",$_SESSION['style'],"\"/>";
} else {
echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"styles/olivegreen.css\" />";
}
echo "</head>";

?>
