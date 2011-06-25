<?php

function loggedInUser(){
	
	$login=$_SESSION['user'];
	
	$db= new database();	
	$member=$db->run_query("SELECT * FROM user WHERE login='$login';");
	$member=$db->fetch_obj($member);

	$result['login']=$member->login;
	$result['mail']=$member->mail;
	$result['location']=$member->location;
	$result['avatar']=$member->avatar;

	$db=null;
	return $result;
}

function memberFromId($id){
	
	$db= new database();	
	$member=$db->run_query("SELECT * FROM user WHERE id='$id';");
	$member=$db->fetch_obj($member);

	$result['login']=$member->login;
	$result['mail']=$member->mail;
	$result['location']=$member->location;
	$result['avatar']=$member->avatar;
	$result['id']=$member->id;

	$db=null;
	return $result;
}


function loggedInUserID(){
	
	$login=$_SESSION['user'];
	
	$db= new database();	
	$member=$db->run_query("SELECT id FROM user WHERE login='$login';");
	$member=$db->fetch_obj($member);

	$id=$member->id;

	return $id;
}

function eventExists($id){
	$db= new database();	
	$event=$db->run_query("SELECT * FROM events WHERE id='$id';");
	if ($db->count_objects($event)>0){
		return true;
	}

	return false;

}

function eventFromId($id){

	$db= new database();	
	$event=$db->run_query("SELECT * FROM events WHERE id=$id;");
	
	$event=$db->fetch_obj($event);

	$result['name']=$event->name;
	$result['description']=$event->description;
	$result['location']=$event->location;
	$result['start_date']=$event->start_date;
	$result['id']=$event->id;

	$db=null;
	return $result;

}

function loginFromId($id){
	$db= new database();	
	$login=$db->run_query("SELECT login FROM user WHERE id='$id';");
	$login=$db->fetch_obj($login);

	$login=$login->login;
	
	return $login;
}

function avatarFromId($id){
	$db= new database();	
	$avatar=$db->run_query("SELECT avatar FROM user WHERE id='$id';");
	$avatar=$db->fetch_obj($avatar);

	$avatar=$avatar->avatar;

	return $avatar;
}

function eventAttendees($id){
	$result=array();
	$db= new database();
	$qresult=$db->run_query("SELECT distinct * FROM attend WHERE id_event='$id';");
	
	if ($db->count_objects($qresult)!=0){

		while($temp_result=$db->fetch_obj($qresult)){
			$temp['login']=loginFromId($temp_result->id_user);
			$temp['id']=$temp_result->id_user;
			array_push($result,$temp);
		}
	}
	


	return $result;
	

}

function fetch_comments($id){
	$result=array();

	$db= new database();	
	$event=$db->run_query("SELECT * FROM comments WHERE id_event='$id' ORDER BY date DESC;");
	
	if ($db->count_objects($event)!=0){
	
	while($temp_event=$db->fetch_obj($event)){
			$temp['user_id']=$temp_event->id_author;
			$temp['user_avatar']=avatarFromId($temp_event->id_author);
			$temp['user_login']=loginFromId($temp_event->id_author);
			$temp['content']=$temp_event->content;
	
			array_push($result,$temp);
		}

	}
	

	if (empty($result))
		echo "<i>No comments</i>";
	
	return $result;
}

function fetch_user_comments($id){
	$result=array();

	$db= new database();	
	$user=$db->run_query("SELECT * FROM comments_users WHERE id_user='$id' ORDER BY date DESC;");
	
	if ($db->count_objects($user)!=0){
	
	while($temp_user=$db->fetch_obj($user)){
			$temp['user_id']=$temp_user->id_author;
			$temp['user_avatar']=avatarFromId($temp_user->id_author);
			$temp['user_login']=loginFromId($temp_user->id_author);
			$temp['content']=$temp_user->content;
	
			array_push($result,$temp);
		}

	}
	

	if (empty($result))
		echo "<i>No comments</i>";
	
	return $result;
}




function insert_comment($id_event,$id_poster,$comment){
	$db= new database();	
	$db->run_query("INSERT INTO comments (id_event,id_author,content,date) VALUES ('$id_event','$id_poster','$comment',unix_timestamp());");

}

function insert_user_comment($id_user,$id_poster,$comment){
	$db= new database();	
	$db->run_query("INSERT INTO comments_users (id_user,id_author,content,date) VALUES ('$id_user','$id_poster','$comment',unix_timestamp());");

}


function create_user($name,$pass,$mail){
	$pass=md5($pass);
	$db= new database();	
	$db->run_query("INSERT INTO user (id,login,pass,mail) VALUES (null,'$name','$pass','$mail');");
	
	$to = $mail;
	$subject = 'Your registration at Eventify Me!';
	$msg = 'Hello '.$name.'! You have registered on Eventify Me! Starting from right now, you can log in to the site and contribute with the username and password you supplied. Thanks for your participation, we hope to see you soon!';

	$headers = 'From: Eventify me! <noreply@eventifyme.com>'."\r\n";
	$headers .= "\r\n";
	mail($to, $subject, $msg, $headers);

	
	
}

