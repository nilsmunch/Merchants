<?
db_connect();

//$box = '<div style="text-align:center;display:block;clear:both;">'.showItemBox($itemkey,1).'</div>';

$page = 'Things that a GM should look at:';

include('databanks/items.php');
include('databanks/actions.php');
include('databanks/formulations.php');
include('databanks/skills.php');

foreach ($itembank as $key => $value) {
	$show = false;
	
	//if ($value) {$show = print_r($value,true);}
	
	if ($value['finding_skill'] && !$value['needed']) {$show = 'Can be gathered but is not needed...';}
	if ($value['craft_ingredients'] && !$value['needed'] && $value['skillgrant'] == '' && !$value['xp_points_gain']) {$show = 'Can be crafted but has no use...';}
	if ($show) {
		$icon = itemIcon($value,'vertical-align:middle',32,false,1);
		$page .= '<hr><a href="http://merch.con/admin/itemeditor/'.$key.'">'.$icon.$key.'</a> '.$show;
	}
}
?>