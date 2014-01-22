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
		$key = $item;
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
	
	
	
	if ($itemdata['itemclass'] == 'currency') {
		$bonuses .= '<div class="itembonus" style="color:goldenrod !important">Special currency</div>';
	}
	
	if ($itemdata['itemclass'] == 'recipe') {
		$bonuses .= '<div class="itembonus" style="color:goldenrod !important">Educational scroll</div>';
		if (array_key_exists($itemdata['itemkey'],(array)$g['lifetime']['recipes_read'])) {
			$bonuses .= '<div class="itembonus" style="color:green !important">Already read</div>';
		} elseif ($g['inventory'][$itemdata['itemkey']] > 0 && $extra) {
			$bonuses .= '<div class="itembonus" style="color:green !important">Already owned</div>';
		}
	}
		
		
		
		
		
	if ($itemdata['needed']) {
		$bonuses .= '<div class="itembonus" style="color:goldenrod !important">Crafting component</div>';
		$needlist = array_keys($itemdata['needed']);
		if (count($itemdata['needed']) > 1) {
			$last_element = array_pop($needlist);
			array_push($needlist, 'and '.$last_element);
		}
		$bonuses .= '<div class="itembonus" style="color:gray !important">Used in '.str_replace(', and',' and',implode(', ', $needlist)).'</div>';
	}
	if ($itemdata['finding_skill']) {
		$bonuses .= '<div class="itembonus" style="color:gray !important">Found using '.$skillbank[trim($itemdata['finding_skill'])]['name'].'</div>';
	}
	
	
		foreach ($skillbank as $key => $value) {
			if ($itemdata['gather_boost_'.$key]) {
				$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_'.$key].'% '.$value['name'].' yield</div>';
			}
			if ($itemdata['skillup_'.$key]) {
				$bonuses .= '<div class="itembonus">Unlocks <span class="skillgrant"> '.$value['name'].' lvl.'.($itemdata['skillup_'.$key]+1).'</span> crafts</div>';
			}
			
			if ($itemdata['rare_find_'.$key]) {
				$bonuses .= '<div class="itembonus">+ '.$itemdata['rare_find_'.$key].'% '.$value['name'].' rare drop chance</div>';
			}
			if ($itemdata[$key.'_shorten_percent']) {
				$bonuses .= '<div class="itembonus">+ '.$itemdata[$key.'_shorten_percent'].'% '.$value['name'].' speed</div>';
			}
		}
		
		
	foreach ($itemdata as $key => $val) {
		if (strstr($key, '__') && $val) {
			$keybits = explode('__', $key);
			$affecteditem = $itembank[$keybits[1]];
			if ($keybits[0] == 'rare_drop') {
			$bonuses .= '<div class="itembonus">+ '.$val.'% <font class="rare">'.$affecteditem['name'].'</font> drop chance</div>';
			}
		}
	}
	
	if ($itemdata['crafting_dropchance']) {$bonuses .= '<div class="itembonus">'.$itemdata['crafting_dropchance'].' % chance for spending one random component less during production.</div>';}
	if ($itemdata['ah_slots']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['ah_slots'].' auction house slots</div>';}
	if ($itemdata['gather_boost_herb']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['gather_boost_herb'].'% Herbalism yield</div>';}
	if ($itemdata['courage']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['courage'].' courage</div>';}
	if ($itemdata['global_courage']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['global_courage'].' courage to all servants</div>';}
	
	
	if ($itemdata['travelspeed_shorten_percent']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['travelspeed_shorten_percent'].'% travel speed</div>';}
	if ($itemdata['processing_shorten_percent']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['processing_shorten_percent'].'% production speed</div>';}
	if ($itemdata['xp_bonus']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['xp_bonus'].'% XP gained</div>';}
	if ($itemdata['rare_find']) {$bonuses .= '<div class="itembonus">+ '.$itemdata['rare_find'].'% rare item chance</div>';}
	if ($itemdata['boost_slots_max']) {$bonuses .= '<div class="itembonus">Adds an additional tool slot (max '.$itemdata['boost_slots_max'].')</div>';}
	if ($itemdata['xp_points_gain']) {$bonuses .= '<div class="itembonus">Gain '.$itemdata['xp_points_gain'].' XP on consumption</div>';
	if (!$extra) {$extra = '<a href="#" onClick="itemConsume(\''.$item.'\')">Consume</a>';}
	}
	
	
	if ($itemdata['xp_flushskills']) {$bonuses .= '<div class="itembonus">Resets skillpoints on consumption</div>';
	if (!$extra) {$extra = '<a href="#" onClick="itemConsume(\''.$item.'\')">Consume</a>';}}
	
	if (!$extra && !$g['lifetime']['recipes_read'][$item] && $itemdata['itemclass'] == 'recipe') {$extra = '<a href="#" onClick="itemConsume(\''.$item.'\')">Learn</a>';}

	if ($itemdata['itembreak_tokens']) {$bonuses .= '<div class="itembonus">'.$itemdata['itembreak_tokens'].' uses left</div>';}
	
	$bonuses = str_replace('+ -','- ',$bonuses);


	if ($itemdata['flairtext']) {$detail = '<div style="font-style:italic;padding:3px;font-size:12px;color:#a0574a;font-family:Times">'.$itemdata['flairtext'].'</div>';}

	if ($itemdata['rarityscale'] == 1) {$itemclass = 'rare';}
	
	if ($extra == 'description') {return $bonuses.$detail;}
	
	
	
	if ($extra == 'short') {
	
	return '<b class="'.$itemclass.'"><span>'.($qty > 1 ? $qty : '').'</span> '.$itemdata['name'].'</b><br>'.$bonuses.$detail;
	}
	if ($extra) {$extra = '<div style="position:absolute;bottom:0px;right:0px;padding:4px;background-color:rgba(0,0,0,0.5)" class="actionpanel">'.$extra.'</div>';}
	
	return '<div class="itembox">'.itemIcon($itemdata).'<span>'.($qty > 1 ? $qty : '').'</span> <b class="'.$itemclass.'">'.$itemdata['name'].'</b>'.$extra.'<br>'.$bonuses.$detail.'</div>';
}

function achievementIcon($icon,$extra = "",$size=64) {
	if (!$icon) {$icon = 'empty.png';}
	$html = '<img src="http://art.macroheroes.com/64/gold/'.$icon.'" style="height:'.$size.'px;width:'.$size.'px;background-color:black;border:2px solid black;'.$extra.';">';
	return $html;
}

function itemIcon($item,$extra = "",$size=64,$tooltip=false,$qty = 0) {

if (!$item['artfile']) {
	return '<img src="http://art.macroheroes.com/64/dull/empty.png" style="height:'.$size.'px;width:'.$size.'px;background-color:black;border:1px solid black;'.$extra.';margin:2px;">';
}

	$border = 'dull';
	if ($item['itemclass'] == 'skill') { $border = 'skill';}
	$icon = '<img src="http://art.macroheroes.com/64/'.$border.'/'.$item['artfile'].'" style="height:'.$size.'px;width:'.$size.'px;background-color:black;border:1px solid black;'.$extra.';margin:2px;">';
	
	if ($qty > 1) {
		$qtylabel = '<span class="qty">'.number_format($qty,0,'.','.').'</span>';
	}
	
	if ($qty > 1 && !$tooltip) {
		return '<span class="icon">'.$icon.$qtylabel.'</span>';
	}
	
	if ($tooltip) {
		return '<span class="icon">'.$icon.'<div class="tool-tip">'.showItemBox($item,1,'short').'</div>'.$qtylabel.'</span>';
	} else {return $icon;}
	
	return $html;
}

?>