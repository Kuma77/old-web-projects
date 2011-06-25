<?php
require("header.php");

if (isset($_GET['action'])){
	if ($_GET['action']=='attend'){
		attend_event(loggedInUserID(),$_GET['id']);
	
	} else if ($_GET['action']=="cancel"){
		cancel_attend(loggedInUserID(),$_GET['id']);
	
	}
}

$id=$_GET['id'];
if (isset($_POST['name'])){ 
	$name=$_POST['name'];
	$location=$_POST['location'];
	$date=$_POST['date'];
	$description=$_POST['content'];
	$tags=$_POST['tags'];
	
	//insert event in db
	$id=create_event($name,$location,$date,$description,$tags);
}

if (eventExists($id)){
	$event=eventFromId($id);
?>


<h1>Event details for <?php echo $event['name'];?></h1>

<table>
<tr>
<td>
<!--<img src="" /> -->
</td>
<td>
<b>Description: </b><?php echo $event['description'];?><br />
<b>Location: </b><?php echo $event['location'];?><br />
<b>Date: </b><?php echo $event['start_date'];?><br />
<b>Tags: </b><?php echo $event['type'];?><br />
</td>
</tr>
</table>
<br />
<?php echo pullRating($id,true,false,true,NULL); ?>
<br />
<br />
<b>Attending:</b><?php 

$attendees=eventAttendees($_GET['id']);

foreach ($attendees as $attendee){
	echo "<a href=\"view_profile.php?id=".$attendee['id']."\" class=\"link\">".$attendee['login'];
	echo "</a> ";

}
?>
<br />


<?php

if (!attends(loggedInUserID(),$_GET['id'])){
?>
<a href="event_details.php?id=<?php echo $id ?>&action=attend" class="link">Attend this event</a> 
<?php } else {?>
<a href="event_details.php?id=<?php echo $id ?>&action=cancel" class="link">Cancel your participation in this event</a>
<?php } ?>

<br />
<h2>Comments:</h2>
<table>


<?php
if (isset($_POST['comment'])){
	insert_comment($_GET['id'],loggedInUserID(),$_POST['comment']);
}
?>

<?php 

$comments=fetch_comments($id);


foreach ($comments as $comment){ ?>
<tr><td style="text-align:center"><img src="<?php echo $comment['user_avatar'];?>"/><br/><b><a href="view_profile.php?id=<?php echo $comment['user_id'];?>" class="link"><?php echo $comment['user_login'];?></a></b></td><td><?php echo $comment['content'];?></td></tr>
<?php } ?>

</table>
<br />
<?php if (!empty($_SESSION['user'])){ //if user connected
?>
<form action="event_details.php?id=<?php echo $id; ?>" method="post">
<textarea name="comment" rows=10 cols=40></textarea><br />
<input type="submit" value="Submit" />
</form>
<?php }?>

<?php
} else {
?>
Error: the event doesn't exist.


<?php
}
require("footer.php");
?>