<?
$hiddenview = true;
session_start();

$_SESSION['collect'][$_GET['type'].$_GET['minion']] = true;

include('game.php');


$_SESSION['seen'.$_GET['minion']] = false;

	unset($_SESSION['goongearReload']);
unset($_SESSION['mainscreenReload']);
				unset($_SESSION['inventoryReload']);
unset($_SESSION['achievementsReload']);

?>