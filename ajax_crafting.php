<?

session_start();
include('../config.php');

include('databanks/skills.php');
include('databanks/items.php');
include('modules/skills.php');
include('modules/minions.php');
include('databanks/actions.php');
include('databanks/formulations.php');

include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/tasks.php');

	$g = $_SESSION['game_variables'];
	
$bonuses = countPlayerSkills();



if ($_GET['action'] == 'craftings') {
	$_SESSION['craftarea'] = $_GET['target'];
}

$thisshop = $_SESSION['craftarea'];
if (!$thisshop) {$thisshop = 'cooking';}

function shopTap($shop) {
	global $thisshop;
	echo '<a href="#" style="margin:0px" onClick="openCrafting(\'craftings\',\''.$shop.'\')"><img style="border:0px;height:32px;width:186px;margin:0px;display:block;" src="/media/crafts/craft_'.$shop.'_'.($shop == $thisshop ? 'on':'off').'.png"></a>';
}

// MINIONS


	$assistants = array();
foreach ((array)$g['minions'] as $pit => $min) {
	$slot = 0;
	foreach ((array)$min['items'] as $key) {
		if (strstr($key,':')) {
			$itmbits = explode(':',$key); $key = $itmbits[0];
			}
			$itemdata = $itembank[$key];
			if ($itemdata['skillgrant']) {
				$assistants[$itemdata['skillgrant']][] = $pit;
			}
	}

}
unset($assistants['passive']);

// RECIPES


array_sort($actionbank,'time');
$actionbank = array_reverse($actionbank);
$recipesstored=0;
foreach ($actionbank as $key => $opt) {
	if ($opt['gearneed'] != $thisshop) {continue;}
	if ($opt['itemgain']) {
	$taskbox = '';
	$bring = false;
	$ing = '';
	$inglist = '';
	if ($opt['requirements']) {
		$inglist .= costBox($opt['requirements']);
	}
		$inglist .= ' <font style="font-size: 12px;color:white;background-color:rgba(0,0,0,0.4);padding:4px;position:absolute;bottom:0px;right:0px">'.timeFormulate($opt['time']).'</font>';
	$details = '';
	$itemdata = $itembank[$opt['itemgain']];


$needs_recipe = false;
if ($opt['craft_recipekey']) {
	if (!$g['lifetime']['recipes_read'][$opt['craft_recipekey']]) {
		$recipesstored++;
		$needs_recipe = true;
	}
}


if (isAdmin()) {$needs_recipe = false;}

//if ($needs_recipe) {$taskbox = '<tr><td colspan=3 style="background-color:grey;padding:3px;">You have not read '.$itemdata['name'].' recipe';}

if (!$needs_recipe) {

$craftlevel = $opt['craftlevel'];

$detailtext = '';
if ($opt['optimized']) {$detailtext = '<div class="itembonus" style="color:cyan !important">Optimized : '.$opt['optimized'].'% less materials needed</div>';}

$taskbox = itemIcon($itemdata).'<td valign=top style="padding:3px;background-color:black;color:white" width=250>'.showItemBox($opt['itemgain'],$opt['qty'],'short').$detailtext.'<td width=40% style="position:relative;padding-left:3px;" class="ingbox">'.$inglist.'';
	
$taskbox .= '<td style="text-align:right" width=200>';


if (($bonuses['skillup_'.$opt['gearneed']]+1) < $craftlevel) {
	unset($assistants[$opt['gearneed']]);
}

foreach ((array)$assistants[$opt['gearneed']] as $ass) {
	$min = $g['minions'][$ass];
	minionBoosts($min);
	$timevar = minionTaskTime($opt);
	$assbox = '';
if (!$bring) {
	$assbox = '<a href="#" style="display:block;font-weight:bold;color:white;text-decoration:none" onClick="performAct('.(int)$ass.',\''.$key.'\');showView(\'#result\');">Assign '.$min['name'].'</a>'.$timevar['labels'];
} else {
	$assbox = '<a href="#" style="display:block;font-weight:bold;color:red;text-decoration:none">Assign '.$min['name'].'</a>'.$timevar['labels'];
}
if ($min['currentAction']) {
	$assbox = '<a href="#" style="display:block;font-weight:bold;color:grey;text-decoration:none">Assign '.$min['name'].' (busy)</a>';
}
 

	$taskbox .= $assbox;
}

if (($bonuses['skillup_'.$opt['gearneed']]+1) < $craftlevel) {$taskbox .= '<div class="itembonus" style="color:gray">Not high enough skill level for this craft.</div>';} else {

if (count($assistants[$opt['gearneed']]) == 0) {$taskbox .= '<div class="itembonus" style="color:gray">You have no servants with <br>the proper tools for this craft.</div>';}
}

	$taskbox = '<tr><td width=10 style="background-color:black;" valign=top>'.$taskbox;
}

if (!$mentioned[$opt['gearneed']][$craftlevel] && $craftlevel) {
$page[$opt['gearneed']] .= '<tr><th colspan=4 class="craftlevel">Level '.$craftlevel;
$mentioned[$opt['gearneed']][$craftlevel] = true;
}

	$page[$opt['gearneed']] .= $taskbox;
}
}









echo '<table cellspacing=0 cellpadding=0 width=100% style="padding:4px;"><tr><td width=100 valign=top>';
ksort($skillbank);
foreach ($skillbank as $skillkey => $skill) {
if ($skill['craftskill']) {
shopTap($skillkey);}
}
echo '<td style="background-color:#2d2800;padding:4px;" valign=top><table cellspacing=0 cellpadding=0 width=100%>'.$page[$thisshop].'</table>';
echo '</table>';
if ($recipesstored) {
echo '<div style="text-align:center;">There are still '.$recipesstored.' '.$skillbank[$thisshop]['name'].' recipes left for you to collect...</div>';
}

?>