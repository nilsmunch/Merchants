<?php
require('src/facebook.php');


$facebook = new Facebook(array(
  'appId'  => '581807798535415',
  'secret' => 'c6e4cde2fc5a884fa70c4112fedc5825',
));

$user = $facebook->getUser();
if ($_SERVER['SERVER_NAME'] == 'merch.con') {
	$user = 524375268;
}


if ($action == 'logout') {
	$facebook->destroySession();
   	unset($user);
	unset($_SESSION['userdata']);
	unset($_SESSION['game_variables']);
	header('location:/');die();
}

if (!$user) {
	if ($action) {header('location:/');die('Wrong');}
	$loginUrl = $facebook->getLoginUrl();
	include('pages/public/front.php');
	die();
}


if ($user) {
	if (!$_SESSION['userdata']) {
		db_connect();
		$userdata = mysql_fetch_assoc(mysql_query('SELECT * FROM merch_players WHERE fb_id = "'.(int)$user.'"'));
		if (!$userdata) {
			mysql_query('INSERT INTO merch_players (fb_id) VALUES ("'.(int)$user.'")');
			$userdata = mysql_fetch_assoc(mysql_query('SELECT * FROM merch_players WHERE fb_id = "'.(int)$user.'"'));
		}
		$_SESSION['game_variables'] = json_decode($userdata['player_data'],true);
		$_SESSION['userdata'] = $userdata;
		$_SESSION['userid'] = $user;
		$fb = $facebook->api('/me');
		$_SESSION['userdata']['fb'] = $fb;
		mysql_query('UPDATE merch_players SET playername = "'.$fb['name'].'" WHERE fb_id = "'.$user.'"') or die('name entry error');
		mysql_query('UPDATE merch_players SET sessionid = "'.session_id().'" WHERE fb_id = "'.$user.'"') or die('name entry error');
	}
  	$logoutUrl = '/logout';
}

?>
