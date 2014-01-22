<?
if (!function_exists('isConsumable')) {
function isConsumable($item) {
	if ($item['xp_points_gain']) {return true;}
	if ($item['xp_flushskills']) {return true;}
	return false;
}
}

if (!is_array($g['inventory'])) {$g['inventory'] = array('bag_herbs'=>1,'gold'=>5);
if (isAdmin()) {$g['inventory'] = array('bag_herbs'=>1,'gold'=>172500,'gm_gonzoherb'=>2,'majestic_craft'=>35,'apple'=>1200,'goldbar'=>100,'potion_skillwipe'=>3,'xp_flask'=>35,'aptitude_potion'=>2,'warpstone'=>2,'gm_pendulum'=>2);}
	$_SESSION['game_variables'] = $g;
}


foreach ((array)$g['inventory'] as $item => $qty) {	
	if ($qty <= 0) {
		unset($g['inventory'][$item]);
	} 
	}

	$inventorywindow['html'] = '<h2>Components:</h2><div style="clear:right">';

foreach ((array)$g['inventory'] as $item => $qty) {
	$itemdata = $itembank[$item];
	if (!$itemdata['needed']) {continue;}
	$inventorywindow['html'] .= itemIcon($itemdata,'',64,true,$qty);
	
}
	$inventorywindow['html'] .= '</div>';
	
	
	
$inventorywindow['html'] .= '<h2>Currency:</h2><div style="clear:right">';
foreach ((array)$g['inventory'] as $item => $qty) {
	$itemdata = $itembank[$item];
	if ($itemdata['needed']) {continue;}
	if ($itemdata['itemclass'] != 'currency') {continue;}
	$inventorywindow['html'] .= itemIcon($itemdata,'',64,true,$qty);
}
$inventorywindow['html'] .= '</div>';


$inventorywindow['html'] .= '<h2>Consumables:</h2><div style="clear:right">';
foreach ((array)$g['inventory'] as $item => $qty) {
	$itemdata = $itembank[$item];
	if ($itemdata['needed']) {continue;}
	if ($itemdata['itemclass'] == 'currency') {continue;}
	if (!isConsumable($itemdata)) {continue;}
	if ($qty <= 0) {
		unset($g['inventory'][$item]);
	} else {
		$inventorywindow['html'] .= showItemBox($item,$qty);
	}
}
$inventorywindow['html'] .= '</div>';
	
	

	$inventorywindow['html'] .= '<h2>Inventory:</h2><div style="clear:right">';


foreach ((array)$g['inventory'] as $item => $qty) {
	$itemdata = $itembank[$item];
	if ($itemdata['needed']) {continue;}
	if ($itemdata['itemclass'] == 'currency') {continue;}
	if (isConsumable($itemdata)) {continue;}
	if (strstr($item,':')) {
		$itmbits = explode(':',$item);$item = $itmbits[0];
	}
	
	$inventorywindow['html'] .= showItemBox($item,$qty);
}

	$inventorywindow['html'] .= '</div><br><br><div style="clear:both">&nbsp;</div>';

?>