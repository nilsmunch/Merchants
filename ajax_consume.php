<?
include('databanks/items.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/experiencepoints.php');

$hiddenview = true;
session_start();

$item = $_GET['item'];
	$g = $_SESSION['game_variables'];
	$can = pricecheck($item,1,true);

if ($can) {
$itemdata = $itembank[$item];

if ($itemdata['itemclass']== 'cheese') {
		$g['lifetime']['tasted_cheeses'][$item] += 1;
$itemdata['itemclass'] = 'food';
}

if ($itemdata['itemclass']== 'recipe') {
		$g['lifetime']['recipes_read'][$item] += 1;
}



if ($itemdata['xp_points_gain']) {xp_gain($itemdata['xp_points_gain'],'consume_'.$itemdata['itemclass']);}
}

echo 'Consuming';


	$_SESSION['game_variables'] = $g;

	unset($_SESSION['goongearReload']);
unset($_SESSION['mainscreenReload']);
				unset($_SESSION['inventoryReload']);
unset($_SESSION['achievementsReload']);

echo javaCheck();

?>