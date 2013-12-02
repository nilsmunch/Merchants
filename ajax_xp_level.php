<?
include('modules/experiencepoints.php');
session_start();
	$g = $_SESSION['game_variables'];
$level = (int)$g['xp_level']+1;

echo 'Level '.$level;

?>