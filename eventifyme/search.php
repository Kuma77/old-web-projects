<?php
require("header.php");
?>
<h1>
<?php
echo "Searching ";
echo $_GET['type'];
echo "s containing: ";
echo $_GET['name'];
?>
</h1>
<br />

<?php
if ($_GET['type']=="event"){
	$events=getEventSearch($_GET['name']);
	
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
} else {
	$members=getMemberSearch($_GET['name']);

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
}
?>


<?php
require("footer.php");
?>