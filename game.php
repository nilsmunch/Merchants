<?php
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

if ($_GET['flush']) {
$_SESSION['optionBarReload'] = false;
$_SESSION['inventoryReload'] = false;
$_SESSION['achievementsReload'] = false;

}
include('../config.php');

$g = $_SESSION['game_variables'];

include('databanks/items.php');
include('databanks/actions.php');
include('databanks/formulations.php');
include('databanks/skills.php');

echo "retry: 1000\n\n";

$time = date('U');


include('modules/db_backup.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/minions.php');


include('process_miniontasks.php');

include('panel_hirelings.php');
include('panel_achievements.php');
// Saving

db_saveUserCheck();

// Printing

if ((int)$_SESSION['mainscreenReload'] < 2) {
echo 'event: message'."\n";
unset($response['feedback']);
echo 'data: '.json_encode($response)."\n\n";
$_SESSION['mainscreenReload'] += 1;
}

if (!$_SESSION['optionBarReload']) {
echo 'event: optionbar'."\n";
echo 'data: '.json_encode($optionbar)."\n\n";
$_SESSION['optionBarReload'] = true;
}

if (!$_SESSION['achievementsReload']) {
echo 'event: achievements'."\n";
unset($achievementWindow['html']);
echo 'data: '.json_encode($achievementWindow)."\n\n";
$_SESSION['achievementsReload'] = true;
}

$_SESSION['game_variables'] = $g;

flush();
?>