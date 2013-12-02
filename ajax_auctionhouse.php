<?
	session_start();

include('../config.php');
include('databanks/items.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
$time = date('U');

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


echo 'Auction house coming here sometime soon';

echo javaCheck();

?>