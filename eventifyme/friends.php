<?php
require("header.php");
?>

<h1>Here are your friends:</h1>

<?php
	$members=getFriends(loggedInUserID());

		if (!empty($members)){
?>
<table id="events">
<thead>
<th>Avatar</th>
<th>Name</th>
<th>Location</th>
</thead>
<?php
foreach ($members as $member){
?>
<tr>
<td><img src="<?php echo $member['avatar']; ?>" /></td>
<td><a href="view_profile.php?id=<?php echo $member['id'];?>" class="link"><?php echo $member['login']; ?></a></td>
<td><?php echo $member['location']; ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
?>

<?php
require("footer.php");
?>