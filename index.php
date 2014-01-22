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

var musicDisabled;

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
	$.ajax({ url: "ajax_xp_level.php"}).done(function( msg ) {
    		document.getElementById("level").innerHTML = msg;
	});
}

function refreshServants() {
	$.ajax({ url: "ajax_servants.php"}).done(function( msg ) {
    		document.getElementById("result").innerHTML = msg;
	});
}


function openHeroes(action,target) {
	showView('#heroes');
	$.ajax({ url: "ajax_heroes.php?action="+action+"&target="+target}).done(function( msg ) {
    		document.getElementById("heroes").innerHTML = msg;
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

function openAuction() {
    	document.getElementById("marketplace").innerHTML = "Loading market...";
	showView('#auction');
	auctionhouseAction();
}

function auctionhouseAction(action,target,detail,secondary,currency) {
	$.ajax({ url: "ajax_auctionhouse.php?action="+action+"&target="+target+"&detail="+detail+"&secondary="+secondary+"&currency="+currency}).done(function( msg ) {
    		document.getElementById("auction").innerHTML = msg;
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
    		refreshServants();
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

function openAchievements() {
    document.getElementById("achievements").innerHTML = "Loading achievements...";
	showView('#achievements');
	$.ajax({ url: "ajax_achievements.php"}).done(function( msg ) {
    		document.getElementById("achievements").innerHTML = msg;
	});
}

function minionCollectGoods(subtype,goonPip) {
	if (subtype == "collect_from_goon") {
    	document.getElementById("min"+goonPip).innerHTML = "<a href='#'>Moving goods to storage..</a>";
	$.ajax({ url: "ajax_collect.php?minion="+goonPip+"&type="+subtype}).done(function( msg ) {
    		document.getElementById("min"+goonPip).innerHTML = "<a href='#'>Moving goods to storage..</a>";
	});
	}
	if (subtype == "ach_claimed") {
		$.ajax({ url: "ajax_collect.php?minion="+goonPip+"&type="+subtype}).done(function( msg ) {
    		openAchievements();
	});
	}
}

function gearupGoonWear(goonPip,item) {
    	document.getElementById("gearup").innerHTML = "Loading...";
	$.ajax({ url: "ajax_gearup.php?minion="+goonPip+"&item="+item}).done(function( msg ) {
    		document.getElementById("gearup").innerHTML = msg;
	});
}

function gearupGoonUnwear(goonPip,item) {
    	document.getElementById("gearup").innerHTML = "Loading...";
	$.ajax({ url: "ajax_gearup.php?minion="+goonPip+"&uitem="+item}).done(function( msg ) {
    		document.getElementById("gearup").innerHTML = msg;
	});
}

function gearupGoon(goonPip) {
	showView('#gearup');
    document.getElementById("gearup").innerHTML = "Loading...";
	$.ajax({ url: "ajax_gearup.php?minion="+goonPip}).done(function( msg ) {
    		document.getElementById("gearup").innerHTML = msg;
	});
}


function performAct(pip, actName){
	$("div#taskassign").hide();
	if (pip == -1) {
    		document.getElementById("result").innerHTML = "Loading...";
	}
	$.ajax({url: "action.php?act="+actName+"&minion="+pip, context: document.body}).done(function( msg ) {
		refreshServants();
	});
  }

function showView(focusview) {
	if (focusview == "#result") {refreshServants();}
	$("div#taskassign").hide();
	$(".maingameTabs").hide();
	$("div"+focusview).show();
	$(".sidemenu a").removeClass("active");
	$(".sidemenu a#link_"+focusview.replace("#","")).addClass("active");
	if (!musicDisabled) {
	var sound = new Howl({
	  urls: ['/media/sfx/paper.mp3']
	}).play();
	}
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


function toggleSFX() {
	musicDisabled = !musicDisabled;
}



refreshXP();
refreshServants();

var source;

if(typeof(EventSource)!=="undefined")
  {
  source=new EventSource("game.php");

	source.addEventListener('message', function(e) {
	  	var data = JSON.parse(e.data);
	  //	
		for (key in data) {
			if (data[key] != null && document.getElementById(key) != null) {
				document.getElementById(key).outerHTML = data[key];
			}
	  	}
	}, false);
	
	source.addEventListener('achievements', function(e) {
	  	var data = JSON.parse(e.data);
		document.getElementById("achievements_badge").innerHTML = data.badge;
	}, false);
  }
else
  {
  document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
  }
</script>

</head>
<body style="height:100%">
<table style="width:100%;margin:0px;height:100%;bottom:0px;" cellspacing=0 cellpadding=0><tr><td valign=top width=200>
<div id="profile" class="sidemenu" style="padding-top:10px;">
<?include('modules/sidemenu_profile.php');?>
&nbsp;
<a href="<?echo $logoutUrl?>" style="display:block">Log out</a>
<a href="#" onClick='toggleMusic()' style="display:block">Toggle music</a>
<a href="#" onClick='toggleSFX()' style="display:block">Toggle SFX</a>

<?

if (isAdmin()) {
echo '<a href="/admin" target="_BLANK" style="display:block">Admin panel</a>';
}


echo '<a href="http://merchantsrpg.com/bugreport/embed.php?owner=nilsmunch&repo=Merchants&token=merchaway" target="_BLANK" style="display:block">Report bug</a>';

echo '<a href="http://www.facebook.com/merchantsrpg" target="_BLANK" style="display:block">Merchants on Facebook</a>';

?>
</div>
<td valign=top class="parch">
<div id="taskassign" style="display:none;padding:8px"></div>
<div id="result" class="maingameTabs" style="min-height:200px;;padding:8px"></div>
<div id="inventory" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="heroes" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="gearup" class="maingameTabs" style="display:none;padding:8px;">howdy</div>
<div id="achievements" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="marketplace" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="scoreboard" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="quests" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="crafting" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="auction" class="maingameTabs" style="display:none;padding:8px"></div>
<div id="skills" class="maingameTabs" style="display:none;height:100%;background-color:#271f15;background-image:url('/media/art/backdrop_skills.jpg');background-position:center;background-repeat:no-repeat"></div>


</table>
<?
	include('modules/music.php');
?>
</body>
</html>