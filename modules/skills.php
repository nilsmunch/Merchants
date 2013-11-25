<?


function countPlayerSkills() {
	global $g,$perkbank;
	$bonuses = array();
	foreach ((array)$g['skills'] as $skl => $steps) {
		$skilldata = $perkbank[$skl-1];
		$bonuses[$skilldata['bonus']] = $skilldata['value']*$steps;
	}
	return $bonuses;
}


?>