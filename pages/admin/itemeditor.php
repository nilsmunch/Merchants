<?
db_connect();

if ($_POST) {
	$postitems = array();
	foreach ($_POST as $key => $val) {$postitems[$key] = $key.' = "'.$val.'" ';} 
	mysql_query('UPDATE `merch_items` SET '.implode(',',$postitems).' WHERE id = '.$detail);
	header('location:/admin/itemeditor/'.$detail);die();
}

$_SESSION['edititem'] = $detail;

$item = mysql_fetch_assoc(mysql_query('SELECT * FROM  `merch_items` WHERE id = '.$detail));

$form = '<form action="" method="POST" style="display:block;clear:both;">';

$ignore_keys = array('id');
$entry_keys = array('entrypoint_market','entrypoint_findingtask');

foreach ($item as $key => $val) {
	$bring = true;
	if (in_array($key,$ignore_keys)) {$bring = false;}

	$selection = '<input type="text" value="'.$val.'" name="'.$key.'">';

	if (in_array($key,$entry_keys)) {
	$selection = '<input type="radio" value="1" name="'.$key.'" '.($val ? 'CHECKED':'').'>Yes <input type="radio" value="0" '.(!$val ? 'CHECKED':'').' name="'.$key.'">No ';
	}


	if ($bring) {
	$form .= '<div><label style="display:inline-block;width:130px">'.$key.':</label>'.$selection.'</div>';
	}
}

$form .= '<input type="submit"></form>';

	$itemkey = $detail;
	$itembank[$itemkey] = $item;
	$box = '<div style="text-align:center;display:block;clear:both;">'.showItemBox($itemkey,1).'</div>';

$page = $box.$form;
?>