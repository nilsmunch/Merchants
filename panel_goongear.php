<?
$minpip = (int)$_SESSION['spotlightGoon'];
flushMinionItems($minpip);
$goon = $g['minions'][$minpip];


$goongear['html'] = minionHeader($goon,100).'<div style="margin-left:auto;margin-right:auto;clear:both;padding:20px">';


	foreach ($goon['items'] as $slot => $itm) {
		if ($itm == 'aptitude_potion' && $goon['slots'] < 4) {
			$goon['slots']++;
			unset($goon['items'][$slot]);
		}
		if ($itm == 'majestic_craft' && $goon['slots'] < 5) {
			$goon['slots']++;
			unset($goon['items'][$slot]);
		}
		if ($itm == '') {unset($goon['items'][$slot]);}
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm);
			if ((int)$itmbits[1] <= 0) {	unset($goon['items'][$slot]);}
		}
	}

$g['minions'][$minpip] = $goon;

	$slot = 0;
	$skillbank = array();
	while ($slot < $goon['slots']) {
		if ($goon['items'][$slot]) {
		$itm = $goon['items'][$slot];
		$itemdata = $itembank[$itm];
		$remo = '<a href="#" onClick="gearupGoonUnwear('.$minpip.',\''.$itm.'\')">Remove</a>';
		if ($itemdata['itemclass'] == 'skill') {unset($remo);}
		$goongear['html'] .= showItemBox($itm,0,$remo);
	} else {
		$goongear['html'] .= showItemBox(nil,0);
		}
		$slot++;
	}


$goongear['html'] .= '</div>';
$goongear['html'] .= '</div>';

$goongear['html'] .= '<hr style="clear:both"><div style="font-size:24px">Inventory</div><div >';

foreach ((array)$g['inventory'] as $item => $qty) {

	if (strstr($item,':')) {
		unset($g['inventory'][$item]);
		$itmbits = explode(':',$item);
		$item = $itmbits[0];
		$g['inventory'][$item] = $qty;
	}
}

foreach ((array)$g['inventory'] as $item => $qty) {

	if (strstr($item,':')) {
		$itmbits = explode(':',$item);
		if ((int)$itmbits[1] <= 0) { unset($goon['items'][$slot]); }
		$item = $itmbits[0];
	}
		
	$itemdata = $itembank[$item];
	if ($itemdata['skillgrant']) {
		$wearlink = '<a href="#" onClick="gearupGoonWear('.$minpip.',\''.$item.'\')">Wear</a>';
		if ($goon['slots'] <= count($goon['items'])) {$wearlink = 'Slots full';}
		$goongear['html'] .= showItemBox($item,$qty,$wearlink);
	}	
}
$goongear['html'] .= '</div>';

$goongear['html'] .= '<a href="#" onClick="showView(\'#result\')" style="clear:both;display:block">Back to servants</a>';

$_SESSION['game_variables'] = $g;

?>