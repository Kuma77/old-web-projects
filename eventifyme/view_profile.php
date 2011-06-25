<?php
require("header.php");
?>

<?php
$id=$_GET['id'];

if (isset($_GET['action'])){
	if ($_GET['action']=='addfriend'){
		makeFriends(loggedInUserID(),$id);
	
	}
}

$member=memberFromId($id);
?>

<h1>Profile for <?php echo $member['login'];?></h1>
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
<br />
<br />
<?php echo pullRating($id+1000,true,false,true,NULL); ?>

<br />
<br />

<h2><?php echo $member['login'];?>'s friends:</h2>
<?php
$members=getFriends($id);

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

<br />
<br />
<br />

<?php
$member=memberFromId($id);

if (loggedInUserID()!=$id){
if (!isFriend(loggedInUserID(),$id)){
	echo "<a href='?id=$id&action=addfriend' class='link'>Add ".$member['login']." as a friend</a>";
} else {
	echo $member['login']." is your friend !";
}	
}
?>

<h2>Events that <?php echo $member['login'];?> plans to attend:</h2>


<?php $events=memberEvents($_GET['id']);

if (!empty($events)){
?>
<table id="events">
<thead>
<th>Name</th>
<th>Description</th>
<th>Location</th>
<th>Date</th>
</thead>
<?php
foreach ($events as $event){
?>
<tr>
<td><a href="event_details.php?id=<?php echo $event['id'];?>" class="link"><?php echo $event['name']; ?></a></td>
<td><?php echo $event['description']; ?></td>
<td><?php echo $event['location']; ?></td>
<td><?php echo $event['start_date']; ?></td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
<br />
<h2>Comments:</h2>
<table>


<?php
if (isset($_POST['comment'])){
	insert_user_comment($id,loggedInUserID(),$_POST['comment']);
}
?>

<?php 

$comments=fetch_user_comments($id);


foreach ($comments as $comment){ ?>
<tr><td style="text-align:center"><img src="<?php echo $comment['user_avatar'];?>"/><br/><a href="view_profile.php?id=<?php echo $comment['user_id']?>" class="link"><b><?php echo $comment['user_login'];?></b></a></td><td><?php echo $comment['content'];?></td></tr>
<?php } ?>

</table>
<br />
<?php if (!empty($_SESSION['user'])){ //if user connected
?>
<form action="view_profile.php?id=<?php echo $id; ?>" method="post">
<textarea name="comment" rows=10 cols=40></textarea><br />
<input type="submit" value="Submit" />
</form>
<?php }?>


<?php
require("footer.php");
?>