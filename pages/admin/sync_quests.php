<?
db_connect();

$tasksQ = mysql_query('SELECT * FROM merch_storybits');

$daskdata = array();

while ($task = mysql_fetch_assoc($tasksQ)) {
	$taskdata = $task;
	$taskdata['key'] = $task['relation_key'].'_'.$task['id'];
	$taskbank[$taskdata['key']] = $taskdata;
}

writeCache('tasks',$taskbank);

header('location:/admin');die();

?>