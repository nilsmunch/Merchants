<?
$hiddenview = true;
session_start();

$_SESSION['collect'][$_GET['type'].$_GET['minion']] = true;

include('game.php');

	unset($_SESSION['goongearReload']);
unset($_SESSION['mainscreenReload']);
				unset($_SESSION['inventoryReload']);
unset($_SESSION['achievementsReload']);

?>