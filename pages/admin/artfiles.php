<?

	db_connect();
if ($detail && $_SESSION['edititem']) {
	mysql_query('UPDATE `merch_items` SET artfile = "'.$detail.'" WHERE id = '.$_SESSION['edititem']);
	header('location:/admin/itemeditor/'.$_SESSION['edititem']);die();
}



$itemsQ = mysql_query('SELECT * FROM  `merch_items`');
$arttaken = array();
while ($item = mysql_fetch_assoc($itemsQ)) {
	$arttaken[] = $item['artfile'];
}

if ($handle = opendir('../art/artbank')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".."  && $entry != 'empty.png' && !in_array($entry, $arttaken)) {
			if (strstr($entry,' ')) { rename('../art/artbank/'.$entry, '../art/artbank/'.str_replace(' ','',$entry)); }
			if (strstr($entry,'.PNG')) { rename('../art/artbank/'.$entry, '../art/artbank/'.str_replace('.PNG','.png',$entry)); }
            $bits[$entry] = '<a href="/admin/artfiles/'.$entry.'"><img src="http://art.macroheroes.com/64/dull/'.$entry.'" style="height:128px;width:128px;background-color:black;margin:2px;"></a>';
        }
    }
    closedir($handle);
}
sort($bits);
foreach ($bits as $bit) {$page .= $bit;}


?>