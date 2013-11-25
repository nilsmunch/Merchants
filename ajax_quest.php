<?

function timeFormulate($seconds) {return gmdate("H:i:s", $seconds);}

$prizes[1] = 'book_floras';
$prizes[2] = 'boots_mirkweave';
$prizes[3] = 'favor_coin';

session_start();
include('../config.php');
db_connect();
include('databanks/items.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/db_backup.php');
	$user = (int)$_SESSION['userid'];

if (!$user) {die('Session error...');}
$awardcheck = mysql_fetch_assoc(mysql_query('SELECT * FROM merch_quest_rewards WHERE player = '.$user));

if ($awardcheck['item']) {
	$awardQ = mysql_query('SELECT * FROM merch_quest_rewards WHERE player = '.$user);

	$g = $_SESSION['game_variables'];
while ($award = mysql_fetch_assoc($awardQ)) {

echo '<div style="font-size:26px;clear:both;text-align:center">You have recieved the following reward :<br><br>
'.showItemBox($award['item'],1).'
</div>';

	addToInventory($award['item']);


mysql_query('DELETE FROM merch_quest_rewards WHERE player = '.$user.' AND item = "'.$award['item'].'" limit 1');
}
	$_SESSION['game_variables'] = $g;
db_saveUserCheck(true);
die(javaCheck());
}


$questbuffer = 60*60*1;
$questduration = 60*60*5;
function writeCache($key,$object) {
	$apiFile = 'databanks/gameworld_'.$key.'.php';
	$final =  '<? global $lib_'.$key.'; $lib_'.$key.' = '.var_export($object,true).'; ?>';
	$fh = fopen($apiFile, 'w');
	fwrite($fh, $final);
	fclose($fh);
}

$time = date('U');
	include('databanks/gameworld_quests.php');
	include('databanks/quests.php');

$questlist = $lib_quests;
$shuffle = false;
	$g = $_SESSION['game_variables'];


if ($_GET['action'] && $questlist[$_GET['action']]) {
	if (!$questlist[$_GET['action']]) {die('TOO LATE');}
	$quest = $questlist[$_GET['action']];
	$commodity = $quest['askingitem'];
	$qty = (int)$_GET['target'];
	
	$can = pricecheck($commodity,$qty,true);

	if ($can) {
		$notif = 'Transaction complete! Thank you for your donations.';
		
	$entry = mysql_fetch_assoc(mysql_query('SELECT * FROM merch_quest_input WHERE player = '.$user.' AND quest = "'.$_GET['action'].'"'));
	if ($entry) {
		$_SESSION['questcont_'.$_GET['action'].'_'.$quest['endtime']] = $entry['input'] + $qty;
		mysql_query('UPDATE merch_quest_input SET input = input + '.$qty.' WHERE player = '.$user.' AND quest = "'.$_GET['action'].'"');
	} else {
		mysql_query('INSERT INTO merch_quest_input (player,quest,input) values ('.$user.',"'.$_GET['action'].'",'.$qty.')');
		$_SESSION['questcont_'.$_GET['action'].'_'.$quest['endtime']] = $qty;
	}
	} else {
		$notif = 'You do not have the requested items!';
	}
	$_SESSION['game_variables'] = $g;
}

if ($notif) {
	echo '<div style="clear:both;text-align:center">'.$notif.'</div>';
	unset($notif);
}

//	echo 'Global quests';

if (count($questlist) == 0) {$shuffle = true;}

