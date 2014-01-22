<?
db_connect();

function prepRecipe($recipekey,$item) {
	$recipe = mysql_fetch_assoc(mysql_query('SELECT * FROM `merch_items` WHERE itemkey = "'.$recipekey.'" AND itemclass = "recipe"'));
	$newitemname = 'Recipe : '.$item['name'];
	$icon = 'Scroll4.png';
	if (strstr($recipekey, '_10_')) {$newitemname = 'Work plans : '.$item['craft_qty']*$item['craft_bulkorder'].'x '.$item['name']; $icon = 'RecruitmentOrder.png';}
	if (strstr($recipekey, '_100_')) {$newitemname = 'Work plans : '.$item['craft_qty']*$item['craft_bulkorder'].'x '.$item['name']; $icon = 'Shipstructure.png';}
	if (strstr($recipekey, '_50optimized_')) {$newitemname = 'Optimized plans : '.$item['craft_qty']*$item['craft_bulkorder'].'x '.$item['name']; $icon = 'BudgetTable.png';
	$flair = '10% less materials needed';
	}
	
	
	if (!$recipe) {
		mysql_query('INSERT INTO `merch_items` (itemkey,itemclass,creation_date,name,artfile,flairtext) VALUES ("'.$recipekey.'","recipe",NOW(),"'.$newitemname.'","'.$icon.'","'.$flair.'")');
	}
}

include('databanks/skills.php');

$variations[] = array('trigger'=> 'City Gardens','place'=>'Windy Vineyards','qty_multi'=>5,'time_multi'=>6,'danger'=>0);
$variations[] = array('trigger'=> 'City Gardens','place'=>'Creeky Woods','qty_multi'=>16,'time_multi'=>20,'danger'=>0,'rarechance'=>1);
$variations[] = array('trigger'=> 'City Gardens','place'=>'Gallow Acres','qty_multi'=>34,'time_multi'=>40,'danger'=>1,'taskart'=>'action_gallowacres.png','rarechance'=>2);

$variations[] = array('trigger'=> 'City River','place'=>'Silverling Lake','qty_multi'=>7,'time_multi'=>9,'danger'=>0,'taskart'=>'action_silverlinglake.png');
$variations[] = array('trigger'=> 'City River','place'=>'Thunderdusk Docks','qty_multi'=>21,'time_multi'=>25,'danger'=>0,'taskart'=>'action_thunderduskdocks.png');
$variations[] = array('trigger'=> 'City River','place'=>'Blackbite Sea','qty_multi'=>30,'time_multi'=>33,'danger'=>2,'taskart'=>'action_blackbite.png');


$variations[] = array('trigger'=> 'City Outskirts','place'=>'Brokewater Forest','qty_multi'=>7,'time_multi'=>9,'danger'=>0,'taskart'=>'action_silverlinglake.png');
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Thousand Oaks','qty_multi'=>21,'time_multi'=>25,'danger'=>0,'taskart'=>'action_thunderduskdocks.png','rarechance'=>1);

$variations[] = array('trigger'=> 'City Outskirts','place'=>'Farcreek','qty_multi'=>36,'time_multi'=>46,'danger'=>1,'taskart'=>'action_blackbite.png','rarechance'=>2);

$variations[] = array('trigger'=> 'City Outskirts','place'=>'Spiderling Woods','qty_multi'=>30,'time_multi'=>33,'danger'=>2,'taskart'=>'action_blackbite.png','rarechance'=>2);
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Darks of Dunkelberg','qty_multi'=>60,'time_multi'=>60,'danger'=>3,'taskart'=>'action_blackbite.png','rarechance'=>2);
$variations[] = array('trigger'=> 'City Outskirts','place'=>'Living Forest of Qurash','qty_multi'=>120,'time_multi'=>110,'danger'=>4,'taskart'=>'action_blackbite.png','rarechance'=>3);


$variations[] = array('trigger'=> 'Below city hills','place'=>'Harcrook mines','qty_multi'=>12,'time_multi'=>11,'danger'=>1,'rarechance'=>3);
$variations[] = array('trigger'=> 'Below city hills','place'=>'Marken Abandoned Shafts','qty_multi'=>30,'time_multi'=>36,'danger'=>3,'rarechance'=>4);

$variations[] = array('trigger'=> 'City Quarry','place'=>'Bakkrot Quarry','qty_multi'=>12,'time_multi'=>11,'danger'=>1,'rarechance'=>3);


$variations[] = array('trigger'=> 'Grassy pastures','place'=>'Highcliff hills','qty_multi'=>30,'time_multi'=>33,'danger'=>2,'taskart'=>'action_blackbite.png','rarechance'=>2);

