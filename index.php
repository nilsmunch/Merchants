<?
$bits = explode('/',$_GET['p']);
$action= $bits[0];
$segment= $bits[1];
$detail= $bits[2];

if ($action == 'media') {die();}
session_start();

include('../config.php');
include('modules/facebook.php');

if ($action == 'admin') {include('pages/admin.php');die();}

$_SESSION['optionBarReload'] = false;
$_SESSION['inventoryReload'] = false;
$_SESSION['achievementsReload'] = false;
$_SESSION['mainscreenReload'] = false;
?><!DOCTYPE html>
<html style="height:100%">
<head>
    <title>Merchants</title>
<!--[if lt IE 9]>
<script src="/src/modernizr.js"></script><!--<![endif]-->

<LINK href="/media/css/style.css" rel="stylesheet" type="text/css">

	<link href="/media/css/skilltree.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/src/howler.js"></script>

<link href="/src/jquery.notice.css" type="text/css" media="screen" rel="stylesheet" />
<script src="/src/jquery.notice.js" type="text/javascript"></script>
<script type="text/javascript">

function itemConsume(item) {
	$.ajax({ url: "ajax_consume.php?item="+item}).done(function( msg ) {
    		document.getElementById("inventory").innerHTML = msg;
    		openInventory();
	});
}

function refreshXP() {
	$.ajax({ url: "ajax_xp.php"}).done(function( msg ) {
    		document.getElementById("xp").innerHTML = msg;
	});
}

function openSkills(action,target) {
	showView('#skills');
	$.ajax({ url: "ajax_skill.php?action="+action+"&target="+target}).done(function( msg ) {
    		document.getElementById("skills").innerHTML = msg;
	});
}

function openCrafting(action,target) {
	$.ajax({ url: "ajax_crafting.php?action="+action+"&target="+target}).done(function( msg ) {
	$("div#crafting").show();
    		document.getElementById("crafting").innerHTML = msg;
	});
}

function marketAction(action,target) {
	$.ajax({ url: "ajax_market.php?action="+action+"&target="+target}).done(function( msg ) {
    		document.getElementById("marketplace").innerHTML = msg;
	});
}

function openTaskassign(action,target) {
	$.ajax({ url: "ajax_taskassign.php?action="+action+"&target="+target}).done(function( msg ) {
	$("div#taskassign").show();
    		document.getElementById("taskassign").innerHTML = msg;
	});
}

function openQuests(action,target) {
    	document.getElementById("quests").innerHTML = "Loading quests...";
	showView('#quests');
	$.ajax({ url: "ajax_quest.php?action="+action+"&target="+target}).done(function( msg ) {
    		document.getElementById("quests").innerHTML = msg;
	});
}

function openScores() {
    	document.getElementById("scoreboard").innerHTML = "Loading market...";
	showView('#scoreboard');
	$.ajax({ url: "ajax_scoreboard.php"}).done(function( msg ) {
    		document.getElementById("scoreboard").innerHTML = msg;
	});
}

function openMarket() {
    	document.getElementById("marketplace").innerHTML = "Loading market...";
	showView('#marketplace');
	$.ajax({ url: "ajax_market.php"}).done(function( msg ) {
    		document.getElementById("marketplace").innerHTML = msg;
	});
}

function openInventory() {
    	document.getElementById("inventory").innerHTML = "Loading inventory...";
	showView('#inventory');
	$.ajax({ url: "ajax_inventory.php"}).done(function( msg ) {
    		document.getElementById("inventory").innerHTML = msg;
	});
}

function minionCollectGoods(subtype,goonPip) {
	if (subtype == "collect_from_goon") {
    	document.getElementById("min"+goonPip).innerHTML = "<span>Moving goods to storage..</span>";
	$.ajax({ url: "ajax_collect.php?minion="+goonPip+"&type="+subtype}).done(function( msg ) {
    		document.getElementById("min"+goonPip).innerHTML = "<span>Moving goods to storage..</span>";
	});
	}
	if (subtype == "ach_claimed") {
    	document.getElementById("achievements").innerHTML = "Moving rewards to storage..";
	$.ajax({ url: "ajax_collect.php?minion="+goonPip+"&type="+subtype});
	}
}

