<?
db_connect();

$variations[] = array('trigger'=> 'City Gardens','place'=>'Windy Vineyards','qty_multi'=>5,'time_multi'=>6,'danger'=>0);
$variations[] = array('trigger'=> 'City Gardens','place'=>'Creeky Woods','qty_multi'=>16,'time_multi'=>20,'danger'=>0);
$variations[] = array('trigger'=> 'City Gardens','place'=>'Gallow Acres','qty_multi'=>34,'time_multi'=>40,'danger'=>1,'taskart'=>'action_gallowacres.png');

$variations[] = array('trigger'=> 'City River','place'=>'Silverling Lake','qty_multi'=>7,'time_multi'=>9,'danger'=>0,'taskart'=>'action_silverlinglake.png');
$variations[] = array('trigger'=> 'City River','place'=>'Thunderdusk Docks','qty_multi'=>21,'time_multi'=>25,'danger'=>0,'taskart'=>'action_thunderduskdocks.png');
$variations[] = array('trigger'=> 'City River','place'=>'Blackbite Sea','qty_multi'=>30,'time_multi'=>33,'danger'=>2,'taskart'=>'action_blackbite.png');


$variations[] = array('trigger'=> 'City Outskirts','place'=>'Brokewater Forest','qty_multi'=>7,'time_multi'=>9,'danger'=>0,'taskart'=>'action_silverlinglake.png');
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Thousand Oaks','qty_multi'=>21,'time_multi'=>25,'danger'=>0,'taskart'=>'action_thunderduskdocks.png');
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Spiderling Woods','qty_multi'=>30,'time_multi'=>33,'danger'=>2,'taskart'=>'action_blackbite.png');
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Farcreek','qty_multi'=>36,'time_multi'=>46,'danger'=>1,'taskart'=>'action_blackbite.png');
$variations[] = array('trigger'=> 'City Outskirts','place'=>'the Darks of Dunkelberg','qty_multi'=>60,'time_multi'=>60,'danger'=>3,'taskart'=>'action_blackbite.png');
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Living Forest of Qurash','qty_multi'=>120,'time_multi'=>110,'danger'=>4,'taskart'=>'action_blackbite.png');


function writeCache($key,$object) {

$apiFile = 'databanks/auto_'.$key.'.php';

$final =  '<? global $lib_'.$key.'; $lib_'.$key.' = '.var_export($object,true).'; ?>';


$fh = fopen($apiFile, 'w');
fwrite($fh, $final);
fclose($fh);
}

$itemsQ = mysql_query('SELECT * FROM  `merch_items` order by market_price,market_price_yulecoin,market_price_favorcoin asc');

while ($item = mysql_fetch_assoc($itemsQ)) {
	$itemdata = $item;
	$itemkey = $itemdata['itemkey'];
	unset($itemdata['itemkey']);
	unset($itemdata['id']);
	$itembank[$item['itemkey']] = $itemdata;


	if ($item['craft_ingredients']) {
		$act = array();
		$ingarray = array();
		$act['title'] = $item['finding_action_name'];
		$act['time'] = 30*$item['itemlevel'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['craft_profession'];
		foreach (array_count_values(explode(',',$item['craft_ingredients'])) as $val => $qty) {
			$ingarray[] = array('type'=>'itemqty','item'=>$val,'cost'=>$qty);
		}


		$act['requirements'] = $ingarray;
		$actionbank['crafting_'.$item['itemkey']] = $act;
}


		if ($item['ach_craft1_title']) {
			$ach = array();
			$ach['name'] = $item['ach_craft1_title'];
			$ach['artfile'] = $item['ach_craft1_artwork'];
			$ach['listener'] = 'craftspent_'.$itemkey;
			$ach['formulation'] = 'Spent XX '.$item['name'].' on crafts';
			$ach['reward'] = array('type'=>'gold','qty'=>'50');
			$ach['listener_min'] = 100;
			$achbank['ach_craft1_'.$itemkey] = $ach;
		}

	if ($item['entrypoint_findingtask']) {
		$act = array();
		$act['title'] = $item['finding_action_name'];
		$act['time'] = $item['finding_time'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['finding_skill'];
		$act['transitive'] = $item['finding_action_transitive'];
		$actionbank['finding_'.$item['itemkey']] = $act;


		if ($item['ach_1_title']) {
			$ach = array();
			$ach['name'] = $item['ach_1_title'];
			$ach['artfile'] = $item['ach_1_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>'20');
			$ach['listener_min'] = 5;
			$achbank['ach_1_'.$itemkey] = $ach;
		}
	

		if ($item['ach_2_title']) {
			$ach = array();
			$ach['name'] = $item['ach_2_title'];
			$ach['artfile'] = $item['ach_2_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>'50');
			$ach['listener_min'] = 50;
			$ach['prerequisite'] = 'ach_1_'.$itemkey;
			$achbank['ach_2_'.$itemkey] = $ach;
		}

		if ($item['ach_3_title']) {
			$ach = array();
			$ach['name'] = $item['ach_3_title'];
			$ach['artfile'] = $item['ach_3_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>'50');
			if ($item['ach_3_reward']) {$ach['reward'] = array('type'=>$item['ach_3_reward'],'qty'=>'1');}
			$ach['listener_min'] = 250;
			$ach['prerequisite'] = 'ach_2_'.$itemkey;
			$achbank['ach_3_'.$itemkey] = $ach;
		}
		

		foreach ($variations as $key => $var) {

	if (strstr($item['finding_action_name'],$var['trigger'])) {
		$act = array();
		$act['title'] = str_replace($var['trigger'],$var['place'],$item['finding_action_name']);
		$act['qty'] = $var['qty_multi'];
		$act['time'] = $item['finding_time']*$var['time_multi'];
		$act['itemgain'] = $item['itemkey'];
		$act['taskart'] = $var['taskart'];
		$act['gearneed'] = $item['finding_skill'];
		$act['transitive'] = $item['finding_action_transitive'];
		if ($var['danger']) { $act['requirements'][] = array('type'=>'courage','value'=> $var['danger']);}
		$actionbank['finding_'.$item['itemkey'].'_'.$key] = $act;
}
}
	}

}

writeCache('items',$itembank);

writeCache('actions',$actionbank);
writeCache('achievements',$achbank);

header('location:/admin');die();

?>