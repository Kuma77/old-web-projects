<?php
//require("rating_config.php");
/*
Dynamic Star Rating Redux
Developed by Jordan Boesch
www.boedesign.com
Licensed under Creative Commons - http://creativecommons.org/licenses/by-nc-nd/2.5/ca/

Used CSS from komodomedia.com.
*/

function getRating($id){
	$db=new database();

	$total = 0;
	$rows = 0;
	
	$sel = $db->run_query("SELECT rating_num FROM ratings WHERE rating_id = '$id'");
	if($db->count_objects($sel) > 0){
	
		while($data = mysql_fetch_assoc($sel)){
		
			$total = $total + $data['rating_num'];
			$rows++;
		}
		
		$perc = ($total/$rows) * 20;
		
		//$newPerc = round($perc/5)*5;
		//return $newPerc.'%';
		
		$newPerc = round($perc,2);
		return $newPerc.'%';
	
	} else {
	
		return '0%';
	
	}
}

function outOfFive($id){
	$db=new database();

	$total = 0;
	$rows = 0;
	
	$sel = $db->run_query("SELECT rating_num FROM ratings WHERE rating_id = '$id'");
	if($db->count_objects($sel) > 0){
	
		while($data = mysql_fetch_assoc($sel)){
		
			$total = $total + $data['rating_num'];
			$rows++;
		}
		
		$perc = ($total/$rows);
		
		return round($perc,2);
		//return round(($perc*2), 0)/2; // 3.5
	
	} else {
	
		return '0';
	
	}
	
	
}

function getVotes($id){
	$db=new database();

	$sel = $db->run_query("SELECT rating_num FROM ratings WHERE rating_id = '$id'");
	$rows = $db->count_objects($sel);
	if($rows == 0){
		$votes = '0 Votes';
	}
	else if($rows == 1){
		$votes = '1 Vote';
	} else {
		$votes = $rows.' Votes';
	}
	return $votes;
	
}
function pullRating($id,$show5 = false, $showPerc = false, $showVotes = false, $static = NULL){
	$db=new database();
	// Check if they have already voted...
	$text = '';
	
	$sel = $db->run_query("SELECT id FROM ratings WHERE IP = '".$_SERVER['REMOTE_ADDR']."' AND rating_id = '$id'");
	if($static == 'novote' || isset($_COOKIE['has_voted_'.$id])){ //$db->count_objects($sel) > 0 || 
	
		
		
		if($show5 || $showPerc || $showVotes){

			$text .= '<div class="rated_text">';
			
		}
			
			if($show5){
				$text .= 'Rated <span id="outOfFive_'.$id.'" class="out5Class">'.outOfFive($id).'</span>/5';
			} 
			if($showPerc){
				$text .= ' (<span id="percentage_'.$id.'" class="percentClass">'.getRating($id).'</span>)';
			}
			if($showVotes){
				$text .= ' (<span id="showvotes_'.$id.'" class="votesClass">'.getVotes($id).'</span>)';
			}
			
		if($show5 || $showPerc || $showVotes){	
			
			$text .= '</div>';
		
		}
		
		
		return $text.'
			<ul class="star-rating2" id="rater_'.$id.'">
				<li class="current-rating" style="width:'.getRating($id).';" id="ul_'.$id.'"></li>
				<li><a onclick="return false;" href="#" title="1 star out of 5" class="one-star" >1</a></li>
				<li><a onclick="return false;" href="#" title="2 stars out of 5" class="two-stars">2</a></li>
				<li><a onclick="return false;" href="#" title="3 stars out of 5" class="three-stars">3</a></li>
				<li><a onclick="return false;" href="#" title="4 stars out of 5" class="four-stars">4</a></li>
				<li><a onclick="return false;" href="#" title="5 stars out of 5" class="five-stars">5</a></li>
			</ul>
			<div id="loading_'.$id.'"></div>';

		
	} else {
		
		if($show5 || $showPerc || $showVotes){
			
			$text .= '<div class="rated_text">';
			
		}
			if($show5){
				$show5bool = 'true';
				$text .= 'Rated <span id="outOfFive_'.$id.'" class="out5Class">'.outOfFive($id).'</span>/5';
			} else {
				$show5bool = 'false';
			}
			if($showPerc){
				$showPercbool = 'true';
				$text .= ' (<span id="percentage_'.$id.'" class="percentClass">'.getRating($id).'</span>)';
			} else {
				$showPercbool = 'false';
			}
			if($showVotes){
				$showVotesbool = 'true';
				$text .= ' (<span id="showvotes_'.$id.'" class="votesClass">'.getVotes($id).'</span>)';
			} else {
				$showVotesbool = 'false';	
			}
			
		if($show5 || $showPerc || $showVotes){	
		
			$text .= '</div>';
			
		}
		
		return $text.'
			<ul class="star-rating" id="rater_'.$id.'">
				<li class="current-rating" style="width:'.getRating($id).';" id="ul_'.$id.'"></li>
				<li><a href="star_rating/includes/rating_process.php?id='.$id.'&rating=1" title="1 star out of 5" class="one-star" >1</a></li>
				<li><a href="star_rating/includes/rating_process.php?id='.$id.'&rating=2" title="2 stars out of 5" class="two-stars">2</a></li>
				<li><a href="star_rating/includes/rating_process.php?id='.$id.'&rating=3" title="3 stars out of 5" class="three-stars">3</a></li>
				<li><a href="star_rating/includes/rating_process.php?id='.$id.'&rating=4" title="4 stars out of 5" class="four-stars">4</a></li>
				<li><a href="star_rating/includes/rating_process.php?id='.$id.'&rating=5" title="5 stars out of 5" class="five-stars">5</a></li>
			</ul>
			<div id="loading_'.$id.'"></div>';
	
	}
}

