<?php
require("header.php");
?>

<h1>Here are the events you plan to attend to...</h1>
<em><a href="new_event.php">Create a new event</a></em>
<br />
<br />
<?php $events=memberEvents(loggedInUserID());

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


<?php
require("footer.php");
?>