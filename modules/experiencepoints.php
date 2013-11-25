<?

function RF($lvl) {
	if ($lvl < 25) {return 0.82;}
	return 1;
}

function xp_diff($lvl) {
	if ($lvl < 10) {return 0;}
	return (2 * $lvl);
}


function MXP($lvl) {
	return 45 + (5 * $lvl);
}

function points_to_level($lvl) {
	return floor(((8 * $lvl) + xp_diff($lvl)) * MXP($lvl) * RF($lvl));
}

function xp_gain($points,$reason='') {
	global $g,$run_js;
	if (!$points) {$points = 1;}
	$g['xp'] += $points;
	if ($reason) {
		$g['lifetime']['xpgained_'.$reason] += $points;
	}
	$run_js .= 'refreshXP();';
}

?>