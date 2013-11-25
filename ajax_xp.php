<?
include('modules/experiencepoints.php');
session_start();
	$g = $_SESSION['game_variables'];
$level = (int)$g['xp_level'];
if (!$level) {$level = 1;$update = true;}

$top = points_to_level($level);
$xp = $g['xp'];

if (($top - $xp) <= 0) {
	$g['xp_level'] += 1;
	$g['xp'] = 0;
	$_SESSION['game_variables'] = $g;
	die('<a href="#" onClick="openSkills()">Level up!</a>');
}

if ($update) {
	$_SESSION['game_variables'] = $g;
}


echo ($top - $xp).' XP left to level up';

?>