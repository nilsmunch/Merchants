<?

if (!is_array($g['inventory'])) {$g['inventory'] = array('bag_herbs'=>1,'gold'=>5);
if (isAdmin()) {$g['inventory'] = array('bag_herbs'=>1,'gold'=>500,'courage_amulet'=>2,'cheese_cheddar'=>10,'salty_potion'=>3,'xp_flask'=>15,'aptitude_potion'=>2,'warpstone'=>2);}
}

	$inventorywindow['html'] = '<b>Inventory:</b><div style="clear:right">';


foreach ((array)$g['inventory'] as $item => $qty) {
	if ($qty <= 0) {
		unset($g['inventory'][$item]);
	} else {
	$inventorywindow['html'] .= showItemBox($item,$qty);
	}
}

	$inventorywindow['html'] .= '</div>';

?>