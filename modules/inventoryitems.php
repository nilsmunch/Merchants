<?
include_once('skills.php');
include('gatheringskills.php');

function flushMinionItems($goon) {
	global $g;
	foreach ($g['minions'][$goon]['items'] as $slot => $itm) {
		if ($itm == '') {unset($g['minions'][$goon]['items'][$slot]);}
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm);
			if ((int)$itmbits[1] <= 0) {	unset($g['minions'][$goon]['items'][$slot]);}
		}
	}
	$g['minions'][$goon]['items'] = array_values($g['minions'][$goon]['items']);
}

function spendItemTokens($minion) {
	global $boosts,$itembank;
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
			} 
		}
	}
	return $minion;
}

function minionBoosts($minion) {
	global $boosts,$itembank;
	$boosts = countPlayerSkills();	
	foreach ($minion['items'] as $itm) {
		$itemdata = $itembank[$itm];
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm); $itm = $itmbits[0];
			$itemdata = $itembank[$itm]; $itemdata['itembreak_tokens'] = (int)$itmbits[1];
		}
		if ($itemdata['gather_boost_herb']) {
			$boosts['herb'] += $itemdata['gather_boost_herb'];
		}
		if ($itemdata['gather_boost_fishing']) {
			$boosts['fishing'] += $itemdata['gather_boost_fishing'];
		}
		if ($itemdata['gather_boost_lumbering']) {
			$boosts['lumbering'] += $itemdata['gather_boost_lumbering'];
		}
		if ($itemdata['travelspeed_shorten_percent']) {
			$boosts['travelspeed_shorten_percent'] += $itemdata['travelspeed_shorten_percent'];
		}

		if ($itemdata['courage']) {
			$boosts['courage'] += $itemdata['courage'];
		}
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
	$g['minions'][$goon]['items'][] = $item;
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
	global $g,$run_js;
	$g['inventory'][$item] += $qty;
	unset($_SESSION['inventoryReload']);
	$run_js .= 'jQuery.noticeAdd({
				text: "+ '.$qty.' '.$item.'",
				stay: false
			});';
}

function removeFromInventory($item) {
	global $g;


	if (strstr($item,':')) {
		$itmbits = explode(':',$item);$item = $itmbits[0];
	}

	$g['inventory'][$item] -= 1;
	if ($g['inventory'][$item] <= 0) {unset($g['inventory'][$item]);}
	$g['inventory'] = ($g['inventory']);
}

?>