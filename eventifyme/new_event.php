<?php
require("header.php");
?>
<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker();
	});
</script>
	
<h1>Create an event</h1>
<em>To create an event, just fill out the form below...</em>
<br />
<br />
<br />

<form method="post" action="event_details.php">
<table>
<tr><td>Name: </td><td><input type="text" name="name" /></td></tr>
<tr><td>Location: </td><td><input type="text" name="location" /></td></tr>
<tr><td>Tags: </td><td><input type="text" name="tags" /></td></tr>
<tr><td>Date: </td><td><input type="text" name="date" id="datepicker"/></td></tr>
</table>
<br />
Description: <br/>
<textarea name="content"></textarea>
<br />
<br />
<br />


<input type="submit" />
</form>

<?php
require("footer.php");
?>