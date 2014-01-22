<?
include('../../../../config.php');
include('../../../gamemanagers/virtual_economy/package.php');
include('../../../databanks/items.php');
include('../../../databanks/skills.php');

$detail = (int)$_POST['id'];

$item = $_POST;


if ($_POST) {
	db_connect();
	$postitems = array();
	foreach ($item as $key => $val) {$postitems[$key] = $key.' = "'.$val.'" ';} 
	mysql_query('UPDATE merch_items SET '.implode(',',$postitems).' WHERE id = '.$detail) or die(mysql_error());
}

// BALANCING

$balancer = new InventoryItemBalancer($item);

if ($skillbank[$item['finding_skill']]) {
$skl = $skillbank[$item['finding_skill']];
$report = $balancer->NewBalancingValue('finding_time','scale_by_level',15 + (int)$skl['picktimedif']);
}

if ($item['itembreak_tokens']) {$hasbuffs = true;}
foreach ($item as $key => $val) {
	if (strstr($key, 'gather_') && $val) {$hasbuffs = true;}
	if (strstr($key, 'shorten_') && $val) {$hasbuffs = true;}
}

$report = $balancer->BalanceReport();

if ($hasbuffs && $item['skillgrant'] == '') {
	$report[] = array('title'=>'skillgrant','result'=>'passive');
}


// PRODUCTION COST

$cost = explode(',', $item['craft_ingredients']);

$findingbulk = 0;
foreach ((array)$cost as $req) {
	if ($req == '') {continue;}
	
	if (strstr($req, ':')) {
		$bits = explode(':',$req);
		$req = array();
		$req['item'] = trim($bits[0]);
		$req['cost'] = (int)$bits[1];
	} else {
		$bit = $req;
		$req = array();
		$req['item'] = trim($bit);
		$req['cost'] = 1;
	}
	
	$ingdata = $itembank[$req['item']];
	$findingbulk += ($ingdata['finding_time']+$ingdata['production_time']) * $req['cost'];
	
}

if ($findingbulk > 0) {
	$metalevel = $findingbulk / 400;
	$report[] = array('title'=>'itemlevel','result'=>ceil($metalevel));
	$report[] = array('title'=>'production_time','result'=>floor($findingbulk));
}


echo '<b>'.$item['name'].'</b><br>';
// RARE DROPS

if ($item['finding_raredrop']) {
	$dropitem = mysql_fetch_assoc(mysql_query('SELECT * FROM `merch_items` WHERE itemkey = "'.$item['finding_raredrop'].'"'));
	$dropchance = ($item['finding_action_dropchance']/100)+0.05;
	$drop = $item['finding_time']/$dropchance;
	echo 'Rare drop time: '.timeFormulate($drop);
	mysql_query('UPDATE merch_items SET production_time = '.(int)$drop.' WHERE itemkey = "'.$item['finding_raredrop'].'"');
	
}

// ECHOING

if ($findingbulk) {
	echo 'Ings takes time to find : '.timeFormulate($findingbulk);
}

foreach ($report as $crit) {
	$htmlextra = '';
	if ($crit['result'] != $item[$crit['title']]) {$htmlextra = ' style="color:orange;font-weight:bold;cursor:pointer" onClick=\'assistFill("'.$crit['title'].'","'.$crit['result'].'")\' ';}

	echo '<div '.$htmlextra.'>'.$crit['title'].': '.($htmlextra ? $item[$crit['title']].' >> ' : '').$crit['result'].'</div>';
}

?>