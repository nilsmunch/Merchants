<?
session_start();

$timespan = 5*60;

include('../config.php');
include('databanks/items.php');
include('databanks/auto_tasks.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/tasks.php');
$time = date('U');


	if (isAdmin()) {$timespan = 5;}
// SUPPLY AND DEMAND
$g = $_SESSION['game_variables'];
	if (!$g['resolved_tasks']) {$g['resolved_tasks'] = array();}
	if (!$g['taskbank']) {$g['taskbank'] = array();}


if ($_GET['action'] == 'ignore') {
	$taskkey = $_GET['target'];
	unset($g['taskbank'][$taskkey]);
	$assigned = true;
	$g['task_cooldown'] = $time + $timespan;
}

if ($_GET['action'] == 'resolve') {
	$taskkey = $_GET['target'];
	$task = $g['taskbank'][$taskkey];
	$can = true;
	
	$recipebits = explode(';',$task['demand']);
	foreach ($recipebits as $value) {
		$bits = explode(':', $value);
		if (!pricecheck($bits[0],(int)$bits[1],false)) {
			$can = false;
		}
	}
	if (isAdmin()) {$can = true;}
	if ($can) {
		foreach ($recipebits as $value) {
			$bits = explode(':', $value);
			pricecheck($bits[0],(int)$bits[1],true);
		}
		
		$rewardbits = explode(';',trim($task['reward']));
		foreach ($rewardbits as $value) {
			$bits = explode(':', $value);
			addToInventory(trim($bits[0]),(int)$bits[1]);
		}
		
		
		$g['resolved_tasks'][] = $taskkey;
		$assigned = true;
		unset($g['taskbank'][$taskkey]);
		echo 'TASK RESOLVED';
		$g['task_cooldown'] = $time + $timespan;
	} else {
		echo 'Error - Not enough goods!';
	}
}

if ($_GET['action'] == 'sell') {
/*
	$itemkey = $_GET['target'];
	$itemdata = $itembank[$itemkey];
	processMultiplier($itemkey);
	$can = pricecheck($itemkey,$itemdata['cityasking_qty'],true);
	if ($can) {
		addToInventory('gold',$itemdata['cityasking_gold']);
		$notif = 'Transaction complete! Hope to do business with you in the future.';
		unset($_SESSION['market_demand']);
	} else {
		$notif = 'You do not have the requested items!';
	}
	*/
	$assigned = true;
}

$hint = 'Heroes are characters coming to your store, seeking assistance and goods once in a while. They are usually off questing, and will not linger in the town for long.';


//echo '<div>'.$hint.'</div>';

$tries = 40;

if ($g['task_cooldown'] <= $time) {
while (count($g['taskbank']) < 2 && $tries > 0) {
	shuffle($lib_tasks);
	$picker = $lib_tasks[0];
	if (!in_array($picker['key'], (array)$g['resolved_tasks']) && !in_array($picker['key'], (array)array_keys($g['taskbank']))	) {$g['taskbank'][$picker['key']] = $picker;}
	$assigned = true;
	$tries--;
	$g['task_cooldown'] = $time + $timespan;
	$assigned = true;
}
}

if (count($g['taskbank']) == 0) {echo '<div style="text-align:center;padding:20px;">No tasks for you at this time...</div>';
	if (isAdmin()) {unset($g['resolved_tasks']);}
	$assigned = true;

}

foreach ((array)$g['taskbank'] as $tkey => $task) {
	if (!is_array($task)) {continue;}
	$extradata = $lib_tasks[$tkey];
	$dem = explode(';',$task['demand']);
	$firstitems = explode(':',$dem[0]);
	$story = nl2br($extradata['story']);
	
	$story = str_replace('{item_1}','<b>'.$itembank[$firstitems[0]]['name'].'</b>',$story);
	
	$story = preg_replace('|"(.*?)"|is','<i style="color:purple">${0}</i>', $story);
	
	echo '<div><h2>'.$task['headline'].'</h2><div style="background-color:white;padding:10px;font-size:12px;">'.$story.'</div></div>';
	//print_r($task);
	echo '<div style="float:left; width:200px;">Request:<br>'.costBox(explode(';', $task['demand'])).'</div>';
	echo '<div>Reward:<br>'.costBox(explode(';', trim($task['reward'])),true).'</div>';
	echo '<a href="#" class="btn" style="float:left" onClick="openHeroes(\'resolve\',\''.$task['key'].'\')">Resolve encounter</a>';
	echo '<a href="#" class="btn" style="float:right;clear:none" onClick="openHeroes(\'ignore\',\''.$task['key'].'\')">Ignore encounter</a>';
	echo '<hr style="clear:both;margin:10px;display:block;">';
}

if ($assigned) {
	$_SESSION['game_variables'] = $g;
}


echo javaCheck();

?>