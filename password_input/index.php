<html>
<head>
<title>Password input</title>
</head>
<body>
<p>The goal of this page is to provide the user feedback on the entered password, while still maintaining a decent amount of security in regards to the input (ie. people looking over your shoulder).</p>
<br />

<?php require('password_input.js'); ?>

<form action='index.php' method='post' id='form' />
<input type='text' name='pass' id='pass_field' onKeyPress='key_press();' />
<input type='button' value='Submit' onClick='form_submit();' />
</form>

<br />
<?php
if (isset($_POST['pass'])){
	echo "The password you entered is: <b>". $_POST['pass']."</b>";
}

?>


</body>
</html>