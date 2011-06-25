<?php
require("header.php");
?>

<h1>Hello <?php echo $member['login'];?>!</h1>
<em><a href="edit_profile.php">Edit profile</a></em>
<br />
<br />
<table>
<tr>
<td>
<img src="<?php echo $member['avatar'];?>" />
</td>
<td>
<b>Email address: </b><?php echo $member['mail'];?><br />
<b>Location: </b><?php echo $member['location'];?>
</td>
</tr>
</table>

<a href="view_profile.php?id=<?php echo loggedInUserID();?>" class="link">Go to my public page</a>

<?php
require("footer.php");
?>