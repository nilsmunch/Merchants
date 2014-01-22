<?
session_start();
$g = $_SESSION['game_variables'];

$userdata = $_SESSION['userdata'];
$fb = $userdata['fb_id'];
	
include('../config.php');
include('databanks/items.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
$time = date('U');

$actionsdisplay = array();
db_connect();

if ($_GET['action'] == 'filter') {
	$_SESSION['ahfilter'] = $_GET['target'];
}

if ($_GET['action'] == 'sellperform') {
	$sellvalue = (int)$_GET['target'];
	$buyoutvalue = (int)$_GET['detail'];
	$qty = (int)$_GET['secondary'];
	$currency = $_GET['currency'];
	if (!$currency) {$currency = 'gold';}
	if (!$qty) {$qty = 1;}
	
	$itemkey = $_SESSION['auctionitem'];
	$itemdata = $itembank[$itemkey];
	
	if ($sellvalue == 0 && $buyoutvalue == 0) {die('You can\'t set zero as minimum bid and buyout value');}
	
	$can = pricecheck($itemkey,$qty,true);
	if ($can) {
		mysql_query('INSERT INTO merch_auctions (seller_id,item_key,expiration_time,buyoutvalue,quantity,currency) VALUES ('.(int)$fb.',"'.$itemkey.'",0,'.$buyoutvalue.','.$qty.',"'.$currency.'")');
	} else {
		die('You do not have the requested items!');
	}
	
	$_SESSION['game_variables'] = $g;
	$goodnews = 'The item has been added to the auction house';
}

if ($_GET['action'] == 'sellitem') {
	$itemkey = $_GET['target'];
	$_SESSION['auctionitem'] = $itemkey;
	$pick = $itembank[$itemkey];
	echo '<h2>The item you wish to sell:</h2>';
	echo showItemBox($pick,1,'');
	echo '<h2>Bidding and buying</h2>';
	echo 'Minimum bid (Coming soon): <input id="sellprice" disabled value="0">';
	echo 'Buyout: <input id="buyout" value="0">';
	echo '<br>Bulk: <select name="bulk" id="bulk">';
	echo '<option value="1">1</option>';
	echo '<option value="5">5</option>';
	echo '<option value="10">10</option>';
	echo '<option value="50">50</option>';
	echo '<option value="100">100</option>';
	echo '<option value="250">250</option>';
	echo '<option value="1000">1000</option>';
	echo '</select>';
	
	
	echo '<br>Currency: <select name="currency" id="currency">';
	echo '<option value="gold" selected>Gold coins</option>';
	
	$currencyoption = array();
foreach ((array)$itembank as $key => $itemdata) {
	if (!$itemdata['needed'] && $itemdata['itemclass'] != 'currency') {continue;}
	if ($key == 'gold') {continue;}
	$currencyoption[$key] = $itemdata['name'];
}

asort($currencyoption);

foreach ((array)$currencyoption as $key => $bit) {
	$itemdata = $itembank[$key];
	echo '<option value="'.$key.'">'.$itemdata['name'].'</option>';
}
	
	echo '</select>';
	
	
	echo '<a href="#" class="btn" onclick="auctionhouseAction(\'sellperform\',$(\'#sellprice\').val(),$(\'#buyout\').val(),$(\'#bulk option:selected\').val(),$(\'#currency option:selected\').val());">Put item on auction house</a>';
	die();
}




if ($_GET['action']=='sell') {

foreach ((array)$g['inventory'] as $item => $qty) {
	$picker = '<a href="#" onclick="auctionhouseAction(\'sellitem\',\''.$item.'\');">Pick</a>';
	echo showItemBox($item,$qty,$picker);
}

die();}

if ($_GET['action']=='buyoutitem') {

$focusauction = mysql_fetch_assoc(mysql_query('SELECT * FROM merch_auctions WHERE sold = 0 AND id = '.(int)$_GET['target'].' limit 1'));

	if (!$focusauction) {die('Too late.');}
	$can = pricecheck($focusauction['currency'],$focusauction['buyoutvalue'],true);
	if (isAdmin()) {$can = true;}
	if ($can) {
		$qty = (int)$focusauction['quantity'];
		if (!$qty) {$qty = 1;}
		addToInventory($focusauction['item_key'],$qty);
		mysql_query('UPDATE merch_auctions SET sold = 1, bidvalue = buyoutvalue, latestbidder = "'.(int)$fb.'" WHERE id = '.(int)$_GET['target'].' limit 1');
	} else {
		die('You can not afford this');
	}
	$_SESSION['game_variables'] = $g;
}


$soldQ = mysql_query('SELECT * FROM merch_auctions WHERE sold = 1 AND seller_id = "'.(int)$fb.'" limit 10');

while ($sold = mysql_fetch_assoc($soldQ)) {
	$sold ++;
	$goodnews .= '<div>You have sold an item for '.$sold['bidvalue'].' '.$sold['currency'].'</div>';
	addToInventory($sold['currency'],$sold['bidvalue']);
	mysql_query('DELETE FROM merch_auctions WHERE id = '.(int)$sold['id'].' limit 1');
	$_SESSION['game_variables'] = $g;
}

$filters = array('all','resources','tools','accessories');
if (!$_SESSION['ahfilter']) {$_SESSION['ahfilter'] = 'all';}

foreach ($filters as $filt) {
	echo '<a href="#" class="ahfilter '.($filt == $_SESSION['ahfilter'] ? 'active':'').'" onclick="auctionhouseAction(\'filter\',\''.$filt.'\');">'.ucwords($filt).'</a> ';
}


$q_filters = '';

if ($_SESSION['ahfilter'] == 'resources') { $q_filters = ' AND itm.skillgrant = "" ';}
if ($_SESSION['ahfilter'] == 'tools') { $q_filters = ' AND itm.skillgrant != "" AND itm.skillgrant != "passive" ';}
if ($_SESSION['ahfilter'] == 'accessories') { $q_filters = ' AND itm.skillgrant = "passive" ';}


$latestQ = mysql_query('SELECT ac.id,item_key,buyoutvalue,quantity,fb_id,playername,currency FROM merch_auctions ac 
LEFT JOIN merch_players pl ON pl.fb_id = ac.seller_id 
LEFT JOIN merch_items itm ON itm.itemkey = ac.item_key
WHERE sold = 0 AND buyoutvalue > 0 '.$q_filters.' limit 100') or die(mysql_error());

while ($latest = mysql_fetch_assoc($latestQ)) {
	$actionsdisplay[] = $latest;
}

if ($goodnews) {
echo '<div style="text-align:center;padding:10px;">'.$goodnews.'</div>';
}

$badnews = 'Please note that this auction house is still under some heavy construction...';

if ($badnews) {
//echo '<div style="text-align:center;padding:10px;">'.$badnews.'</div>';
}

echo '<table width=100% class="list" cellspacing=0 cellpadding=0 style="background-color:black;padding:1px;">';
foreach ($actionsdisplay as $auction) {
	$itemkey = $auction['item_key'];
	$itemdata = $itembank[$itemkey];
	echo '<tr><td valign=top width=10 style="padding:0px">'.itemIcon($itemdata,'',46,false,$auction['quantity']);
	
	echo '<td valign=top style="color:white">'.$itemdata['name'];
	echo '<td valign=top style="color:white">'.showItemBox($itemkey,1,'description');
	
	$namebits = explode(' ', $auction['playername']);
	echo '<td valign=top style="color:white"><img src="https://graph.facebook.com/'.$auction['fb_id'].'/picture" style="height:30px;width:30px;border:1px solid black;"> '.$namebits[0];
	
	$curr = ''.$auction['buyoutvalue'].' &curren;';
	
	if ($auction['currency'] != 'gold') {
		$currdata = $itembank[$auction['currency']];
		$curr = itemIcon($currdata,'vertical-align:middle',40,false,$auction['buyoutvalue']);
	}
	
	echo '<td valign=top style="text-align:right"><a href="#" onclick="auctionhouseAction(\'buyoutitem\','.$auction['id'].');">Buyout '.$curr.'</a>';
}
echo '</table>';

echo '<a href="#" class="btn" onclick="auctionhouseAction(\'\');" style="float:right;margin-top:0px !important">Refresh</a>';


$slotcount = mysql_fetch_assoc(mysql_query('SELECT count(*) as numb FROM merch_auctions WHERE sold = 0 AND seller_id = "'.(int)$fb.'"'));
$forsale = $slotcount['numb'];
$bonuses = countPlayerSkills();

$slots = 1+$bonuses['ah_slots'];
if ($forsale < $slots) {
	echo '<a href="#" class="btn" onclick="auctionhouseAction(\'sell\');">Sell items</a> ('.$forsale.' of '.$slots.' slots used)';
} else {
	echo 'Can\'t post any more items ('.$forsale.' of '.$slots.' slots used)';
}


echo javaCheck();

?>