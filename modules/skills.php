<?


function countPlayerSkills() {
	global $g,$perkbank;
	$bonuses = array();
	if (!$perkbank) {include('databanks/skills.php');}
	foreach ((array)$g['skills'] as $skl => $steps) {
		$skilldata = $perkbank[$skl-1];
		$bonuses[$skilldata['bonus']] = $skilldata['value']*$steps;
	}
	return $bonuses;
}


?>