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
	global $itembank,$g,$skillbank;
	if (!$skillbank) {include('databanks/skills.php');}

	if ($item == nil) {
	return '<div style="float:left;width:280px;height:100px;border:2px solid grey;;margin:2px;padding:3px;">Empty slot</div>';
	}
	if (!$item) {return '';}
	if (is_array($item)) {$itemdata = $item;} else {
	$itemdata = $itembank[$item];

		if (strstr($item,':')) {
			$itmbits = explode(':',$item); $item = $itmbits[0];
			$itemdata = $itembank[$item]; 
			if ((int)$itmbits[1] != $itemdata['itembreak_tokens']) {
			unset($extra);
			}
			$itemdata['itembreak_tokens'] = (int)$itmbits[1];
		}
		}



	if (!$itemdata) {return;}
	if ($itemdata['skillgrant'] && $itemdata['skillgrant'] != 'passive') {$bonuses .= '<div class="itembonus">Unlocks <span class="skillgrant">'.$skillbank[$itemdata['skillgrant']]['name'].'</span> actions</div>';}
	
	
		foreach ($skillbank as $key => $value) {
			if ($itemdata['gather_boost_'.$key]) {
				$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_'.$key].'% '.$value['name'].' yield</div>';
			}
			
			if ($itemdata[$key.'_shorten_percent']) {
				$bonuses .= '<div class="itembonus">+ '.$itemdata[$key.'_shorten_percent'].'% '.$value['name'].' speed</div>';
			}
		}
	
	if ($itemdata['gather_boost_herb']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_herb'].'% herb gathering bonus</div>';}
	if ($itemdata['courage']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['courage'].' courage</div>';}
	if ($itemdata['travelspeed_shorten_percent']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['travelspeed_shorten_percent'].'% travel speed</div>';}
	if ($itemdata['processing_shorten_percent']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['processing_shorten_percent'].'% production speed</div>';}
	if ($itemdata['rare_find']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['rare_find'].'% rare item chance</div>';}
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

	if ($itemdata['rarityscale'] == 1) {$itemclass = 'rare';}
	return '<div class="itembox">'.itemIcon($itemdata).'<span>'.($qty > 1 ? $qty : '').'</span> <b class="'.$itemclass.'">'.$itemdata['name'].'</b>'.$extra.'<br>'.$bonuses.$detail.'</div>';
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