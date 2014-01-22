<?
include('../config.php');

include('databanks/items.php');
include('databanks/actions.php');
include('databanks/formulations.php');
include('databanks/skills.php');

include('modules/db_backup.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/minions.php');


$time = date('U');

$hiddenview = true;
session_start();

$g = $_SESSION['game_variables'];

include('databanks/items.php');
include('databanks/actions.php');
include('databanks/formulations.php');
include('databanks/skills.php');
$_SESSION['collect'][$_GET['type'].$_GET['minion']] = true;

include('process_miniontasks.php');
include('panel_hirelings.php');
echo ($response['feedback']);

echo db_saveUserCheck();

?>