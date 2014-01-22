<?


function gatherOutcome($qty,$item,$skill,$formulate = false) {
	global $boosts;
	if (!$qty) {$qty = 1;}
	if (!$boosts[$skill] && !$boosts[$item]) {
		return $qty;
	}
	$boost = (int)$boosts[$skill];
	$boostqty = floor(($qty / 100) * $boost);
	if ($boostqty == 0) {		return $qty;	}
	if ($formulate) {
		return $qty.' <font style="color:cyan">(+ '.$boostqty.')</font>';
	}
	return (int)$qty+$boostqty;
}

function gatheringSkillList($minion) {
	global $actionbank,$skillbank,$itembank,$gatherTargets,$pit,$boosts;
	minionBoosts($minion);
	
	$gatherTargets = array();
	$skillset = array();
	
	foreach ((array)$minion['items'] as $itemkey) {
		if (strstr($itemkey,':')) {
			$itmbits = explode(':',$itemkey); $itemkey = $itmbits[0];
		}
			$itemdata = $itembank[$itemkey];
			$skillset[$itemdata['skillgrant']] += 1;
	}

foreach ($actionbank as $key => $opt) {
	if (!$opt['title']) {continue;}
	if (!$skillbank[$opt['gearneed']] || $skillbank[$opt['gearneed']]['craftskill'] || !$skillset[$opt['gearneed']]) {continue;}
	$taskbox = '';
	$bring = 'true';
	$ing = '';
	$boost = 0;
	if ($opt['requirements']) {
		foreach ($opt['requirements'] as $req) {
			if ($req['type']=='courage' && $req['value'] > 0) {
				if ((int)$boosts['courage'] < $req['value']) {
					$bring = 'cour';
					$ing .= '<div class="taskdetail negative">Needs '.$req['value'].' courage</div>';
				} else {
					$ing .= '<div class="taskdetail">Needs '.$req['value'].' courage</div>';}
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
	$details = '<div  class="taskdetail">Gain '.gatherOutcome($opt['qty'],$opt['itemgain'],$opt['gearneed'],true).' '.$itemdata['name_plural'].'</div>';
	}
	
	$gatherTargets[$opt['itemgain']] = $opt['itemgain'];
	
	$details .= dropChances($opt);
	
	
	$details .= '<span style="color:#45c954;background-color:rgba(0,0,0,0.9);font-size:12px;padding:4px;position:absolute;bottom:0px;right:0px">+ '.$opt['xp'].' XP</span>';

	if ($opt['special']) {
		$bring = false;
	}

	if ($bring == 'true') {
		$timevar = minionTaskTime($opt);
		$taskbox .= '<a href="#" style="font-weight:bold">'.$opt['place'].'</a>'.$timevar['labels_box'].$ing;
	



	if ($details) {$taskbox .= $details;	}
}
	if ($bring == 'res') {
		$timevar = minionTaskTime($opt);
		$taskbox .= '<a href="#">'.$opt['place'].'</a>'.$timevar['labels_box'].$ing;
	}
	if ($bring == 'cour') {
		$timevar = minionTaskTime($opt);
		$taskbox .= '<a href="#">'.$opt['place'].'</a>'.$timevar['labels_box'].($details ? '<div  class="taskdetail">'.$details.'</div>' :'').$ing;
	}
	if ($taskbox) {


		$taskart = $opt['taskart'];
		if (!$taskart) {$taskart = 'action_idle.png';}
		
	$js = 'performAct('.(int)$pit.',\''.$key.'\');showView(\'#result\');';
	if ($bring == 'cour') {$js = '';}
		$taskbox = '<div onClick="'.$js.'" style="display:inline-block;text-align:center;margin-right: auto;position:relative;margin-left: auto;width:350px;height:100px;background-image:url(\'/media/actions/'.$taskart.'\')" class="actionslab"><span>'.$taskbox.'</span></div>';
		
		
	$itemkey = $opt['itemgain'];
	$itemdata = $itembank[$itemkey];
	

		$optionbar[$itemkey] .= $taskbox;
 	}
}
return $optionbar;

}

?>