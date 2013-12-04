<?

function dropChances ($task) {
	global $itembank,$boosts;
	$chance = (int)$task['rare_chance'] + (($task['rare_chance'] / 100) * $boosts['rare_find']);
	$drop = $itembank[$task['rare_drop']];
	if ($chance == 0) {return '';}
	return '<div class="taskdetail">'.$chance.'% chance for <span class="rare">'.$drop['name'].'</span></div>';
}

function calcRareDrops($task,$qty) {
	global $itembank,$boosts;
	$drops = array();
	
	$chance = (int)$task['rare_chance'] + (($task['rare_chance'] / 100) * $boosts['rare_find']);
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