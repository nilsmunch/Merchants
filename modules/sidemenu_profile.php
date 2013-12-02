
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

<a href="#" onClick="showView('#result')" id="link_result" class="active" style="display:block"><img src="/media/art/button_hirelings.png">Servants</a>
<a href="#" onClick="openInventory()" id="link_inventory" style="display:block"><img src="/media/art/button_bag.png">Inventory</a>
<a href="#" onClick="openSkills()" id="link_skills" style="display:block"><img src="/media/art/icon_skills.png">Skills</a>
<a href="#" onClick="openCrafting();showView('#crafting')" id="link_crafting" style="display:block"><img src="/media/art/button_craft.png">Crafting</a>
<a href="#" onClick="openMarket();" id="link_marketplace" style="display:block"><img src="/media/art/button_market.png">Marketplace</a>
<a href="#" onClick="openAuction();" id="link_auction" style="display:block"><img src="/media/art/button_market.png">AuctionHouse</a>
<a href="#" onClick="openQuests();" id="link_quests" style="display:block"><img src="/media/art/button_quests.png">Quests</a>
<a href="#" onClick="showView('#achievements')" id="link_achievements" style="display:block"><img src="/media/art/button_ach.png">Achievements</a>
<a href="#" onClick="openScores();" id="link_scoreboard" style="display:block"><img src="/media/art/button_highscore.png">Scoreboard</a>