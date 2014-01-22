<?

include('modules/inventoryitems.php');
include('modules/inventoryicons.php');

if (!isAdmin()) {die('Piss off...');}

if (!$segment) {$segment = 'status';}
include('admin/'.$segment.'.php');

echo '<head>';
echo '<title>Merchants Admin</title>';

echo '<link href="/media/css/style.css" rel="stylesheet" type="text/css">';

echo '<style>
#gm_assistant *,#gm_assistant {
	color:white; font-size:12px;
}
</style>';

echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> ';
$botjs = '
<script type="text/javascript">

function showAssistant(item) {
	$("#editorform").ajaxSubmit({success:showResponse});
}

function assistFill(field,value) {
	$("#"+field).val(value);
  showAssistant();
}

function showResponse(responseText, statusText, xhr, $form) {
		document.getElementById("gm_assistant").innerHTML = responseText;
}

$(".gameValue").change(function() {
  showAssistant();
});
  showAssistant();
</script>';

echo '</head>';

echo '<a href="/admin/items">Items</a> <a href="/admin/gathering">Gathering</a> <a href="/admin/artfiles">Artfiles</a> <a href="/admin/attention">Attention</a> <a href="/admin/sync">Sync</a><hr>';

echo $page;

if (strstr($page, 'gameValue')) {
echo '<div style="width:200px;bottom:0px;right:0px;top:0px;background-color:black;padding:10px;position:fixed" id="gm_assistant">Assistant</div>';
echo $botjs;
}
?>