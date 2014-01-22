<?

include('databanks/formulations.php');
include('databanks/achievements.php');
$rewards = false;
if (!$g['achievements_unlocked']) {$g['achievements_unlocked'] = array();}

$g['lifetime']['tasted_cheeses_types'] = count($g['lifetime']['tasted_cheeses']);

$badge = 0;


foreach ((array)$achievementsbank as $achkey => $ach) {
	$ach['done'] = in_array($achkey,$g['achievements_unlocked']);
	$achChainEntries[$ach['chain']][] = $ach;
}



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
		if ($result >= $ach['listener_min'] && !in_array($achkey,$g['achievements_unlocked'])) {

			$completer .= '<br> <a href="#" class="btn" onClick="minionCollectGoods(\'ach_claimed\',\''.$achkey.'\')">Collect</a>';
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

		if ($completer) {$badge++;}
		$form = str_replace('XX',(int)$ach['listener_min'],$form_action[$ach['listener']]);
		$achBox = '<div class="'.($completer ? 'collectable' : '').' ach" style="padding:5px;float:left;width:45%">'.achievementIcon($ach['artfile'],'float:left;margin:2px;').'<b>'.$ach['name'].'</b>';
		$achBox .= '<br><i style="font-size:12px;">&nbsp;&middot; '.$form.'  ('.(int)$result.' / '.$ach['listener_min'].')</i>';
			if ($ach['reward']) {
				$rewarditem = $itembank[$ach['reward']['type']];
				
				
		$subsets = '';
		foreach ($achChainEntries[$ach['chain']] as $subarch) {
			$subsets .= achievementIcon($subarch['artfile'],'opacity:'.($subarch['done'] ? '1.0;border-color:green':'0.4').';margin-left:2px;bottom:0px;',28);
		}
		$achBox .= '<div style="float:right">'.$subsets.'</div>';
		$achBox .= '<br><i style="font-size:12px;">Reward : '.(int)$ach['reward']['qty'].' '.$rewarditem['name'].'</i>'.$completer.'</div>';
		if (!$ach['category']) {$ach['category'] = 'Misc';}
		if ($ach['chain']) {
			$ach['html'] = $achBox;
			$achChains[$ach['chain']][] = $ach;
		} else {
		//$achCats[$ach['category']] .= $achBox;
		}
}
}
		
	}
}


foreach ($achChains as $chain) {
	foreach ($chain as $ach) {
		$achCats[$ach['category']] .= $ach['html'];
	}
}

$achievementWindow['html'] = '';
foreach ($achCats as $key => $value) {
	$achievementWindow['html'] .= '<h2>'.$key.'</h2>'.$value;
}

$achievementWindow['badge'] = ($badge ? 'Achievements!<span class="badge">'.$badge.'</span>':'Achievements');

if ($rewards) {
	include('panel_inventory.php');
}

if (isAdmin()) {
$achievementWindow['html'] .= '<hr style="clear:both;"><a href="#" class="btn" onClick="if (confirm(\'Are you sure?\')) performAct(-1,\'resetall\');">RESET ALL DATA</a>';
}

?>