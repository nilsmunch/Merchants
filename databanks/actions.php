<?

include('auto_actions.php');

$actionbank = $lib_actions;

$actionbank['brew_greenpotion'] = array('title'=>'Make green potion','transitive'=>'Making green potion','time'=>10,'itemgain'=>'potion_green',
	'requirements'=>array(array('type'=>'itemqty','item'=>'herb','cost'=>'5')),'gearneed'=>'alch');


$actionbank['tailor_sewhempbag'] = array('title'=>'Sow a herb bag','transitive'=>'Sewing a herb bag','time'=>60,'itemgain'=>'bag_herbs',
	'requirements'=>array(array('type'=>'itemqty','item'=>'cloth_hemp','cost'=>'3')),'gearneed'=>'tailoring');

include('servantfee.php');




?>