<?
include_once('skills.php');
include('gatheringskills.php');
include_once('experiencepoints.php');

function flushMinionItems($goon) {
	global $g,$itembank;
	foreach ($g['minions'][$goon]['items'] as $slot => $itm) {
		if ($itm == '') {unset($g['minions'][$goon]['items'][$slot]);}
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm);
			if ((int)$itmbits[1] <= 0) {
				$itemdata = $itembank[$itmbits[0]];
				unset($g['minions'][$goon]['items'][$slot]);
				$g['lifetime']['broken_'.$itemdata['itemclass']] += 1;
			}
		}
	}
	$g['minions'][$goon]['items'] = array_values($g['minions'][$goon]['items']);
}

function spendItemTokens($minion) {
	global $boosts,$itembank,$g;
	$boosts = array();	
	foreach ($minion['items'] as $itemindex => $itm) {
		$itemdata = $itembank[$itm];
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm); $itm = $itmbits[0];
			$itemdata = $itembank[$itm]; 
			$itemdata['itembreak_tokens'] = (int)$itmbits[1]+2;
			$minion['items'][$itemindex] = $itm.':'.((int)$itmbits[1] - 1);
			if (((int)$itmbits[1] -1) <= 0) {
				unset($minion['items'][$itemindex]);
				$g['lifetime']['broken_'.$itemdata['itemclass']] += 1;
			} 
		}
	}
	return $minion;
}

function minionBoosts($minion) {
	global $boosts,$itembank,$skillbank;
	if (!$skillbank) {include('databanks/skills.php');}
	$boosts = countPlayerSkills();	
	foreach ((array)$minion['items'] as $itm) {
		$itemdata = $itembank[$itm];
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm); $itm = $itmbits[0];
			$itemdata = $itembank[$itm]; $itemdata['itembreak_tokens'] = (int)$itmbits[1];
		}
		if ($itemdata['gather_boost_herb']) {
			$boosts['herb'] += $itemdata['gather_boost_herb'];
		}
		foreach ($skillbank as $key => $value) {
			if ($itemdata['gather_boost_'.$key]) {
				$boosts[$key] += $itemdata['gather_boost_'.$key];
			}
			if ($itemdata['rare_find_'.$key]) {
				$boosts['rare_find_'.$key] += $itemdata['rare_find_'.$key];
			}
			
			if ($itemdata[$key.'_shorten_percent']) {
				$boosts[$key.'_shorten_percent'] += $itemdata[$key.'_shorten_percent'];
			}
		}
		if ($itemdata['travelspeed_shorten_percent']) {
			$boosts['travelspeed_shorten_percent'] += $itemdata['travelspeed_shorten_percent'];
		}

		if ($itemdata['rare_find']) {
			$boosts['rare_find'] += $itemdata['rare_find'];
		}
		if ($itemdata['courage']) {
			$boosts['courage'] += $itemdata['courage'];
		}
		
		
		foreach ($itemdata as $key => $val) {
			if (strstr($key, '__')) {
				$boosts[$key] += $val;
			}
		}
	
		
		$boosts['herbalism'] = $boosts['herb'];
	}
}

function pricecheck($good,$qty,$spend = false) {
	global $g;
	if ($g['inventory'][$good] < $qty) {
		return false;
	}
	if ($spend) {	$g['inventory'][$good] -= $qty; }
	return true;
}

function wearItem($item,$goon) {
	global $g,$itembank;
	$itemdata = $itembank[$item];
	if (!$itemdata) {die('ARC');}
	flushMinionItems($goon);
	if ($itemdata['itembreak_tokens']) {$item .= ':'.$itemdata['itembreak_tokens'];}
	if ( $itemdata['itemclass'] == 'skill') {
		$g['minions'][$goon]['items'][0] = $item;
	} else {
		$g['minions'][$goon]['items'][] = $item;
	}
	removeFromInventory($item);
	unset($_SESSION['inventoryReload']);
	unset($_SESSION['goongearReload']);
	unset($_SESSION['mainscreenReload']);
}

function removeWornItem($item,$goon) {
	global $g;
	flushMinionItems($goon);
	foreach ($g['minions'][$goon]['items'] as $index => $w_item) {
		if ($item == $w_item) {
			unset($g['minions'][$goon]['items'][$index]);
			break;
		}
	}
	$g['minions'][$goon]['items'] = array_values($g['minions'][$goon]['items']);
	addToInventory($item);
	unset($_SESSION['inventoryReload']);
	unset($_SESSION['mainscreenReload']);
	unset($_SESSION['goongearReload']);
}


function addToInventory($item,$qty = 1) {
	if ($item == 'xp') {
		xp_gain($qty,'reward');
		return;
	}
	

	global $g,$run_js,$itembank;
	
	if (strstr($item,':')) {
		$itmbits = explode(':',$item);
		$item = $itmbits[0];
	}
	
	
	$itemdata = $itembank[$item];
	$g['inventory'][$item] += $qty;
	unset($_SESSION['inventoryReload']);
	
	
	$run_js .= 'jQuery.noticeAdd({
				text: "+ '.$qty.' '.$itemdata['name'].str_replace('"','\\\'',itemIcon($itemdata,'position:absolute;right:10px;top:8px',30)).'",
				stay: false
			});';
}

function removeFromInventory($item) {
	global $g;


	if (strstr($item,':')) {
		$itmbits = explode(':',$item);$item = $itmbits[0];
	}

	$g['inventory'][$item] -= 1;
	if ($g['inventory'][$item] <= 0) {
		unset($g['inventory'][$item]);
		$g['lifetime']['broken_'.$itemdata['itemclass']] += 1;
	}
	$g['inventory'] = ($g['inventory']);
}

?>