foreach ((array)$questlist as $qid => $quest) {
	if ($quest['rewards']) {$prizes = $quest['rewards'];}
	echo '<div style="font-size:26px;font-weight:bold">'.$quest['title'].'</div>';
	echo '<img src="/media/art/quest_green.png" style="float:right;width:100px;height:156px;">';

	$quest_open = ($quest['endtime']-$time)>=0;
	if ($quest_open) {

	$cont = (int)$_SESSION['questcont_'.$qid.'_'.$quest['endtime']];
echo '<div style="padding:20px;">'.nl2br($quest['flair']).'</div>';
	$itemdata = $itembank[$quest['askingitem']];
	echo 'You have contributed : '.$cont.' x '.$itemdata['name_plural'];
	echo ' <a href="#" class="questcont" onClick="openQuests(\''.$qid.'\',1);">+1</a>';
	if ($g['inventory'][$quest['askingitem']] > 4) {
	echo ' <a href="#" class="questcont" onClick="openQuests(\''.$qid.'\',10);">+10</a>';
	}
	if ($g['inventory'][$quest['askingitem']] > 100) {
	echo ' <a href="#" class="questcont" onClick="openQuests(\''.$qid.'\',100);">+100</a>';
	}
	if ($g['inventory'][$quest['askingitem']] > 250) {	echo ' <a href="#" class="questcont" onClick="openQuests(\''.$qid.'\',250);">+250</a>';	}
	if ($g['inventory'][$quest['askingitem']] > 1000) {	echo ' <a href="#" class="questcont" onClick="openQuests(\''.$qid.'\',1000);">+1.000</a>';	}
	echo showItemBox($quest['askingitem'],1);

echo '<div style="font-size:26px;clear:both">Top contributors :</div>';


		$contib = array();
			$winnerchart = mysql_query('SELECT input,player,fb_id,playername FROM merch_quest_input i LEFT JOIN merch_players p on p.fb_id = i.player WHERE quest = "'.$qid.'" order by input desc limit 3');
			while ($winner = mysql_fetch_assoc($winnerchart)) {
				$contib[] = $winner;
			}
		shuffle($contib);

echo '<table width=100%><tr>';
	if (count($contib) == 0) {echo '<td style="text-align:center">No contesters yet</td>';} 
		foreach ($contib as $cont) {
	$numbr = '';


	while (strlen($numbr) < strlen($cont['input'])) {
		if ($numbr == '') {
if ($quest['askingitem'] == 'gold') {$numbr = '?';} else {
$numbr = substr($cont['input'], 0,1);
}
} else {
			$numbr .= '?';
		}
}
	if (strlen($numbr) == 1) {$numbr = '?';}

	if (isAdmin()) {$numbr = $cont['input'];}
	if ($cont['player'] == $user) {$numbr = '<font style="color:purple">'.$cont['input'].'</font>';}
 echo '<td style="text-align:center" width=33%><img src="https://graph.facebook.com/'.$cont['fb_id'].'/picture" style="height:50px;float:left;width:50px;border:1px solid black;"><div style="font-size:26px">'.$numbr.'</div>'.$cont['playername'];}

}
echo '</table>';

	if (!$quest_open) {
		echo 'Quest is over. New quest in '.timeFormulate($quest['endtime']-$time+$questbuffer);
		if (!$quest['winner']) {
			$quest['winner'] = 'None';
			$winnerchart = mysql_query('SELECT input,player,playername FROM merch_quest_input i LEFT JOIN merch_players p on p.fb_id = i.player WHERE quest = "'.$qid.'" order by input desc limit 3');
			$place = 1;
			while ($winner = mysql_fetch_assoc($winnerchart)) {
			$contestant = $winner['player'];
				if ($place == 1) {
					$quest['winner'] = '1st : '.$winner['playername'].' ('.$winner['input'].')';
					mysql_query('INSERT INTO merch_quest_rewards (player , item , datewon ) VALUES ('.$contestant.',  "'.$prizes[1].'",  NOW());');
					mysql_query('INSERT INTO merch_quest_rewards (player , item , datewon ) VALUES ('.$contestant.',  "'.$prizes[3].'",  NOW());');
				}
				if ($place == 2) {
					$quest['winner'] .= ' 2nd : '.$winner['playername'].' ('.$winner['input'].')';
					mysql_query('INSERT INTO merch_quest_rewards (player , item , datewon ) VALUES ('.$contestant.',  "'.$prizes[2].'",  NOW());');
					mysql_query('INSERT INTO merch_quest_rewards (player , item , datewon ) VALUES ('.$contestant.',  "'.$prizes[3].'",  NOW());');
				}
				if ($place == 3) {
					$quest['winner'] .= ' 3rd : '.$winner['playername'].' ('.$winner['input'].')';
					mysql_query('INSERT INTO merch_quest_rewards (player , item , datewon ) VALUES ('.$contestant.',  "'.$prizes[3].'",  NOW());');
				}
				$place ++;
			}
			mysql_query('DELETE FROM merch_quest_input WHERE quest = "'.$qid.'"');

			$shuffle = true;
			$questlist[$qid] = $quest;
		}
		echo '<div>Winner was : '.$quest['winner'].'</div>';

		if (($quest['endtime']-$time+$questbuffer) < 0) {
			unset($questlist[$qid]);
			$shuffle = true;
		}
	} else {

	echo 'Quest ends in : '.timeFormulate($quest['endtime']-$time);
	}


echo '<div style="font-size:26px;clear:both">Rewards :</div>';
	echo showItemBox($prizes[1],1,'1st');
	echo showItemBox($prizes[2],1,'2nd');
	echo showItemBox($prizes[3],1,'Top 3');
}



	if ($shuffle) {

	$tombola = array_keys($questbank);
	while (count($questlist) < 1) {
		shuffle($tombola);
		$pick = $questbank[$tombola[0]];
		if (in_array($tombola[0],(array)$questlist)) {unset($pick);}
		if ($pick) {
			$pick['endtime'] = $time + $questduration;
			$questlist[$tombola[0]] = $pick;
		}
	}
	writeCache('quests',$questlist);
}

?>