<?
	echo 'Scores';

include('../config.php');
db_connect();

$scoreQ = mysql_query('SELECT *,TIME_TO_SEC(TIMEDIFF(NOW(),lastsave)) as lastseen FROM merch_players');


while ($scoreentry = mysql_fetch_assoc($scoreQ)) {
$data = json_decode($scoreentry['player_data'],true);

$scoreentry['servants'] = count($data['minions']);
$scoreentry['gold'] = (int)$data['inventory']['gold'];
$scoreentry['loot'] = array_sum((array)$data['inventory'])-$scoreentry['gold'];

$scoreentry['xp_level'] = (int)$data['xp_level']+1;
$player[] = $scoreentry;
}

echo '<table cellspacing=0 width=100%>';

array_sort($player,'xp_level');

foreach ($player as $pl) {
$detail = '';
if ($pl['lastseen'] < 900 && $pl['lastseen']) {$detail = ' <font style="color:green">Online</font>';}

echo '<tr><td width=30><img src="https://graph.facebook.com/'.$pl['fb_id'].'/picture" style="height:30px;width:30px;border:1px solid black;"><td>'.$pl['playername'].$detail.'<td>Level '.$pl['xp_level'].'<td style="text-align:right">'.$pl['servants'].' servants<td style="text-align:right">'.$pl['loot'].' pieces of loot'.'<td style="text-align:right">'.$pl['gold'].' gold';
}
echo '</table>';

?>