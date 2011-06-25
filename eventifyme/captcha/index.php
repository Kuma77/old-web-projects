<?php
require("captcha.php");
session_start();
?>
<html>
<head>
<title>Captcha tests</title>
</head>

<body>
<?php
	$_SESSION['captcha'] = new Captcha(3,200,150);
?>


<img src="image.php" />
<br />

<input type="text" id="form" onKeyUp="checkInput();"/>

<select id="complexity" onChange="changeComplexity();">
<option value="1">1</option>
<option value="2">2</option>
</select>

<img id="wrong" src="wrong.png" style="display: none"/>
<img id="good" src="good.png" style="display: none"/>

<?php
	require("captchaChecker.js");
?>
</body>
</html>