function gearupGoonWear(goonPip,item) {
    	document.getElementById("gearup").innerHTML = "Loading...";
	$.ajax({ url: "ajax_gearup.php?minion="+goonPip+"&item="+item});
}

function gearupGoonUnwear(goonPip,item) {
    	document.getElementById("gearup").innerHTML = "Loading...";
	$.ajax({ url: "ajax_gearup.php?minion="+goonPip+"&uitem="+item});
}

function gearupGoon(goonPip) {
	showView('#gearup');
    	document.getElementById("gearup").innerHTML = "Loading...";
	$.ajax({ url: "ajax_gearup.php?minion="+goonPip});
}

function showView(focusview) {
	$("div#taskassign").hide();
	$(".maingameTabs").hide();
	$("div"+focusview).show();
	$(".sidemenu a").removeClass("active");
	$(".sidemenu a#link_"+focusview.replace("#","")).addClass("active");
	var sound = new Howl({
	  urls: ['/media/sfx/paper.mp3']
	}).play();
	refreshXP();
}

function toggleMusic() {
var audioPlayer = document.getElementsByTagName('audio')[0];
            if (audioPlayer.paused) {
                audioPlayer.play();
            } else {
                audioPlayer.pause();
            }
}

refreshXP();

var source;

if(typeof(EventSource)!=="undefined")
  {
  source=new EventSource("game.php");

	source.addEventListener('message', function(e) {
	  	var data = JSON.parse(e.data);
    		document.getElementById("result").innerHTML = data.feedback;
	}, false);
	source.addEventListener('inventory', function(e) {
	  var data = JSON.parse(e.data);
    		document.getElementById("inventory").innerHTML = data.html;
	}, false);

	source.addEventListener('achievements', function(e) {
	  	var data = JSON.parse(e.data);
    		document.getElementById("achievements").innerHTML = data.html;
	}, false);


	source.addEventListener('gearup', function(e) {
	  	var data = JSON.parse(e.data);
    		document.getElementById("gearup").innerHTML = data.html;
	}, false);
  }
else
  {
  document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
  }

function performAct(pip, actName){
	$("div#taskassign").hide();
if (pip == -1) {
    		document.getElementById("result").innerHTML = "Loading...";
}
$.ajax({
  url: "action.php?act="+actName+"&minion="+pip,
  context: document.body
}).done(function( msg ) {
    		document.getElementById("min"+pip).innerHTML = msg.data;
	});
  }
</script>

</head>
<body style="height:100%">
<table style="width:100%;margin:0px;height:100%" cellspacing=0 cellpadding=0><tr><td valign=top width=200>
<div id="profile" class="sidemenu" style="padding-left:10px;padding-top:10px;">
<?include('modules/sidemenu_profile.php');?>
&nbsp;
<a href="<?echo $logoutUrl?>" style="display:block">Log out</a>
<a href="#" onClick='toggleMusic()' style="display:block">Toggle music</a>

<?

if (isAdmin()) {
echo '<a href="/admin" target="_BLANK" style="display:block">Admin panel</a>';
}
echo '<a href="http://www.facebook.com/merchantsrpg" target="_BLANK" style="display:block">Merchants on Facebook</a>';

?>
</div>
<td valign=top class="parch" style="padding:8px">
<div id="taskassign" style="display:none"></div>
<div id="result" class="maingameTabs" style="min-height:200px;"></div>
<div id="inventory" class="maingameTabs" style="display:none"></div>
<div id="gearup" class="maingameTabs" style="display:none;">howdy</div>
<div id="achievements" class="maingameTabs" style="display:none"></div>
<div id="marketplace" class="maingameTabs" style="display:none"></div>
<div id="scoreboard" class="maingameTabs" style="display:none"></div>
<div id="quests" class="maingameTabs" style="display:none"></div>
<div id="crafting" class="maingameTabs" style="display:none"></div>
<div id="skills" class="maingameTabs" style="display:none"></div>


</table>
<?
	include('modules/music.php');
?>
</body>
</html>