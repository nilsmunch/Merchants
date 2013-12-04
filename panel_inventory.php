<?

if (!is_array($g['inventory'])) {$g['inventory'] = array('bag_herbs'=>1,'gold'=>5);
if (isAdmin()) {$g['inventory'] = array('bag_herbs'=>1,'gold'=>22500,'tool_arcanism'=>2,'cheese_cheddar'=>10,'steed'=>1,'salty_potion'=>3,'xp_flask'=>15,'aptitude_potion'=>2,'warpstone'=>2,'gm_pendulum'=>2);}
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