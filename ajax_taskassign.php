<?

session_start();


include('../config.php');

include('databanks/skills.php');
include('databanks/items.php');
include('modules/minions.php');
include('databanks/actions.php');
include('databanks/formulations.php');

include('modules/inventoryitems.php');
include('modules/inventoryicons.php');

$g = $_SESSION['game_variables'];

$pit = $_GET['target'];
	$min = $g['minions'][$pit];

	




if (!$g['inventory']) {$g['inventory'] = array();}


if (!$min['currentAction']) {

	minionBoosts($g['minions'][$pit]);

}


echo '<div style="background-color:rgba(0,0,0,0.9);position:fixed;left:0px;right:0px;top:0px;bottom:0px;text-align:center;z-index:20;color:white">';

$gatheractionlist = gatheringSkillList($g['minions'][$pit]);
//print_r($gatherTargets);

echo '<div style="margin-top:20px;padding:2px;font-size:20px;font-weight:bold">Pick gathering target:</div>';

foreach ($gatherTargets as $itemkey) {
	$itemdata = $itembank[$itemkey];
	echo '<a href="#" style="position:relative" onclick="openTaskassign(\''.$itemkey.'\','.$pit.')">'.itemIcon($itemdata,'border:2px solid '.($_GET['action'] == $itemkey ? 'goldenrod': 'black'),64,true).'</a>';
}


if ($_GET['action'] != 'list') {
	$optionbar = $gatheractionlist[$_GET['action']];
}

if ($optionbar) {
echo '<div style="margin-top:20px;padding:2px;font-size:20px;font-weight:bold">Pick location:</div>';
echo '<div class="taskpicker">'.$optionbar.'</div>';
}

echo '<a href="#" class="btn" onClick="showView(\'#result\')" style="clear:both;display:block;color:white;font-weight:bold;text-decoration:none;">Back to servants</a>';
echo '</div>';


?>