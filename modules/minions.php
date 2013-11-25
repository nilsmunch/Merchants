<?

function minionTaskTime ($task) {
	global $skillbank,$boosts;
	$tasktime = array();
	$ratio = $skillbank[$task['gearneed']]['travel_vs_process'];
	$tasktime['travel'] = $task['time'] * $ratio;
	$tasktime['process'] = $task['time'] - $tasktime['travel'];

// Bonuses

	$travelspeed = 1 + (0.01 * $boosts['travelspeed_shorten_percent']);

	$tasktime['travel'] = ceil($tasktime['travel'] / $travelspeed);

	$processspeed = 1 + (0.01 * $boosts[$task['gearneed'].'_shorten_percent']);

	$tasktime['process'] = ceil($tasktime['process'] / $processspeed);


	$tasktime['totaltime'] = $tasktime['travel'] + $tasktime['process'];
// LAbels

$tasktime['labels'] = '<font style="color:cyan">'.$tasktime['travel'].'s travel</font> &middot; <font style="color:orange">'.$tasktime['process'].'s processing</font>';

if ($tasktime['travel'] == 0) {
$tasktime['labels'] = ' <font style="color:orange">'.$tasktime['process'].'s</font>';
}

		$tasktime['labels_box'] = ' <font style="font-size: 12px;
background-color:rgba(0,0,0,0.9);padding:4px;position:absolute;bottom:0px;left:0px">'.$tasktime['labels'].'</font>';

	return $tasktime;
}

function minionHeader($min,$wid = 30) {

	$face = '<img src="/media/art/faces/face_'.strtolower($min['name']).'.png" style="float:right">';
	$minionpage .= '<div style="width:'.$wid.'%;float:left;border:2px solid black;padding:0px;margin:2px;min-height:250px;">'.$face;
	$minionpage .= '<div style="background-color:black;color:white;padding:5px;height:71px;"><b>'.$min['name'].'</b><br>Level 1</div>';
	return $minionpage;
}


?>