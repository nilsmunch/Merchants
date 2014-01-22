<?
$perkbank = array();
$perkbank[0] = array('title'=>'Dispatcher','artfile'=>'0073_outdoor_path_512.png','depend'=>array(),'bonus'=>'travelspeed_shorten_percent','value'=>1);

$perkbank[1] = array('title'=>'Botanist','artfile'=>'FlowerBunch_03.png','depend'=>array('0'),'bonus'=>'gather_boost_herb','value'=>5,'skillup'=>'looming');

$perkbank[2] = array('title'=>'Potionmaster','depend'=>array(1),'artfile'=>'Potion_01.png','bonus'=>'alchemy_shorten_percent','value'=>5,'skillup'=>'alchemy');

$perkbank[3] = array('title'=>'Woodsman','artfile'=>'Wood_03.png','bonus'=>'gather_boost_lumbering','value'=>5,'depend'=>array(1));
$perkbank[4] = array('title'=>'Fletcher','artfile'=>'0079_scout_abilities_512.png','depend'=>array(3),'skillup'=>'carving');
$perkbank[5] = array('title'=>'Cartographer','depend'=>array('0'),'artfile'=>'Treasuremap.png','bonus'=>'scrollmaking_shorten_percent','value'=>5,'skillup'=>'scrollmaking');
$perkbank[6] = array('title'=>'Cobbler','artfile'=>'WarriorShoes_2.png','depend'=>array(5),'bonus'=>'tailoring_shorten_percent','value'=>5,'skillup'=>'tailoring');
$perkbank[7] = array('title'=>'Riverman','depend'=>array(0),'artfile'=>'fish_512.png','bonus'=>'gather_boost_fishing','value'=>5);
$perkbank[8] = array('title'=>'Tracker','depend'=>array(7),'artfile'=>'tracking_512.png','bonus'=>'hunting_shorten_percent','value'=>5);
$perkbank[9] = array('title'=>'Skinner','artfile'=>'carapace_512.png','depend'=>array(8),'bonus'=>'gather_boost_hunting','value'=>5,'skillup'=>'leatherworking');
$perkbank[10] = array('title'=>'Forager','depend'=>array(0),'artfile'=>'Agriculture.png','bonus'=>'gather_boost_fruitpicking','value'=>5);

$perkbank[11] = array('title'=>'Faun','artfile'=>'qualitygrain.png','depend'=>array(10),'bonus'=>'rare_find_fruitpicking','value'=>5);
$perkbank[12] = array('title'=>'Keeper','artfile'=>'0069_horse_512.png','depend'=>array(),'bonus'=>'gather_boost_animalhusbandry','value'=>5);


$perkbank[13] = array('title'=>'Breeder','artfile'=>'eggs_512.png','depend'=>array(12),'bonus'=>'rare_find_animalhusbandry','value'=>5);
$perkbank[14] = array('title'=>'Grand chef','artfile'=>'cooking_512.png','bonus'=>'cooking_shorten_percent','value'=>5,'skillup'=>'cooking','depend'=>array(13,11));
$perkbank[15] = array('title'=>'Butcher','artfile'=>'deathproof_ratteeth.jpg','depend'=>array(14),'bonus'=>'rare_find_hunting','value'=>5);
$perkbank[16] = array('title'=>'Barkeep','artfile'=>'beer_harvestale.jpg','bonus'=>'brewery_shorten_percent','value'=>5,'skillup'=>'brewery','depend'=>array(14));


$perkbank[17] = array('title'=>'Storeroom vendor','artfile'=>'cage_512.png','depend'=>array(),'bonus'=>'ah_slots','value'=>2);
$perkbank[18] = array('title'=>'Miner','artfile'=>'MetalOre_02.png','depend'=>array(17),'bonus'=>'mining_shorten_percent','value'=>5);
$perkbank[19] = array('title'=>'Geologist','artfile'=>'protectioncrystal.png','depend'=>array(18),'bonus'=>'rare_find_mining','value'=>5,'skillup'=>'gemcutting');
$perkbank[20] = array('title'=>'Mason','artfile'=>'Rock_01.png','depend'=>array(17),'bonus'=>'masonry_shorten_percent','value'=>5,'skillup'=>'runecarver');
$perkbank[21] = array('title'=>'Metallurgist','artfile'=>'Mining.png','depend'=>array(18,20),'bonus'=>'blacksmithing_shorten_percent','value'=>5,'skillup'=>'blacksmithing');
$perkbank[22] = array('title'=>'Inventor','artfile'=>'gears_512.png','depend'=>array(21),'bonus'=>'engineering_shorten_percent','value'=>5,'skillup'=>'engineering');

$perkbank[23] = array('title'=>'Arcanist','artfile'=>'SuperBuoyancyDevice.png','depend'=>array(),'bonus'=>'arcanism_shorten_percent','value'=>5,'skillup'=>'arcanism');

$perkbank[24] = array('title'=>'Elegance','artfile'=>'MageGlove_4.png','depend'=>array(23),'bonus'=>'jewelcrafting_shorten_percent','value'=>5,'skillup'=>'jewelcrafting');
$perkbank[25] = array('title'=>'Jack of all trades','artfile'=>'LandDetect.png');


?>