function writeCache($key,$object) {

$apiFile = 'databanks/auto_'.$key.'.php';

$final =  '<? global $lib_'.$key.'; $lib_'.$key.' = '.var_export($object,true).'; ?>';


$fh = fopen($apiFile, 'w');
fwrite($fh, $final);
fclose($fh);
}

$itemsQ = mysql_query('SELECT * FROM  `merch_items` order by market_price,market_price_yulecoin,market_price_favorcoin,finding_skill,itemlevel asc');

while ($item = mysql_fetch_assoc($itemsQ)) {
	$itemdata = $item;
	$itemkey = $itemdata['itemkey'];
	unset($itemdata['id']);

	$itemneeds = mysql_query('SELECT * FROM  `merch_items` WHERE 
	craft_ingredients LIKE "%,'.$itemkey.',%" OR 
	craft_ingredients LIKE "'.$itemkey.',%" OR 
	craft_ingredients LIKE "'.$itemkey.':%" OR 
	craft_ingredients LIKE "%,'.$itemkey.':%" OR 
	craft_ingredients LIKE "%, '.$itemkey.':%" OR 
	craft_ingredients LIKE "%, '.$itemkey.',%" OR 
	craft_ingredients LIKE "%, '.$itemkey.'" OR 
	craft_ingredients LIKE "%,'.$itemkey.'" OR 
	craft_ingredients LIKE "'.$itemkey.'"  ');
	while ($itemneeded = mysql_fetch_assoc($itemneeds)) {
		$itemdata['needed'][$itemneeded['craft_profession']] += 1;
	}

	if ($item['craft_ingredients']) {
		$act = array();
		$ingarray = array();
		$act['title'] = $item['finding_action_name'];
		$act['time'] = 30*$item['itemlevel'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['craft_profession'];
		foreach (array_count_values(explode(',',str_replace(' ','',$item['craft_ingredients']))) as $val => $qty) {
			if (strstr($val, ':')) {
				$bits = explode(':', $val);
				$val = trim($bits[0]); $qty = (int)$bits[1];
			}
			$ingarray[] = array('type'=>'itemqty','item'=>$val,'cost'=>$qty);
		}
		$act['qty'] = $item['craft_qty'];
		$act['craftlevel'] = ceil($item['itemlevel']/10);
		$act['craft_recipekey'] = $itemdata['craft_recipekey'];
		
		if ($itemdata['craft_recipekey']) {prepRecipe($itemdata['craft_recipekey'],$itemdata);}
		$act['requirements'] = $ingarray;
		$actionbank['crafting_'.$item['itemkey']] = $act;
		
		
		
		
	if ($item['craft_bulkorder']) {
		$act = array();
		$ingarray = array();
		$act['title'] = $item['finding_action_name'];
		$act['time'] = 30*$item['itemlevel']*$item['craft_bulkorder'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['craft_profession'];
		foreach (array_count_values(explode(',',str_replace(' ','',$item['craft_ingredients']))) as $val => $qty) {
			if (strstr($val, ':')) {
				$bits = explode(':', $val);
				$val = trim($bits[0]); $qty = (int)$bits[1];
			}
			$ingarray[] = array('type'=>'itemqty','item'=>$val,'cost'=>$qty*$item['craft_bulkorder']);
		}
		$act['qty'] = $item['craft_qty']*$item['craft_bulkorder'];
		$act['craft_recipekey'] = 'crafting_10_'.$item['itemkey'];
		$act['craftlevel'] = ceil($item['itemlevel']/10)+1;
		$act['requirements'] = $ingarray;
		$actionbank['crafting_10_'.$item['itemkey']] = $act;
		prepRecipe('crafting_10_'.$item['itemkey'],$item);
		
		
		
		$item['craft_bulkorder'] = $item['craft_bulkorder']*5;
		$act = array();
		$ingarray = array();
		$act['title'] = $item['finding_action_name'];
		$act['time'] = 30*$item['itemlevel']*$item['craft_bulkorder'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['craft_profession'];
		foreach (array_count_values(explode(',',str_replace(' ','',$item['craft_ingredients']))) as $val => $qty) {
			if (strstr($val, ':')) {
				$bits = explode(':', $val);
				$val = trim($bits[0]); $qty = (int)$bits[1];
			}
			$ingarray[] = array('type'=>'itemqty','item'=>$val,'cost'=>ceil(($qty*$item['craft_bulkorder']) * 0.9) );
		}
		$act['qty'] = $item['craft_qty']*$item['craft_bulkorder'];
		$act['craft_recipekey'] = 'crafting_100_'.$item['itemkey'];
		$act['craftlevel'] = ceil($item['itemlevel']/10)+6;
		$act['optimized'] = 10;
		$act['requirements'] = $ingarray;
		$actionbank['crafting_50optimized_'.$item['itemkey']] = $act;
		prepRecipe('crafting_50optimized_'.$item['itemkey'],$item);
		
		
		$item['craft_bulkorder'] = $item['craft_bulkorder']*2;
		$act = array();
		$ingarray = array();
		$act['title'] = $item['finding_action_name'];
		$act['time'] = 30*$item['itemlevel']*$item['craft_bulkorder'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['craft_profession'];
		foreach (array_count_values(explode(',',str_replace(' ','',$item['craft_ingredients']))) as $val => $qty) {
			if (strstr($val, ':')) {
				$bits = explode(':', $val);
				$val = trim($bits[0]); $qty = (int)$bits[1];
			}
			$ingarray[] = array('type'=>'itemqty','item'=>$val,'cost'=>$qty*$item['craft_bulkorder']);
		}
		$act['qty'] = $item['craft_qty']*$item['craft_bulkorder'];
		$act['craft_recipekey'] = 'crafting_100_'.$item['itemkey'];
		$act['craftlevel'] = ceil($item['itemlevel']/10)+5;
		$act['requirements'] = $ingarray;
		$actionbank['crafting_100_'.$item['itemkey']] = $act;
		prepRecipe('crafting_100_'.$item['itemkey'],$item);
}



}


		if ($item['ach_craft1_title']) {
			$ach = array();
			$ach['name'] = $item['ach_craft1_title'];
			$ach['artfile'] = $item['ach_craft1_artwork'];
			$ach['listener'] = 'craftspent_'.$itemkey;
			$ach['category'] = 'Crafting';
			$ach['formulation'] = 'Spent XX '.$item['name'].' on crafts';
			$ach['reward'] = array('type'=>'gold','qty'=>'50');
			$ach['listener_min'] = 100;
			$ach['chain'] = 'craft_'.$itemkey;
			$achbank['ach_craft1_'.$itemkey] = $ach;
		}
		
		

		if ($item['ach_craft2_title']) {
			$ach = array();
			$ach['name'] = $item['ach_craft2_title'];
			$ach['artfile'] = $item['ach_craft2_artwork'];
			$ach['listener'] = 'craftspent_'.$itemkey;
			$ach['category'] = 'Crafting';
			$ach['formulation'] = 'Spent XX '.$item['name'].' on crafts';
			$ach['reward'] = array('type'=>'gold','qty'=>'50');
			$ach['prerequisite'] = 'ach_craft2_'.$itemkey;
			if ($item['ach_craft2_reward']) {$ach['reward'] = array('type'=>$item['ach_craft2_reward'],'qty'=>'1');}
			$ach['listener_min'] = 500;
			$ach['chain'] = 'craft_'.$itemkey;
			$achbank['ach_craft2_'.$itemkey] = $ach;
		}

	if ($item['entrypoint_findingtask']) {
		$act = array();
		
		if ($item['finding_action_name']) {
		$act['title'] = $item['finding_action_name'];
		$act['time'] = $item['finding_time'];
		$act['itemgain'] = $item['itemkey'];
		$act['gearneed'] = $item['finding_skill'];
		$act['transitive'] = $item['finding_action_transitive'];
		
		foreach ($variations as $key => $var) {
			if (strstr($item['finding_action_name'],$var['trigger'])) {
				$act['place'] = $var['trigger'];
			}
		}
		
		if (!$act['place']) {print_r($act);die('no place');}
		
		
		$danger = $item['finding_action_danger'];
		if ($var['danger']) { $act['requirements'][] = array('type'=>'courage','value'=> $danger);}
		
		
		if ($item['finding_action_dropchance'] && $skillbank[$item['finding_skill']]['rarekeys'][$item['finding_action_danger']]) {
			$act['rare_chance'] = $item['finding_action_dropchance'];
			$act['rare_drop'] = $skillbank[$item['finding_skill']]['rarekeys'][$item['finding_action_danger']];
		}
		$actionbank['finding_'.$item['itemkey']] = $act;
		
		}


		if ($item['ach_1_title']) {
			$ach = array();
			$ach['name'] = $item['ach_1_title'];
			$ach['artfile'] = $item['ach_1_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>20 + (30*$item['rarityscale']));
			$ach['category'] = 'Gathering';
			$ach['listener_min'] = 5;
			$ach['chain'] = 'gather_'.$itemkey;
			$achbank['ach_1_'.$itemkey] = $ach;
		}
	

		if ($item['ach_2_title']) {
			$ach = array();
			$ach['name'] = $item['ach_2_title'];
			$ach['artfile'] = $item['ach_2_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>50 + (50*$item['rarityscale']));
			$ach['listener_min'] = 100;
			$ach['category'] = 'Gathering';
			$ach['prerequisite'] = 'ach_1_'.$itemkey;
			$ach['chain'] = 'gather_'.$itemkey;
			$achbank['ach_2_'.$itemkey] = $ach;
		}

		if ($item['ach_3_title']) {
			$ach = array();
			$ach['name'] = $item['ach_3_title'];
			$ach['artfile'] = $item['ach_3_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>100 + (50*$item['rarityscale']));
			if ($item['ach_3_reward']) {$ach['reward'] = array('type'=>$item['ach_3_reward'],'qty'=>'1');}
			$ach['listener_min'] = 500;
			$ach['category'] = 'Gathering';
			$ach['prerequisite'] = 'ach_2_'.$itemkey;
			$ach['chain'] = 'gather_'.$itemkey;
			$achbank['ach_3_'.$itemkey] = $ach;
		}
		
		if ($item['ach_4_title']) {
			$ach = array();
			$ach['name'] = $item['ach_4_title'];
			$ach['artfile'] = $item['ach_4_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>200 + (100*$item['rarityscale']));
			if ($item['ach_4_reward']) {$ach['reward'] = array('type'=>$item['ach_4_reward'],'qty'=>'1');}
			$ach['listener_min'] = 1500;
			$ach['category'] = 'Gathering';
			$ach['prerequisite'] = 'ach_3_'.$itemkey;
			$ach['chain'] = 'gather_'.$itemkey;
			$achbank['ach_4_'.$itemkey] = $ach;
		}
		
		if ($item['ach_5_title']) {
			$ach = array();
			$ach['name'] = $item['ach_5_title'];
			$ach['artfile'] = $item['ach_5_artwork'];
			$ach['listener'] = 'collected_'.$itemkey;
			$ach['formulation'] = 'Collect XX '.$item['name'];
			$ach['reward'] = array('type'=>'gold','qty'=>300 + (300*$item['rarityscale']));
			if ($item['ach_5_reward']) {$ach['reward'] = array('type'=>$item['ach_5_reward'],'qty'=>'1');}
			$ach['listener_min'] = 7000;
			$ach['category'] = 'Gathering';
			$ach['prerequisite'] = 'ach_4_'.$itemkey;
			$ach['chain'] = 'gather_'.$itemkey;
			$achbank['ach_5_'.$itemkey] = $ach;
		}

		foreach ($variations as $key => $var) {

	if (strstr($item['finding_action_name'],$var['trigger'])) {
		$act = array();
		$danger = $item['finding_action_danger'] +  $var['danger'];
		$dropdanger = $var['danger'];
		if ($item['finding_action_dropchance']) {$dropdanger = $item['finding_action_danger'];}
		
		$droprate = $item['finding_action_dropchance'] + $var['rarechance'];
		$act['title'] = str_replace($var['trigger'],$var['place'],$item['finding_action_name']);
		$act['qty'] = $var['qty_multi'];
		$act['time'] = $item['finding_time']*$var['time_multi'];
		$act['itemgain'] = $item['itemkey'];
		$act['place'] = $var['place'];
		$act['taskart'] = $var['taskart'];
		$act['gearneed'] = $item['finding_skill'];
		$act['transitive'] = $item['finding_action_transitive'];
		if ($var['danger']) { $act['requirements'][] = array('type'=>'courage','value'=> $danger);}
		
		if ($droprate && $skillbank[$item['finding_skill']]['rarekeys'][$dropdanger]) {
			$act['rare_chance'] = $droprate;
			$act['rare_drop'] = $skillbank[$item['finding_skill']]['rarekeys'][$dropdanger];
		}
		
		$actionbank['finding_'.$item['itemkey'].'_'.$key] = $act;
}
}
	}

	foreach ($itemdata as $key => $value) {
		if (strstr($key, 'ach_')) {unset($itemdata[$key]);}
		if (!$value) {unset($itemdata[$key]);}
	}

	$itembank[$item['itemkey']] = $itemdata;
}

writeCache('items',$itembank);

writeCache('actions',$actionbank);
writeCache('achievements',$achbank);

include('sync_quests.php');

header('location:/admin');die();

?>