<?

session_start();

include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('databanks/items.php');
include('modules/db_backup.php');
include('modules/minions.php');

$_SESSION['spotlightGoon'] = $_GET['minion'];
	$g = $_SESSION['game_variables'];

if ($_GET['uitem']) {
	removeWornItem($_GET['uitem'],$_GET['minion']);
	$_SESSION['game_variables'] = $g;
}

if ($_GET['item']) {
	wearItem($_GET['item'],$_GET['minion']);
	$_SESSION['game_variables'] = $g;
}

unset($_SESSION['goongearReload']);


include('panel_goongear.php');

echo $goongear['html'];



?>