// Added in version 1.5
// Fixed sort in version 1.7
function getTopRated($limit, $table, $idfield, $namefield){
	$db=new database();

	if ($table=='events'){
		$page="event_details.php";
	$sql = "SELECT COUNT(ratings.id) as rates,ratings.rating_id,".$table.".".$namefield." as thenamefield,ROUND(AVG(ratings.rating_num),2) as rating 
			FROM ratings,".$table." WHERE ".$table.".".$idfield." = ratings.rating_id AND ratings.rating_id < 1000 GROUP BY rating_id 
			ORDER BY rating DESC,rates DESC LIMIT ".$limit."";
	} else {
		$page="view_profile.php";
	$sql="SELECT COUNT( ratings.id ) AS rates, ratings.rating_id, user.id AS thenamefield, ROUND( AVG( ratings.rating_num ) , 2 ) AS rating
FROM ratings, user
WHERE ratings.rating_id >1000
GROUP BY rating_id
ORDER BY rating DESC , rates DESC
LIMIT 5";
	}
	
	
	$result = '';
	
	$sel = $db->run_query($sql);
	
	$result .= '<ul class="topRatedList">'."\n";
	
	while($data = @mysql_fetch_assoc($sel)){
	if ($table=='events'){
		$result .= '<li><a href="'.$page.'?id='.$data['rating_id'].'" class="green">'.$data['thenamefield'].'</a><span class="blue"> (rated '.$data['rating'].' out of 5)</span></li>'."\n";
	} else {
		$num=$data['rating_id']-1000;
		
		
		$username= $db->run_query("SELECT login FROM user WHERE id='$num'");
		$username= $db->fetch_obj($username);
		$username=$username->login;
		
		$result .= '<li><a href="'.$page.'?id='.$num.'" class="green">'.$username.'</a><span class="blue"> (rated '.$data['rating'].' out of 5)</span></li>'."\n";
	
	}
	
	
	}
	
	$result .= '</ul>'."\n";
	
	return $result;
	
}
?>