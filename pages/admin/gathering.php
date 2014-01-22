<?
db_connect();

//$box = '<div style="text-align:center;display:block;clear:both;">'.showItemBox($itemkey,1).'</div>';

$page = 'Things that a GM should look at:';

include('databanks/items.php');
include('databanks/actions.php');
include('databanks/formulations.php');
include('databanks/skills.php');

$itemsQ = mysql_query('SELECT * FROM  `merch_items` WHERE finding_skill != "" AND entrypoint_findingtask = 1 ORDER BY finding_skill,itemlevel'); // where release_build = 0

while ($item = mysql_fetch_assoc($itemsQ)) {
	if (!$mentioned[$item['finding_skill']]) {$page .= '<hr>'.$item['finding_skill'].'<br>';$mentioned[$item['finding_skill']] = true;}
		$icon = itemIcon($item,'',64,false,$item['itemlevel']);
		$page .= '<a href="http://merch.con/admin/itemeditor/'.$item['id'].'">'.$icon.'</a> ';
		
}
?>