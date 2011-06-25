<?php
require("header.php");
?>

<h1>Create an account</h1>

<form action="index.php" method="post">

<table>
<tr><td>Username: </td><td><input type="input" name="name" /></td></tr>
<tr><td>Email: </td><td><input type="input" name="mail"/></td></tr>
<tr><td>Password: </td><td><input type="password" name="pass" /></td></tr>
<tr><td>Password (verification): </td><td><input type="password" name="pass2" /></td></tr>
</table>
<br />
<br />
<?php
require("captcha/captcha.php");
$_SESSION['captcha'] = new Captcha(3,200,50);
?>
<img src="captcha/image.php" /><br />
Please enter the characters as you see them above (reload if they are illegible): <input type="text" id="form" onKeyUp="checkInput();"/>
<img id="wrong" src="captcha/wrong.png" style="display: none"/>
<img id="good" src="captcha/good.png" style="display: none"/>

<?php
require("captcha/captchaChecker.js");
?>
<br />
<br />
<div id="submit" style="display:none";>
<input type="submit" value="Submit!"/>
</div>
</form>

<?php
require("footer.php");
?>