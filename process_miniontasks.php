<?

include_once('modules/experiencepoints.php');

$runningtasks = 0;
foreach ($g['minions'] as $pit => $min) {
	$action = $min['currentAction'];
	minionBoosts($min);


	$response['feedback'] = '';
	if ($action['donetime']) {
		$actiondata = $actionbank[$action['name']];
		$timeleft = '<span class="center">'.$actiondata['transitive'].' ('.($action['donetime']-$time).'s) </span>';
		$process[$pit] = $timeleft;
		$taskartbank[$pit] = $actiondata['taskart'];
		
		
		if (($action['donetime']-$time) > 0) {
		$runningtasks++;
		}
		if (($action['donetime']-$time) <= 0) {
			$qty = gatherOutcome($actiondata['qty'],$actiondata['itemgain'],$actiondata['gearneed']);
			$itemdata = $itembank[$actiondata['itemgain']];
			
			if (!$action['rares']) {
			$raredrops = calcRareDrops($actiondata,$qty);
			$g['minions'][$pit]['currentAction']['rares'] = $raredrops;
			} else {
			$raredrops = $action['rares'];
			}
			$droplist = '';
			foreach ($raredrops as $drop) {
				$dropdata = $itembank[$drop['item']];
				$droplist .= '<td width=50%>'.itemIcon($dropdata).' x '.$drop['qty'].'';
			}
			
			$timeleft = '<span><table><tr><td width=50%>'.itemIcon($itemdata).' x '.$qty.$droplist.'<td width=50%><a href="#" onClick="minionCollectGoods(\'collect_from_goon\','.$pit.')">Collect</a></table></span>';
			$process[$pit] = $timeleft;
			if ($_SESSION['collect']['collect_from_goon'.$pit]) {
			if ($actiondata['itemgain']) {
				addToInventory($actiondata['itemgain'],$qty);
				$g['lifetime']['collected_'.$actiondata['itemgain']] += $qty;
				
				foreach ($raredrops as $drop) {
					addToInventory($drop['item'],$drop['qty']);
					$g['lifetime']['collected_'.$drop['item']] += $drop['qty'];
				}
				
				xp_gain($qty);
			}
				$g['minions'][$pit] = spendItemTokens($g['minions'][$pit]);
				unset($_SESSION['informed'][$min['name']]);
	
				unset($_SESSION['inventoryReload']);
				unset($_SESSION['achievementsReload']);
				unset($_SESSION['mainscreenReload']);
				unset($g['minions'][$pit]['currentAction']);
				$_SESSION['collect'] = array();
		} else {
		if (!$_SESSION['informed'][$min['name']]) {
	$face = '<img src=\"/media/art/faces/face_'.strtolower($min['name']).'.png\">';
	$run_js .= 'jQuery.noticeAdd({
				text: "'.$face.' '.$min['name'].' is done ",
				stay: false
			});';
			$_SESSION['informed'][$min['name']] = true;
	}		

	}
		
		}
	}
}



?>