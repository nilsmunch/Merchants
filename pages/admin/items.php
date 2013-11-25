<?
db_connect();

if ($detail == 'new') {
mysql_query('INSERT INTO merch_items () values ()');
	header('location:/admin/items');die();
}

$page = '<a href="/admin/items/new">New</a>';

$itemsQ = mysql_query('SELECT * FROM  `merch_items`'); // where release_build = 0

while ($item = mysql_fetch_assoc($itemsQ)) {
	$itemkey = $item['id'];
	$itembank[$itemkey] = $item;
	$page .= showItemBox($itemkey,1,'<a href="/admin/itemeditor/'.$itemkey.'">Edit</a>');
}

?>