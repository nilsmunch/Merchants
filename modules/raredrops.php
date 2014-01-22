<?

function dropChanceMath($task) {
	global $boosts;
	$basechance = $task['rare_chance'];
	$shard = ($basechance / 100);
	return (int)$basechance + ($shard * $boosts['rare_find']) + ($shard * $boosts['rare_find_'.$task['gearneed']]) + ($shard * $boosts['rare_drop__'.$task['rare_drop']]);
}

function dropChances ($task) {
	global $itembank,$boosts;
	$chance = dropChanceMath($task);
	$drop = $itembank[$task['rare_drop']];
	if ($chance == 0) {return '';}
	return '<div class="taskdetail">'.$chance.'% chance for <span class="rare">'.$drop['name'].'</span></div>';
}

function calcRareDrops($task,$qty) {
	global $itembank,$boosts;
	$drops = array();
	
	$chance = dropChanceMath($task);
	$dropkey = $task['rare_drop'];
	$drop = $itembank[$task['rare_drop']];
	if ($chance == 0) {return array();}
	if (!$drop) {return array();}
	
	$dice = 0;
	while ($dice <= $qty) {
		if (rand(1,100) <= $chance) {
			$rares += 1;
			$drops[$dropkey] = array('item'=>$dropkey,'qty'=>$rares);
		}
		$dice++;
	}
	
	return $drops;
}

?>