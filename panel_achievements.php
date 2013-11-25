<?

include('databanks/achievements.php');
$rewards = false;
if (!$g['achievements_unlocked']) {$g['achievements_unlocked'] = array();}

$g['lifetime']['tasted_cheeses_types'] = count($g['lifetime']['tasted_cheeses']);

$achievementWindow['html'] = '<div style="clear:both">Achievements:</div>';
foreach ((array)$achievementsbank as $achkey => $ach) {
	$include = true;
	if (in_array($achkey,$g['achievements_unlocked'])) {
		$include = false;
	}
	if ($ach['prerequisite'] && !in_array($ach['prerequisite'],$g['achievements_unlocked'])) {
		$include = false;
	}
	if ($include) {
		$result = $g['lifetime'][$ach['listener']];
		$completer = '';
		if ($result >= $ach['listener_min']) {

			$completer .= '<br> <a href="#" onClick="minionCollectGoods(\'ach_claimed\',\''.$achkey.'\')">Collect</a>';
			$process[$pit] = $timeleft;

			if ($_SESSION['collect']['ach_claimed'.$achkey]) {
			
			$g['achievements_unlocked'][$achkey] = $achkey;

			if ($ach['reward']) {
				$g['inventory'][$ach['reward']['type']] += (int)$ach['reward']['qty'];	
				unset($_SESSION['inventoryReload']);
				unset($_SESSION['achievementsReload']);
				$include = false;
				$rewards = true;
			}
			unset($_SESSION['collect']);
			}
		}

	if ($include) {
	if ($ach['formulation']) {$form_action[$ach['listener']] = $ach['formulation'];}


		$form = str_replace('XX',(int)$ach['listener_min'],$form_action[$ach['listener']]);
		$achievementWindow['html'] .= '<div style="margin:5px;float:left;width:30%">'.achievementIcon($ach['artfile'],'float:left').'<b>'.$ach['name'].'</b> ('.(int)$result.' / '.$ach['listener_min'].')';
		$achievementWindow['html'] .= '<br><i style="font-size:12px;">'.$form.'</i>';
			if ($ach['reward']) {
				$rewarditem = $itembank[$ach['reward']['type']];
		$achievementWindow['html'] .= '<br><i style="font-size:12px;">Reward : '.(int)$ach['reward']['qty'].' '.$rewarditem['name'].'</i>'.$completer.'</div>';
}
}
		
	}
}

if ($rewards ) {
	include('panel_inventory.php');
}

$achievementWindow['html'] .= '<hr style="clear:both"><a href="#" style="display:block;clear:both" onClick="if (confirm(\'Are you sure?\')) performAct(-1,\'resetall\');">RESET ALL DATA</a>';

?>