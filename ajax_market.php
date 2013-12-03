<?
	session_start();

include('../config.php');
include('databanks/items.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
$time = date('U');
$marketRespawn = 60*60*1;

function processMultiplier($itemkey) {
	global $itemdata;
	$multi = (int)$_SESSION['marketmultiplier_'.$itemkey];
	if (!$multi) {$multi = 1;}
	$itemdata['cityasking_gold'] = ($itemdata['cityasking_gold'] * $multi) + $multi;
	$itemdata['cityasking_qty'] = $itemdata['cityasking_qty'] * $multi;
}

// SUPPLY AND DEMAND
$g = $_SESSION['game_variables'];

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


if ($_GET['action'] == 'sell') {
	$itemkey = $_GET['target'];
	$itemdata = $itembank[$itemkey];
	processMultiplier($itemkey);
	$can = pricecheck($itemkey,$itemdata['cityasking_qty'],true);
	if ($can) {
		addToInventory('gold',$itemdata['cityasking_gold']);
		$notif = 'Transaction complete! Hope to do business with you in the future.';
		unset($_SESSION['market_demand']);
	} else {
		$notif = 'You do not have the requested items!';
	}
	$_SESSION['game_variables'] = $g;
}

if ($_GET['action'] == 'market') {
	$_SESSION['marketshop'] = $_GET['target'];
}

$thisshop = $_SESSION['marketshop'];
if (!$thisshop) {$thisshop = 'demand';}

function shopTap($shop) {
	global $thisshop;
	$shopimage = 'media/shops/shoptab_'.$shop.'_'.($shop == $thisshop ? 'on':'off').'.png';
	if (!file_exists($shopimage)) {$shopimage = $shop;
	
	echo '<a href="#" style="position:relative;top:0px;" onClick="marketAction(\'market\',\''.$shop.'\')">'.$shopimage.'</a> &nbsp; ';
	return;
	} else {
	$shopimage = '<img style="border:0px;height:145px;width:63px;" src="/'.$shopimage.'">';
	}
	echo '<a href="#" style="position:relative;top:'.($shop == $thisshop ? '0':'-38').'px;" onClick="marketAction(\'market\',\''.$shop.'\')">'.$shopimage.'</a>';
}

echo '<div style="clear:both;position:absolute;top:-1px;">';
shopTap('demand');
shopTap('tool');
shopTap('favor');
shopTap('random');
shopTap('yule');
shopTap('outlet');
echo '</div>';
	echo '<div style="clear:both;height:120px;">&nbsp;</div>';



if ($notif) {
	echo '<div style="clear:both;text-align:center">'.$notif.'</div>';
}

// market demands 
if ($thisshop == 'demand') {
	echo '<h2>City requests :</h2>';

$marketdemand = $_SESSION['market_demand'];

if (!$marketdemand) {
	$tombola = array_keys($itembank);
	while (count($marketdemand) < 9) {
		shuffle($tombola);
		$pick = $itembank[$tombola[0]];
		if (!$pick['cityasking_gold']) {unset($pick);}
		if (in_array($tombola[0],(array)$marketdemand)) {unset($pick);}
		if ($pick) {
			$marketdemand[] = $tombola[0];
			$_SESSION['marketmultiplier_'.$tombola[0]] = rand(1,25);
		}
	}
	$_SESSION['market_demand'] = $marketdemand;
}
if ($notif) {
	echo '<div style="clear:both;text-align:center">'.$notif.'</div>';
	unset($notif);
}

$demands = '';
foreach ((array)$marketdemand as $itm) {
	$itemdata = $itembank[$itm];
	processMultiplier($itm);
	$demands .= showItemBox($itm,$itemdata['cityasking_qty'],'<a href="#" onClick="marketAction(\'sell\',\''.$itm.'\')">Sell ('.$itemdata['cityasking_gold'].'&curren;)</a> You have : '.(int)$g['inventory'][$itm]);
}

echo $demands;
}


/// OUTLET STORE
if ($thisshop == 'outlet') {
	$toolstore = array();
	foreach ($itembank as $itemkey => $item) {
		if ($item['storekey'] == $thisshop && $item['market_outlet_qty']) {
			$outletstore[$itemkey] = $item;
		}
	}



	echo '<h2>City common outlet :</h2>';

foreach ((array)$outletstore as $itmkey => $itemdata) {
	$respawn = $g['market_outlet'][$itmkey]['respawn'];
	$item_respawn = ($respawn-$time)<=0;
	if (!isset($g['market_outlet'][$itmkey]['quantity']) || $item_respawn) {
		$g['market_outlet'][$itmkey]['quantity'] = $itemdata['market_outlet_qty'];
		$g['market_outlet'][$itmkey]['respawn'] = date('U') + $marketRespawn;
		$_SESSION['game_variables'] = $g;
	}

	$extra = timeFormulate($respawn-$time);
	
	if ($g['market_outlet'][$itmkey]['quantity'] > 0) {
		$extra = '<a href="#" onClick="marketAction(\'buy\',\''.$itmkey.'\')">Buy ('.$itemdata['market_price'].'&curren;)</a> '.$g['market_outlet'][$itmkey]['quantity'].' left';
	}
	
	$offers .= showItemBox($itemdata,0,$extra);
}
echo $offers;

	
	
	
}

/// FAVOR STORE
if ($thisshop == 'favor') {
	$toolstore = array();
	foreach ($itembank as $itemkey => $item) {
		if ($item['market_price_favorcoin'] > 0) {
			$toolstore[] = $itemkey;
		}
	}

	echo '<h2>The House of Raydor Quatermaster :</h2>';

foreach ((array)$toolstore as $itm) {
	$itemdata = $itembank[$itm];
	$offers .= showItemBox($itm,0,'<a href="#" onClick="marketAction(\'buy\',\''.$itm.'\')">Buy ('.$itemdata['market_price_favorcoin'].' x Coin of Favor)</a>');
}
echo $offers;

}

/// TOOL STORE
if (in_array($thisshop, array('tool','yule'))) {
	$toolstore = array();
	foreach ($itembank as $itemkey => $item) {
		if ($item['storekey'] == $thisshop) {
			$toolstore[$itemkey] = $item;
		}
	}

	$storename['tool'] = 'General tools warehouse';
	$storename['yule'] = 'Yuletide special store';

	echo '<h2>'.$storename[$thisshop].' :</h2>';

foreach ((array)$toolstore as $itmkey => $itemdata) {
$extra = '<a href="#" onClick="marketAction(\'buy\',\''.$itmkey.'\')">Buy ('.$itemdata['market_price'].' &curren;)</a>';

if ($itemdata['market_price_favorcoin']) {
$extra = '<a href="#" onClick="marketAction(\'buy\',\''.$itmkey.'\')">Buy ('.$itemdata['market_price_favorcoin'].' x Coin of Favor)</a>';}

if ($itemdata['market_price_yulecoin']) {
$extra = '<a href="#" onClick="marketAction(\'buy\',\''.$itmkey.'\')">Buy ('.$itemdata['market_price_yulecoin'].' x Yuletide tokens)</a>';}

	$offers .= showItemBox($itemdata,0,$extra);
}
echo $offers;

}

/// RANDOM STORE
if ($thisshop == 'random') {

$marketselection = $_SESSION['market'];

if (!$marketselection) {
	$tombola = array_keys($itembank);
	while (count($marketselection) < 6) {
		shuffle($tombola);
		$pick = $itembank[$tombola[0]];
		if (!$pick['entrypoint_market']) {unset($pick);}
		if ($pick['market_price']==0) {unset($pick);}
		if ($pick['storekey'] == 'tool') {unset($pick);} 
		if (in_array($tombola[0],(array)$marketselection)) {unset($pick);}
		if ($pick) {
			$marketselection[] = $tombola[0];
		}
	}
	$_SESSION['market'] = $marketselection;
}

if ($notif) {
	echo '<div style="clear:both;text-align:center">'.$notif.'</div>';
}

	echo '<h2>Rayden\'s Randoms and Rares :</h2>';

foreach ((array)$marketselection as $itm) {
	$itemdata = $itembank[$itm];
	$offers .= showItemBox($itm,0,'<a href="#" onClick="marketAction(\'buy\',\''.$itm.'\')">Buy ('.$itemdata['market_price'].'&curren;)</a>');
}
echo $offers;

}
echo javaCheck();

?>