function create_event($name,$location,$date,$description,$tags){
	$db= new database();
	$db->run_query("
	INSERT INTO events (id, name, description, location, start_date)
	VALUES (NULL, '$name', '$description', '$location', '$date');");
	
	
	$id=$db->run_query("SELECT id FROM events WHERE name='$name'	
	;");
	
	$id=$db->fetch_obj($id);
	$id=$id->id;
	
	return $id;
}

function login_user($login,$pass){
	$db= new database();
	$pass=md5($pass);
	$refPass=$db->run_query("SELECT pass FROM user WHERE login='$login';");
	$refPass=$db->fetch_obj($refPass);
	$refPass=$refPass->pass;
	
	if ($pass==$refPass){
		return true;
	}
	
	return false;
}

function update_user_avatar($avatar){
	$id=loggedInUserID();
	
	$db= new database();
	$db->run_query("UPDATE user SET avatar='$avatar' WHERE id='$id';");
}

function update_user_mail($mail){
	$id=loggedInUserID();
	
	$db= new database();
	$db->run_query("UPDATE user SET mail='$mail' WHERE id='$id';");
}

function update_user_location($location){
	$id=loggedInUserID();
	
	$db= new database();
	$db->run_query("UPDATE user SET location='$location' WHERE id='$id';");
}

function attends($user,$event){
	$db= new database();
	$result=$db->run_query("SELECT * FROM attend WHERE id_user='$user' and id_event='$event';");

	if ($db->count_objects($result)!=0){
		return true;
	}
	return false;
}

function attend_event($user,$event){
	$db= new database();
	$result=$db->run_query("INSERT INTO attend (id_user,id_event) VALUES ('$user','$event');");

}

function cancel_attend($user,$event){
	$db= new database();
	$result=$db->run_query("DELETE FROM attend WHERE id_user='$user' and id_event='$event';");

}

function memberEvents($id){
	$array=array();
	$db= new database();
	$result=$db->run_query("SELECT distinct id_event FROM attend WHERE id_user='$id';");

	if ($db->count_objects($result)!=0){
	
		while($temp_event=$db->fetch_obj($result)){
			array_push($array,eventFromId($temp_event->id_event));
		}
	}
	
	if (empty($array))
		echo "<i>No events.</i>";
	return $array;
}

function getEventSearch($keywords){
	$array=array();
	$db= new database();
	$result=$db->run_query("SELECT id FROM events WHERE description LIKE '%".$keywords."%' OR  location LIKE '%".$keywords."%' OR  name LIKE '%".$keywords."%' OR  start_date LIKE '%".$keywords."%' ;"); //OR  tags LIKE '%".$keywords."%'

	if ($db->count_objects($result)!=0){
	
		while($temp_event=$db->fetch_obj($result)){
			array_push($array,eventFromId($temp_event->id));
		}
	}
	if (empty($array))
		echo "<i>No events.</i>";
	return $array;
}

function getMemberSearch($keywords){
	$array=array();
	$db= new database();
	$result=$db->run_query("SELECT id FROM user WHERE login LIKE '%".$keywords."%' OR  location LIKE '%".$keywords."%';");

	if ($db->count_objects($result)!=0){
	
		while($temp_event=$db->fetch_obj($result)){
			array_push($array,memberFromId($temp_event->id));
		}
	}
	if (empty($array))
		echo "<i>No users.</i>";
	return $array;
}

function upcoming5events(){
	$db= new database();
	$result=$db->run_query("SELECT * FROM events ORDER BY start_date ASC LIMIT 5;");

	while($temp_event=$db->fetch_obj($result)){
		echo "<span class='blue'>On the ".$temp_event->start_date.": </span>";
		echo "<a href='event_details.php?id=".$temp_event->id."' class='green'>".$temp_event->name."</a><br />";
	}
		
}

function isFriend($user1,$user2){
	$db= new database();
	$result=$db->run_query("SELECT * FROM friends WHERE id1='$user1' and id2='$user2';");

	if ($db->count_objects($result)!=0){
		return true;
	}
	return false;
}

function makeFriends($user1,$user2){
	$db= new database();
	$result=$db->run_query("INSERT INTO friends (id1,id2) VALUES ('$user1','$user2');");

}

function getFriends($id){
	$array=array();
	$db= new database();
	$result=$db->run_query("SELECT distinct id2 FROM friends WHERE id1=$id;");

	if ($db->count_objects($result)!=0){
	
		while($temp_event=$db->fetch_obj($result)){
			array_push($array,memberFromId($temp_event->id2));
		}
	}
	if (empty($array))
		echo "<i>No friends :( .</i>";
	return $array;
}

?>