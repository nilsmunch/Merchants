<?

db_connect();

if ($_POST) {
	$postitems = array();
	foreach ($_POST as $key => $val) {$postitems[$key] = $key.' = "'.$val.'" ';} 
	mysql_query('UPDATE `merch_items` SET '.implode(',',$postitems).' WHERE id = '.$detail);
	header('location:/admin/itemeditor/'.$detail);die();
}

$_SESSION['edititem'] = $detail;

$item = mysql_fetch_assoc(mysql_query('SELECT * FROM `merch_items` WHERE id = '.(int)$detail.' OR itemkey = "'.$detail.'"'));

$form = '<form action="/pages/admin/ajax/assistant.php" method="POST" id="editorform" style="display:block;clear:both;">';

$ignore_keys = array('id');
$entry_keys = array('entrypoint_market','entrypoint_findingtask');

foreach ($item as $key => $val) {
	$bring = true;
	$selection = '<input type="text" value="'.$val.'" class="gameValue" name="'.$key.'" id="'.$key.'">';
	
	if (in_array($key,$ignore_keys)) {
		$selection = '<input type="hidden" value="'.$val.'" name="'.$key.'" id="'.$key.'">'.$val;
	}


	if (in_array($key,$entry_keys)) {
	$selection = '<input type="radio" value="1" class="gameValue" name="'.$key.'" id="'.$key.'" '.($val ? 'CHECKED':'').'>Yes <input class="gameValue" type="radio" value="0" '.(!$val ? 'CHECKED':'').' name="'.$key.'">No ';
	}


	if ($bring) {
	$form .= '<div><label style="display:inline-block;width:230px">'.$key.':</label>'.$selection.'</div>';
	}
}

$form .= '</form>';

	$itemkey = $detail;
	$itembank[$itemkey] = $item;
	$box = '<div style="text-align:center;display:block;clear:both;">'.showItemBox($itemkey,1).'</div>';

$page = $box.$form;
?>