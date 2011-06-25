<?php
function preview_from_rl($resource_locator){

global $LANG_CLICK_MORE;

if (is_file($resource_locator)){
  $lines = file($resource_locator);

  $descriptive=$descriptive.htmlspecialchars($lines[0])."[...]";

} else {
  $descriptive="$LANG_CLICK_MORE";
}


return $descriptive."<br />";

}
//------------------------------------------------------------------
function display_random_home(){

global $LANGUAGE;
global $LIGHTS_ON;

connect_db();

echo "<div class=\"search_result\">";

$category=rand(0,2);

if ($category==0){ //we pick a random actor
$query="SELECT count(*) as nb FROM acteur";
$line=run_query($query);
$nb=fetch_obj($line)->nb;

$nb=rand(0,$nb);
$result="<h3>$LIGHTS_ON</h3><table><tr>";

$query="SELECT nomact FROM acteur";
$line=run_query($query);
for($i=0;$i<$nb-1;$i++){
fetch_obj($line)->nomact;
}

$url_actor=rawurlencode(fetch_obj($line)->nomact);
$actor=htmlentities(rawurldecode($url_actor));
$resource_locator=str_replace(" ", "", 'biography/'.$LANGUAGE.'/'.$actor);

$descriptive=preview_from_rl($resource_locator);

$result=$result."<td><img src=\"actors_pictures/thumbs/".$actor."_thumb.jpg\" alt=\"\" /></td>";
$result=$result."<td><a href=\"actordetails.php?actor=".accent_encode($url_actor)."\">".$actor."</a><br /><br /><i>".$descriptive."</i></td>";
$result=$result."</tr></table>";




} else if ($category==1){ //we pick a random movie


$query="SELECT count(*) as nb FROM film";
$nb=fetch_obj(run_query($query))->nb;

$nb=rand(0,$nb);
$result="<h3>Lumière sur un film...</h3><table><tr>";

$query="SELECT titre FROM film";
$line=run_query($query);
for($i=0;$i<$nb-1;$i++){
fetch_obj($line)->nomact;
}

$url_movie=rawurlencode(fetch_obj($line)->titre);
$movie=htmlentities(rawurldecode($url_movie));
$resource_locator=str_replace(" ", "", 'synopsis/'.$LANGUAGE.'/'.$movie);

$descriptive=preview_from_rl($resource_locator);

$result=$result."<td><img src=\"posters/thumbs/".$movie."_thumb.jpg\" alt=\"\" /></td>";
$result=$result."<td><a href=\"moviedetails.php?movie=".accent_encode($url_movie)."\">".$movie."</a><br /><br /><i>".$descriptive."</i></td>";
$result=$result."</tr></table>";





} else { //we pick a random producer
$query="SELECT count(*) as nb FROM film";
$nb=fetch_obj(run_query($query))->nb;

$nb=rand(0,$nb);
$result="<h3>Lumière sur un metteur en scène...</h3><table><tr>";

$query="SELECT metteurscene FROM film";
$line=run_query($query);
for($i=0;$i<$nb-1;$i++){
fetch_obj($line)->metteurscene;
}

$url_producer=rawurlencode(fetch_obj($line)->metteurscene);
$producer=htmlentities(rawurldecode($url_producer));
$resource_locator=str_replace(" ", "", 'biography/'.$LANGUAGE.'/'.$producer);

$descriptive=preview_from_rl($resource_locator);

$result=$result."<td><img src=\"producers_pictures/thumbs/".$producer."_thumb.jpg\" alt=\"\" /></td>";
$result=$result."<td><a href=\"moviedetails.php?movie=".accent_encode($url_producer)."\">".$producer."</a><br /><br /><i>".$descriptive."</i></td>";
$result=$result."</tr></table>";





}


echo $result;
echo "</div>";


disconnect_db();
}

?>
