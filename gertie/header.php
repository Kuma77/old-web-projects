<div id="header">

<div id="banner">
<p id="title"><?php echo "$LANG_BANNER_TITLE";?></p>
</div>


<div id="menu">

<div id="search">
<form method="get" action="search.php">
<fieldset>
<label for="search_field"><?php echo $LANG_SEARCH_LABEL; ?></label>
<input type="text" name="search" id="search_field" size="15"></input>
<input type="submit" value="<?php echo $LANG_SEARCH_BUTTON; ?>"></input>
</fieldset>
</form>
</div>

<div id="links">
<div class="tab"><a href="index.php"><?php echo $LANG_HOME; ?></a></div>
<div class="tab"><a href="movies.php"><?php echo $LANG_MOVIES; ?></a></div>
<div class="tab"><a href="theaters.php"><?php echo $LANG_THEATERS; ?></a></div>
<div class="tab"><a href="actors.php"><?php echo $LANG_ACTORS; ?></a></div>
<div class="tab"><a href="producers.php"><?php echo $LANG_PRODUCERS; ?></a></div>
</div>

</div>
</div>