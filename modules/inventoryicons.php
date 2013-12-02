<?

function javaCheck() {
global $run_js,$hiddenview;
if ($hiddenview) {
	$_SESSION['storedNotifications'] .= $run_js;
	return;
}
if ($_SESSION['storedNotifications']) {
	$run_js .= $_SESSION['storedNotifications'];
	unset($_SESSION['storedNotifications']);
}
if ($run_js) {
	return '<img src="/media/art/button_highscore.png" style="display:none" onload="'.str_replace('"','\'',$run_js).'">';
}
}

function showItemBox($item,$qty,$extra="") {
	global $itembank,$g;


	if ($item == nil) {
		
	return '<div style="float:left;width:280px;height:100px;border:2px solid grey;;margin:2px;padding:3px;">Empty slot</div>';
	}
	if (!$item) {return '';}
	if (is_array($item)) {$itemdata = $item;} else {
	$itemdata = $itembank[$item];

		if (strstr($item,':')) {
			$itmbits = explode(':',$item); $item = $itmbits[0];
			$itemdata = $itembank[$item]; $itemdata['itembreak_tokens'] = (int)$itmbits[1];
		unset($extra);
		}
		}



	if (!$itemdata) {return;}
	if ($itemdata['skillgrant'] && $itemdata['skillgrant'] != 'passive') {$bonuses .= '<div class="itembonus">Unlocks '.$itemdata['skillgrant'].' actions</div>';}
	if ($itemdata['gather_boost_herb']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_herb'].'% herb gathering bonus</div>';}
	if ($itemdata['gather_boost_fishing']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_fishing'].'% fishing bonus</div>';}
	if ($itemdata['gather_boost_lumbering']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_lumbering'].'% woodcutting bonus</div>';}
	if ($itemdata['gather_boost_fruitpicking']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_fruitpicking'].'% fruitpicking bonus</div>';}
	if ($itemdata['courage']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['courage'].' courage</div>';}
	if ($itemdata['travelspeed_shorten_percent']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['travelspeed_shorten_percent'].'% travel speed</div>';}
	if ($itemdata['processing_shorten_percent']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['processing_shorten_percent'].'% production speed</div>';}
	if ($itemdata['boost_slots_max']) {$bonuses .= '<div class="itembonus">Adds an additional tool slot (max '.$itemdata['boost_slots_max'].')</div>';}
	if ($itemdata['xp_points_gain']) {$bonuses .= '<div class="itembonus">Gain '.$itemdata['xp_points_gain'].' XP on consumption</div>';
	if (!$extra) {$extra = '<a href="#" onClick="itemConsume(\''.$item.'\')">Consume</a>';}
	}
	if (!$extra && !$g['lifetime']['recipes_read'][$item] && $itemdata['itemclass'] == 'recipe') {$extra = '<a href="#" onClick="itemConsume(\''.$item.'\')">Consume</a>';}

	if ($itemdata['itembreak_tokens']) {$bonuses .= '<div class="itembonus">'.$itemdata['itembreak_tokens'].' uses left</div>';}
	
	$bonuses = str_replace('+ -','- ',$bonuses);

	if ($extra == 'description') {return $bonuses;}

	if ($extra) {$extra = '<div style="position:absolute;bottom:0px;right:0px;padding:4px;background-color:rgba(0,0,0,0.5)" class="actionpanel">'.$extra.'</div>';}
	if ($itemdata['flairtext']) {$detail = '<div style="font-style:italic;padding:3px;font-size:12px;color:#a0574a;font-family:Times">'.$itemdata['flairtext'].'</div>';}


	return '<div style="position:relative;float:left;width:280px;height:100px;border:2px solid #7b6003;margin:2px;padding:3px;">'.itemIcon($itemdata,'float:left').($qty > 1 ? $qty : '').' <b>'.$itemdata['name'].'</b>'.$extra.'<br>'.$bonuses.$detail.'</div>';
}

function achievementIcon($icon,$extra = "",$size=64) {
	if (!$icon) {$icon = 'empty.png';}
	$html = '<img src="http://art.macroheroes.com/64/gold/'.$icon.'" style="height:'.$size.'px;width:'.$size.'px;background-color:black;border:2px solid black;'.$extra.';margin:2px;">';
	return $html;
}

function itemIcon($item,$extra = "",$size=64) {
if (!$item['artfile']) {return '<img src="http://art.macroheroes.com/64/dull/empty.png" style="height:'.$size.'px;width:'.$size.'px;background-color:black;border:1px solid black;'.$extra.';margin:2px;">';}
	$border = 'dull';
	if ($item['itemclass'] == 'skill') { $border = 'skill';}
	$html = '<img src="http://art.macroheroes.com/64/'.$border.'/'.$item['artfile'].'" style="height:'.$size.'px;width:'.$size.'px;background-color:black;border:1px solid black;'.$extra.';margin:2px;">';
	return $html;
}

?>