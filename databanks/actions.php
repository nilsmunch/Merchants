<?

include('auto_actions.php');

$actionbank = $lib_actions;

$actionbank['brew_greenpotion'] = array('title'=>'Make green potion','transitive'=>'Making green potion','time'=>10,'itemgain'=>'potion_green',
	'requirements'=>array(array('type'=>'itemqty','item'=>'herb','cost'=>'5')),'gearneed'=>'alch');


$actionbank['tailor_sewhempbag'] = array('title'=>'Sow a herb bag','transitive'=>'Sewing a herb bag','time'=>60,'itemgain'=>'bag_herbs',
	'requirements'=>array(array('type'=>'itemqty','item'=>'cloth_hemp','cost'=>'3')),'gearneed'=>'tailoring');

$actionbank['loom_hempcloth'] = array('title'=>'Turn herbs into hemp cloth','transitive'=>'Turn herbs into hemp cloth','time'=>10,'itemgain'=>'cloth_hemp',
	'requirements'=>array(array('type'=>'itemqty','item'=>'herb','cost'=>'7')),'gearneed'=>'looming');


// ALCHEMY

// Brewery
$actionbank['ale_mudwater'] = array('transitive'=>'Brewing','time'=>20,'itemgain'=>'ale_mudwater',
	'requirements'=>array(array('type'=>'itemqty','item'=>'herb','cost'=>'4')),'gearneed'=>'brewery');




$mins = count($g['minions']);

$actionbank['newhireling'] = array('special'=>'playeraction','title'=>'Find new hireling','transitive'=>'Finding new hireling','time'=>3,'itemgain'=>'hireling',
	'requirements'=>array(array('type'=>'itemqty','item'=>'gold','cost'=>$mins*(10+(15*$mins * $mins)))));

?>