<?

if (!$g['minions']) {$g['minions'] = array(array('name'=>'NEW'));
include('databanks/actions.php');}

$g['minions']= array_values($g['minions']); 

if ($g['lifetime']['minions_hired'] < count($g['minions'])) {$g['lifetime']['minions_hired'] = count($g['minions']);}

$minionpage = '';

foreach ($g['minions'] as $pit => $min) {
	if ($min['name'] == '') {unset($g['minions'][$pit]);}
}

$randomnames = array('Gendry','Podrick','Illing','Lars','Sigrid','Ulfric','Bjorn','Davik','Aslak','Yshin','Thoras','Marya','Kensi','Morak','Anika','Jora');

$minionskills = array('skill_greenthumbs','skill_fisherman','skill_tailor','skill_precise','skill_arcanist','skill_crafty','skill_braveheart','skill_hawkeye','skill_earthsalt','skill_wildling','skill_scholar','skill_stout','skill_detail','skill_mason');

$minionpage .= '<div style="width:100%">';

		$debug .= 'task :'.$runningtasks;
if ((int)$runningtasks > 0) {unset($_SESSION['mainscreenReload']);
		$debug .= 'FLUSH';}




foreach ($g['minions'] as $pit => $min) {
	if (!$min['slots']) {$min['slots'] = 2;}
	if (!$min['items']) {$min['items'] = array();}
	
	if ($min['name'] == 'NEW' || $min['name'] == '') {$min['name'] = $randomnames[$pit];}
	
	if ($minionskills[$pit] && $min['slots'] == 2) {
		$min['slots'] = 3; 
		array_unshift($min['items'],$minionskills[$pit]);
	}
	$busy = ($process[$pit]);

	$actiondata = $actionbank[$min['currentAction']['name']];
	$minionpage .= minionHeader($min,'350 ');

	$minionpage .= '<div style="position:relative" >';
	$minionitems = '';
	$slot = 0;
	$skillset = array();
	while ($slot < $min['slots']) {
		if ($min['items'][$slot]) {
			$itm = $min['items'][$slot];
			$itemdata = $itembank[$itm];
		if (strstr($itm,':')) {
			$itmbits = explode(':',$itm); $itm = $itmbits[0];
			$itemdata = $itembank[$itm]; $itemdata['itembreak_tokens'] = (int)$itembits[1];
		}
			$minionitems .= ''.itemIcon($itemdata,'',40,true).'';
			if ($itemdata['skillgrant'] && $itemdata['skillgrant'] != 'passive') {	
			$skillset[$itemdata['skillgrant']] += 1;
}
		} else {
			$minionitems .= ''.itemIcon(array(),'',40,true);	
		}
		$slot++;
	}
	if (!$busy) {
		$minionitems = '<a href="#" onClick="gearupGoon('.$pit.')" style="text-decoration:none;">'.$minionitems.'</a>';
	}
	$minionpage .= '<div class="minioninventory" style="position:absolute;top:-52px;">'.$minionitems.'</div>';

	
	$minionpage .= '</div>';


	if (count($skillset) == 0) {

		$minionpage .= '<div style="text-align:center;border-top:2px solid black;width:350px;height:100px;background-image:url(\'/media/actions/action_idle.png\')" class="actionslab">
<a href="#" href="#" onClick="gearupGoon('.$pit.')">Grant tools...</a></div>';

	} else {
	if ($process[$pit]) { 
		$taskart = $taskartbank[$pit];
		if (!$taskart) {$taskart = 'action_idle.png';}
		$bottomBox = '<div id="min'.$pit.'" style="text-align:center;width:350px;border-top:2px solid black;height:100px;background-image:url(\'/media/actions/'.$taskart.'\')" class="actionslab">'.$process[$pit].'</div>';
		if (!strstr($process[$pit], 'Collect')) {
			$response['min'.$pit] = $bottomBox;
		} else {
			if (!$_SESSION['seen'.$pit]) {
				$response['min'.$pit] = $bottomBox;
				$_SESSION['seen'.$pit] = true;
			}
		}
		$minionpage .= $bottomBox;

	} else {

		$gather = false;
		$craft = false;
		foreach ($skillset as $skl => $points) {
			$skilldata = $skillbank[$skl];	
			if ($skilldata['skillgrant'] != 'passive') {
				if ($skilldata['craftskill']) {$craft = $skl;} else {$gather = true;}
			}
		}

		if ($craft) {
		$bottomBox = '<div style="text-align:center;width:350px;border-top:2px solid black;height:100px;background-image:url(\'/media/actions/action_idle.png\')" class="actionslab"><a href="#" onClick="openCrafting(\'craftings\',\''.$craft.'\');showView(\'#crafting\')">Assign craft.&#46;.</a></div>';
} else {

		$bottomBox = '<div style="text-align:center;width:350px;border-top:2px solid black;height:100px;background-image:url(\'/media/actions/action_idle.png\')" class="actionslab"><a href="#" onClick="openTaskassign(\'list\','.$pit.')">Assign task...</a></div>';
}

		if ($craft && $gather) {
		$bottomBox = '<div style="text-align:center;width:350px;border-top:2px solid black;height:100px;background-image:url(\'/media/actions/action_idle.png\')" class="actionslab"><span style="margin-top:40px;"><a href="#" onClick="openCrafting(\'craftings\',\''.$craft.'\');showView(\'#crafting\')">Assign craft.&#46;.</a> &nbsp; <a href="#" onClick="openTaskassign(\'list\','.$pit.')">Assign task...</a></span></div>';
}
	$response['min'.$pit] = $bottomBox;
	$minionpage .= $bottomBox;


	}
	}


	$minionpage .= '</div>';
	$g['minions'][$pit] = $min;
}
$minionpage .= '</div>';


	$hirelingprice = $actionbank['newhireling']['requirements'][0]['cost'];
		$minionpage .= ' <a href="#" class="btn" onClick="performAct(-1,\'newhireling\');">New servant ('.$hirelingprice.' gold)</a>';


$response['feedback'] .= $minionpage.javaCheck();

?>