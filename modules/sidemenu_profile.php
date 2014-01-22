
<table><tr><td width=10>
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture" style="height:50px;width:50px;border:1px solid black;">
<td valign=bottom>
<?
$username = $_SESSION['userdata']['fb']['name'];
echo $username;
?>
<div id="level">Level 1</div>
</table>

<div id="xp" style="text-align:center;font-size:10px;padding:4px">0 XP left to level up</div>

<a href="#" onClick="showView('#result')" id="link_result" class="active segment"><img src="/media/icons/goons.png">Servants</a>
<a href="#" onClick="openHeroes()" id="link_heroes"  class="segment"><img src="/media/icons/heroes.png">Encounters</a>
<a href="#" onClick="openInventory()" id="link_inventory"  class="segment"><img src="/media/icons/inventory.png">Inventory</a>
<a href="#" onClick="openSkills()" id="link_skills" class="segment"><img src="/media/icons/skills.png">Skills</a>
<a href="#" onClick="openCrafting();showView('#crafting')" id="link_crafting" class="segment"><img src="/media/icons/craft.png">Crafting</a>
<a href="#" onClick="openMarket();" id="link_marketplace" class="segment"><img src="/media/icons/market.png">Marketplace</a>
<a href="#" onClick="openAuction();" id="link_auction" class="segment"><img src="/media/icons/auction.png">Trading house</a>
<a href="#" onClick="openQuests();" id="link_quests" class="segment"><img src="/media/icons/missions.png">Quests</a>
<a href="#" onClick="openAchievements();" id="link_achievements" class="segment"><img src="/media/icons/achievements.png"><span id="achievements_badge">Achievements</span></a>
<a href="#" onClick="openScores();" id="link_scoreboard" class="segment"><img src="/media/icons/leader_on.png">Scoreboard</a>