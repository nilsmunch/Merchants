<?
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
session_start();
$g = $_SESSION['game_variables'];


include('databanks/skills.php');
include('databanks/items.php');
include('databanks/actions.php');

include('modules/minions.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');

$time = date('U');
$actiondata = $actionbank[$_GET['act']];

if (!$_GET['act']) {die();}

$_SESSION['mainscreenReload'] = false;

if ($_GET['act'] == 'resetall') {

	unset($_SESSION['inventoryReload']);
	unset($_SESSION['optionBarReload']);
	unset($_SESSION['achievementsReload']);
	unset($_SESSION['goongearReload']);
	unset($_SESSION['mainscreenReload']);
	unset($_SESSION['collect']);
	unset($_SESSION['market_demand']);
	$_SESSION['game_variables'] = array();
die();
}


if ($_GET['minion'] != -1) {
	minionBoosts($g['minions'][$_GET['minion']]);
	$tasktime = minionTaskTime($actiondata);
	$actiondata['time'] = $tasktime['totaltime'];
}


$time += $actiondata['time'];



	if ($actiondata['requirements']) {
		foreach ($actiondata['requirements'] as $req) {
			if ($req['type']=='itemqty' && $req['cost']) {
				if ($g['inventory'][$req['item']] < $req['cost']) {
					die('cant');
				}
				$g['inventory'][$req['item']] -= $req['cost'];
				$g['lifetime']['craftspent_'.$req['item']] += $req['cost'];
			}
		}
	}




if ($_GET['minion'] == -1) {
			$qty = ($actiondata['qty'] ? $actiondata['qty'] : 1);
			if ($actiondata['itemgain']=='hireling') {
				$g['minions'][] = array('name'=>'NEW');
				$g['lifetime']['minions_hired'] += 1;
			} else {
				$g['inventory'][$actiondata['itemgain']] += $qty;
			}

} else {
	$g['minions'][$_GET['minion']]['currentAction'] = array('name'=>$_GET['act'],'donetime'=>$time,'effect'=>'gainitem','itemgain'=>'herb');
}


	unset($_SESSION['inventoryReload']);
	unset($_SESSION['optionBarReload']);

$_SESSION['game_variables'] = $g;

db_saveUserCheck(true);

echo 'ok';

?>