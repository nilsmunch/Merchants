<?

	session_start();

include('databanks/skills.php');
include('databanks/items.php');
include('modules/minions.php');
include('databanks/actions.php');
include('databanks/formulations.php');

include('modules/inventoryitems.php');
include('modules/inventoryicons.php');

	$g = $_SESSION['game_variables'];


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
foreach ($g['minions'] as $pit => $min) {
	$slot = 0;
	while ($slot < $min['slots']) {
		if ($min['items'][$slot]) {
			$itemdata = $itembank[$min['items'][$slot]];
			if ($itemdata['skillgrant']) {
				$assistants[$itemdata['skillgrant']][] = $pit;
			}
		} else {
			$minionitems .= ' '.itemIcon(array());	
		}
		$slot++;
	}

}

// RECIPES

foreach ($actionbank as $key => $opt) {
	if ($opt['itemgain']) {
	$taskbox = '';
	$bring = false;
	$ing = '';
	$inglist = '';
	if ($opt['requirements']) {
		foreach ($opt['requirements'] as $req) {
			if ($req['type']=='itemqty') {
				$count = 1;
				$ingdata = $itembank[$req['item']];
				$hasqty = $g['inventory'][$req['item']];
				while ($count <= $req['cost']) {
					$inglist .= itemIcon($ingdata,'border:2px solid '.($hasqty >= $count ? 'green':'red'),40);
					if (!($hasqty >= $count)) {
						$bring = 'res';
					}
					$count ++;
				}
			}
		}
	}
	$details = '';
	$itemdata = $itembank[$opt['itemgain']];


$needs_recipe = false;
if ($itemdata['craft_recipekey']) {
	if (!$g['lifetime']['recipes_read'][$itemdata['craft_recipekey']]) {
		$needs_recipe = true;
	}
}

//if ($needs_recipe) {$taskbox = '<tr><td colspan=3 style="background-color:grey;padding:3px;">You have not read '.$itemdata['name'].' recipe';}

if (!$needs_recipe) {
$taskbox = itemIcon($itemdata).'<td valign=top style="padding:3px;background-color:black;color:white">'.$itemdata['name'].showItemBox($opt['itemgain'],1,'description').'<td>'.$inglist;
	
$taskbox .= '<td>';


foreach ((array)$assistants[$opt['gearneed']] as $ass) {
	$min = $g['minions'][$ass];
	minionBoosts($min);
	$timevar = minionTaskTime($opt);
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

	$taskbox = '<tr><td width=10>'.$taskbox;
}


	$page[$opt['gearneed']] .= $taskbox;
}
}









echo '<table cellspacing=0 cellpadding=0 width=100%><tr><td width=100 valign=top>';
ksort($skillbank);
foreach ($skillbank as $skillkey => $skill) {
if ($skill['craftskill']) {
shopTap($skillkey);}
}
echo '<td style="background-color:#2d2800" valign=top><table cellspacing=0 cellpadding=0 width=100% style="margin:4px;">'.$page[$thisshop].'</table>';
echo '</table>';
?>