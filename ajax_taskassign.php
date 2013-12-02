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
if ($_GET['action'] == 'list') {
	$min = $g['minions'][$pit];

	


	$skillset = array();
	while ($slot < $min['slots']) {
		if ($min['items'][$slot]) {
			$itemdata = $itembank[$min['items'][$slot]];
			$minionitems .= ' '.itemIcon($itemdata).'';	
			$skillset[$itemdata['skillgrant']] += 1;
		} else {
			$minionitems .= ' '.itemIcon(array());	
		}
		$slot++;
	}


if (!$g['inventory']) {$g['inventory'] = array();}


if (!$min['currentAction']) {

	minionBoosts($g['minions'][$pit]);

print_r($boosts);


foreach ($actionbank as $key => $opt) {
	$taskbox = '';
	$bring = 'true';
	$ing = '';
	$boost = 0;
	if ($opt['requirements']) {
		foreach ($opt['requirements'] as $req) {
			if ($req['type']=='courage') {
				if ((int)$boosts['courage'] < $req['value']) {
					$bring = 'cour';
					$ing .= '<div class="taskdetail negative">Needs '.$req['value'].' courage</div>';
				} else {
					$ing .= '<div class="taskdetail">Needs '.$req['value'].' courage</div>';}
			}
			if ($req['type']=='itemqty') {
				if ((int)$g['inventory'][$req['item']] < $req['cost'] || !$g['inventory'][$req['item']]) {
					$bring = 'res';
					$ing .= '<div class="taskdetail negative">Needs '.$req['cost'].' x '.$req['item'].'</div>';
				} else {
	
					$ing .= '<div class="taskdetail">Needs '.$req['cost'].' x '.$req['item'].'</div>';
				}
			}
		}
	}
	if (!$opt['qty']) {$opt['qty'] = 1;}
	$details = '';
	if ($opt['qty']) {
		
	$itemdata = $itembank[$opt['itemgain']];
	if (!$itemdata['name_plural']) {$itemdata['name_plural'] = $itemdata['name'].'s';}
	if ($opt['qty'] == 1) {$itemdata['name_plural'] = $itemdata['name'];}
	$opt['xp'] = gatherOutcome($opt['qty'],$opt['itemgain'],$opt['gearneed']);
	$details = 'Gain '.gatherOutcome($opt['qty'],$opt['itemgain'],$opt['gearneed'],true).' '.$itemdata['name_plural'];
	}
	$details .= ' <font style="color:#45c954;background-color:rgba(0,0,0,0.9);padding:4px;position:absolute;bottom:0px;right:0px">+ '.$opt['xp'].' XP</font>';

	if ($opt['special']) {
		$bring = false;
	}

	if (!$skillset[$opt['gearneed']]) {
		$bring = false;
	}

	if ($bring == 'true') {

		$timevar = minionTaskTime($opt);
		$taskbox .= '<a href="#" style="font-weight:bold" onClick="performAct('.(int)$pit.',\''.$key.'\');showView(\'#result\');">'.$opt['title'].'</a>'.$timevar['labels_box'].$ing;
	



	if ($details) {$taskbox .= '<div  class="taskdetail">'.$details.'</div>';	}
}
	if ($bring == 'res') {
		$timevar = minionTaskTime($opt);
		$taskbox .= '<a href="#">'.$opt['title'].' </a>'.$timevar['labels_box'].$ing;
	}
	if ($bring == 'cour') {
		$timevar = minionTaskTime($opt);
		$taskbox .= '<a href="#">'.$opt['title'].' </a>'.$timevar['labels_box'].($details ? '<div  class="taskdetail">'.$details.'</div>' :'').$ing;
	}
	if ($taskbox) {


		$taskart = $opt['taskart'];
		if (!$taskart) {$taskart = 'action_idle.png';}
		

		$taskbox = '<div style="text-align:center;margin-right: auto;position:relative;margin-left: auto;width:350px;border-top:2px solid black;height:100px;background-image:url(\'/media/actions/'.$taskart.'\')" class="actionslab"><span>'.$taskbox.'</span></div>';

if ($countup[$opt['gearneed']] >=4) {
	$optionbar[$opt['gearneed'].'_2'] .= $taskbox;} else {
	$optionbar[$opt['gearneed']] .= $taskbox;
}

$countup[$opt['gearneed']] += 1;
 	}
}

}
echo '<div style="background-color:rgba(0,0,0,0.9);position:fixed;left:0px;right:0px;top:0px;bottom:0px;text-align:center">';
echo '<table width=50% style="margin-right: auto;margin-left: auto;"><tr>';
foreach ((array)$optionbar as $barkey => $bar) {

if ($skillbank[$barkey]['craftskill']) {unset($bar);}

if ($bar) {
echo '<td valign=top width=50% align=center style="text-align:center;padding:10px;">';
echo '<div style="text-align:center;margin-right: auto;margin-left: auto;position:relative;width:350px;height:69px;background-image:url(\'/media/actions/actionhead_'.$barkey.'.png\')" class="actionslab">&nbsp;</div>';

echo $bar;
}
}
echo '</table>';

echo '<a href="#" onClick="showView(\'#result\')" style="clear:both;display:block;color:white;font-weight:bold;text-decoration:none;">Back to servants</a>';
echo '</div>';

}

?>