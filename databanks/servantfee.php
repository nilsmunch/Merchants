<?


$mins = count($g['minions']);

$extramulti = 1;

if (function_exists('isAdmin')) {
if (isAdmin()) {$mins = 1;}
}

if ($mins > 10) {$extramulti = $mins -10;}

$actionbank['newhireling'] = array('special'=>'playeraction','title'=>'Find new hireling','transitive'=>'Finding new hireling','time'=>3,'itemgain'=>'hireling',
	'requirements'=>array(array('type'=>'itemqty','item'=>'gold','cost'=>$extramulti*$mins*(10+(15*$mins * $mins)))));

?>