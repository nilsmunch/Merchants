<?

session_start();
include('../config.php');
//db_connect();
include('databanks/items.php');
include('databanks/passive_skills.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/db_backup.php');
$g = $_SESSION['game_variables'];

include('seasonal/xmas.php');

include('panel_inventory.php');


echo $inventorywindow['html'];
?>