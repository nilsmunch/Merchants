<?

session_start();
include('../config.php');
//db_connect();
include('databanks/items.php');
include('databanks/passive_skills.php');
include('modules/inventoryitems.php');
include('modules/inventoryicons.php');
include('modules/db_backup.php');
$g = $_SESSION['game_variables'];


if ($_GET['action'] == 'spendpoint') {
$g['skills'][$_GET['target']] += 1;
	$_SESSION['game_variables'] = $g;
db_saveUserCheck(true);
;}


$skillpoints = $g['xp_level'] - array_sum((array)$g['skills']);

echo '<div style="float:left">Skillpoints : '.(int)$skillpoints.'</div>';

echo '<div style="position:absolute;">';



foreach ($perkbank as $perkkey => $perk) {
	$perk['itemclass'] = 'skill';
	if (!$perk['artfile']) {$perk['artfile'] = '0066_poisonspell_512.png';}
	$class = 'skill';
	$js = '';

		$bring = true;
		foreach ((array)$perk['depend'] as $needkey => $need) { if ((int)$g['skills'][($needkey+1)] == 0) {$bring = false;}}
		if (count((array)$perk['depend']) == 0) {$bring = true;}
		if (!isset($perk['depend'])) {$bring = false;}

	if ($bring && $skillpoints > 0) {$class = 'skill can-add-points';$js = 'onClick="openSkills(\'spendpoint\',\''.($perkkey+1).'\')"';}
	$points = (int)$g['skills'][($perkkey+1)];
	if ($points) {$class .= ' has-points';}


	$icon = '<img src="http://art.macroheroes.com/64/pure/'.$perk['artfile'].'" style="height:64px;width:64px;background-color:black;">';
	$perkmap .= '<div class="'.$class.'" '.$js.' data-skill-id="'.($perkkey+1).'">
					<div class="skill-dependency active"></div>

<div class="icon-container">
						<div class="icon">'.$icon.'</div>
					</div>

<div class="frame"><div class="tool-tip">
<div>'.$perk['title'].'</div>
'.$perk['desc'].'	
					</div>
					<div class="skill-points">'.$points.'</div></div>


				</div>';
}
?>


		<div data-bind="css: { open: isOpen }" class="page">
				<? echo $perkmap; ?>
	</div>
	</div>
<div style="clear:both;height:640px;">&nbsp;</div>