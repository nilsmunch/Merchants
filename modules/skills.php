<?


function countPlayerSkills() {
	global $g,$perkbank,$skillbank;
	$bonuses = array();
	if (!$perkbank || !$skillbank) {include('databanks/skills.php');}
	foreach ((array)$g['skills'] as $skl => $steps) {
		$skilldata = $perkbank[$skl-1];
		
		
		
		
		$bonuses[$skilldata['bonus']] = $skilldata['value']*$steps;
		
		if ($skilldata['skillup']) {
		$bonuses['skillup_'.$skilldata['skillup']] = $steps;
		}
	}
	
		foreach ($skillbank as $key => $value) {
			if ($bonuses['gather_boost_'.$key]) {
				$bonuses[$key] = $bonuses['gather_boost_'.$key];
			}
		}
		
	return $bonuses;
}


?>