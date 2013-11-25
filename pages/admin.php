<?

include('modules/inventoryitems.php');
include('modules/inventoryicons.php');

if (!isAdmin()) {die('Piss off...');}

if (!$segment) {$segment = 'status';}
include('admin/'.$segment.'.php');

echo '<a href="/admin/items">Items</a> <a href="/admin/artfiles">Artfiles</a> <a href="/admin/sync">Sync</a><hr>';

echo $page;

?>