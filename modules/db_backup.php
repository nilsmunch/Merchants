<?

function db_saveUserCheck($force=false) {
	global $g;
	$time = date('U');
	if (!$g || !$_SESSION['userdata']) {return;}
	if ($_SESSION['lastsave'] >= $time - 10 && !$force) {return;}
	$userdata = $_SESSION['userdata'];
	$fb = $userdata['fb_id'];
	db_connect();
	
	foreach ((array)$g['taskbank'] as $key => $ob ) {
		unset($g['taskbank'][$key]['story']);
	}
	
	mysql_query('UPDATE merch_players SET player_data = \''.json_encode($g).'\',lastsave = NOW() WHERE fb_id = "'.(int)$fb.'"') or die(mysql_error());
	$_SESSION['lastsave'] = $time;
	unset($_SESSION['market']);
	return 'Autosave complete';
}

?>