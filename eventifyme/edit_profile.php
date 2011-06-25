<?php
require("header.php");
?>

<?php
$updated=0;

if (isset($_POST['mail'])){
	update_user_mail($_POST['mail']);
	$updated=1;
}

if (isset($_POST['location'])){
	update_user_location($_POST['location']);
	$updated=1;
}

if (isset($_POST['avatar'])){
	update_user_avatar($_POST['avatar']);
	$updated=1;
}
?>

<h1>Edit your profile</h1>
<?php
if ($updated){
	echo "<em>Your profile has been updated successfully</em>";
}
?>
<form action="edit_profile.php" method="post">

<?php 
$details=loggedInUser();
?>
<table>
<tr><td>Mail: </td><td><input type="input" name="mail" value="<?php echo $details['mail']; ?>"/></td></tr>
<tr><td>Location: </td><td><input type="input" name="location" value="<?php echo $details['location']; ?>"/></td></tr>
<tr><td>Avatar: </td><td><input type="input" name="avatar" value="<?php echo $details['avatar']; ?>"/></td></tr>
</table>
<span>To add an avatar, enter an URL to a picture. You can use an external service to <a href="http://photo.noxneo.net">upload your own pictures.</a></span>
<br />
<input type="submit" value="Submit!" />
</form>


<?php
require("footer.php");
?>