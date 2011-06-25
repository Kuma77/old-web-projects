<?php
require("header.php");
?>

<?php

if (isset($_POST['name'])){
	//insert user in DB
	create_user($_POST['name'],$_POST['pass'],$_POST['mail']);
	//connect him
	$_SESSION['user']=$_POST['name'];
}

?>


<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>

<div>
<b>Eventify Me!</b> is a website focused on hosting a <b>vibrant geographical community</b>, 
through providing a platform for members to <b>discuss, rate, share, and promote events</b> they 
are attending or events being attended by others.
<br/>
<br/>
<br/>
</div>

<?php
if (1){ //if user connected
?>
<div id="tabs">
	<ul>
		<li><a href="#upcoming">Upcoming events...</a></li>
		<li><a href="#top5events">Top 5 events</a></li>
		<li><a href="#top5users">Top 5 users</a></li>
	</ul>
	<div id="upcoming">
		Here's what will be happening in the following days...<br /><br />
		<?php upcoming5events(); ?>
	</div>
	<div id="top5events">
		Here are the five highest rated events by our community.<br /><br />
		<?php echo getTopRated(5, events, id, name); ?>
	</div>
	<div id="top5users">
		Here are the five highest rated users by our community.<br /><br />
		<?php echo getTopRated(5, user, id, login); ?>
	</div>
</div>
<?php
}
?>

<?php
require("footer.php");
?>