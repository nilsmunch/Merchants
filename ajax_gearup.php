<?

session_start();

include('modules/inventoryitems.php');
include('databanks/items.php');

$_SESSION['spotlightGoon'] = $_GET['minion'];

if ($_GET['uitem']) {
	$g = $_SESSION['game_variables'];
	removeWornItem($_GET['uitem'],$_GET['minion']);
	$_SESSION['game_variables'] = $g;
}

if ($_GET['item']) {
	$g = $_SESSION['game_variables'];
	wearItem($_GET['item'],$_GET['minion']);
	$_SESSION['game_variables'] = $g;
}

	unset($_SESSION['goongearReload']);

?>