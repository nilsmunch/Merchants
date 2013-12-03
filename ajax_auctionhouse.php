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

/*
if ($_GET['action'] == 'buy') {
	$itemkey = $_GET['target'];
	$pick = $itembank[$itemkey];

	$can = pricecheck('gold',$pick['market_price'],true);

	if ($pick['market_price_favorcoin']) {
		$can = pricecheck('favor_coin',$pick['market_price_favorcoin'],true);
	}
	
	if ($pick['market_price_yulecoin']) {
		$can = pricecheck('yulecoin',$pick['market_price_yulecoin'],true);
	}
	
	if (isset($g['market_outlet'][$itemkey]['quantity'])) {
		$g['market_outlet'][$itemkey]['quantity']--;
	}

	if ($can) {
		addToInventory($itemkey);
		$notif = 'Purchase complete! Thank you for your patronage.';
		unset($_SESSION['market']);
	} else {
		$notif = 'You can not afford this item!';
}
	$_SESSION['game_variables'] = $g;
}
*/

$actionsdisplay = array();
db_connect();

if ($_GET['action'] == 'sellperform') {
	$sellvalue = (int)$_GET['target'];
	$buyoutvalue = (int)$_GET['detail'];
	
	$itemkey = $_SESSION['auctionitem'];
	$itemdata = $itembank[$itemkey];
	
	if ($sellvalue == 0 && $buyoutvalue == 0) {die('You can\'t set zero as minimum bid and buyout value');}
	
	$can = pricecheck($itemkey,1,true);
	if ($can) {
		mysql_query('INSERT INTO merch_auctions (seller_id,item_key,expiration_time,buyoutvalue) VALUES ('.(int)$fb.',"'.$itemkey.'",0,'.$buyoutvalue.')');
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
	echo showItemBox($pick,1,'');
	
	echo 'Minimum bid : <input id="sellprice" disabled value="0">';
	echo 'Buyout (optional) : <input id="buyout" value="0">';
	echo '<a href="#" onclick="auctionhouseAction(\'sellperform\',$(\'#sellprice\').val(),$(\'#buyout\').val());">Sell</a>';
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
	$can = pricecheck('gold',$focusauction['buyoutvalue'],true);
	if ($can) {
		addToInventory($focusauction['item_key']);
		mysql_query('UPDATE merch_auctions SET sold = 1, bidvalue = buyoutvalue, latestbidder = "'.(int)$fb.'" WHERE id = '.(int)$_GET['target'].' limit 1');
	} else {
		die('You can not afford this');
	}
	$_SESSION['game_variables'] = $g;
}


$soldQ = mysql_query('SELECT * FROM merch_auctions WHERE sold = 1 AND seller_id = "'.(int)$fb.'" limit 10');

while ($sold = mysql_fetch_assoc($soldQ)) {
	$sold ++;
	$goodnews .= '<div>You have sold an item for '.$sold['bidvalue'].'</div>';
	addToInventory('gold',$sold['bidvalue']);
	mysql_query('DELETE FROM merch_auctions WHERE id = '.(int)$sold['id'].' limit 1');
	$_SESSION['game_variables'] = $g;
}


$latestQ = mysql_query('SELECT * FROM merch_auctions ac LEFT JOIN merch_players pl ON pl.fb_id = ac.seller_id WHERE sold = 0 AND buyoutvalue > 0 limit 10');

while ($latest = mysql_fetch_assoc($latestQ)) {
	$actionsdisplay[] = $latest;
}

if ($goodnews) {
echo '<div style="text-align:center;padding:10px;">'.$goodnews.'</div>';
}

$badnews = 'Please note that this auction house is still under some heavy construction...';

if ($badnews) {
echo '<div style="text-align:center;padding:10px;">'.$badnews.'</div>';
}

echo '<table width=100% style="background-color:black;padding:3px;margin-bottom:20px;">';
foreach ($actionsdisplay as $auction) {
	$itemkey = $auction['item_key'];
	$itemdata = $itembank[$itemkey];
	echo '<tr><td valign=top width=10>'.itemIcon($itemdata);
	
	echo '<td valign=top style="color:white">'.$itemdata['name'].showItemBox($itemkey,1,'description');
	
	echo '<td valign=top style="color:white"><img src="https://graph.facebook.com/'.$auction['fb_id'].'/picture" style="height:30px;width:30px;border:1px solid black;"> '.$auction['playername'];
	
	echo '<td valign=top><a href="#" style="color:orange;font-weight:bold" onclick="auctionhouseAction(\'buyoutitem\','.$auction['id'].');">Buyout item ('.$auction['buyoutvalue'].' &curren;)</a>';
}
echo '</table>&nbsp;<br>';


$slotcount = mysql_fetch_assoc(mysql_query('SELECT count(*) as numb FROM merch_auctions WHERE sold = 0 AND seller_id = "'.(int)$fb.'"'));
$forsale = $slotcount['numb'];
$bonuses = countPlayerSkills();

$slots = 1+$bonuses['ah_slots'];
if ($forsale < $slots) {
echo '<a href="#" onclick="auctionhouseAction(\'sell\');">Sell items</a> ('.$forsale.' of '.$slots.' slots used)';
} else {

echo 'Can\'t post any more items ('.$forsale.' of '.$slots.' slots used)';
}


echo javaCheck();

?>