<? global $lib_achievements; $lib_achievements = array (
  'ach_1_pumpkin' => 
  array (
    'name' => 'Squish squash',
    'artfile' => '0106_pumpkin_512.png',
    'listener' => 'collected_pumpkin',
    'formulation' => 'Collect XX Wild Pumpkin',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_pumpkin',
  ),
  'ach_1_topaz' => 
  array (
    'name' => 'Topatastic!',
    'artfile' => 'SappireCrystal04.png',
    'listener' => 'collected_topaz',
    'formulation' => 'Collect XX Raw topaz',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_topaz',
  ),
  'ach_craft1_essence_fire' => 
  array (
    'name' => 'Pyrotechnician',
    'artfile' => 'Fireball.png',
    'listener' => 'craftspent_essence_fire',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Essence of Fire on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_essence_fire',
  ),
  'ach_1_wool' => 
  array (
    'name' => 'Muttonchops',
    'artfile' => 'Hoot_03.png',
    'listener' => 'collected_wool',
    'formulation' => 'Collect XX Wool cloth',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_wool',
  ),
  'ach_2_wool' => 
  array (
    'name' => 'Fluffy covers',
    'artfile' => 'LeatherPiece_01.png',
    'listener' => 'collected_wool',
    'formulation' => 'Collect XX Wool cloth',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_wool',
    'chain' => 'gather_wool',
  ),
  'ach_craft1_fish_drysalmon' => 
  array (
    'name' => 'A fishy feast',
    'artfile' => '0064_fish_512.png',
    'listener' => 'craftspent_fish_drysalmon',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Salmon on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_fish_drysalmon',
  ),
  'ach_craft2_fish_drysalmon' => 
  array (
    'name' => 'Hooked on a feeling',
    'artfile' => '0064_fish_512.png',
    'listener' => 'craftspent_fish_drysalmon',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Salmon on crafts',
    'reward' => 
    array (
      'type' => 'copperhook',
      'qty' => '1',
    ),
    'prerequisite' => 'ach_craft2_fish_drysalmon',
    'listener_min' => 500,
    'chain' => 'craft_fish_drysalmon',
  ),
  'ach_1_fish_drysalmon' => 
  array (
    'name' => 'Put and take',
    'artfile' => '0064_fish_512.png',
    'listener' => 'collected_fish_drysalmon',
    'formulation' => 'Collect XX Salmon',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_fish_drysalmon',
  ),
  'ach_2_fish_drysalmon' => 
  array (
    'name' => 'Hook, line and sinker',
    'artfile' => 'spiderweb_512.png',
    'listener' => 'collected_fish_drysalmon',
    'formulation' => 'Collect XX Salmon',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_fish_drysalmon',
    'chain' => 'gather_fish_drysalmon',
  ),
  'ach_3_fish_drysalmon' => 
  array (
    'name' => 'Salty Sailor',
    'artfile' => 'net_512.png',
    'listener' => 'collected_fish_drysalmon',
    'formulation' => 'Collect XX Salmon',
    'reward' => 
    array (
      'type' => 'lure_bright',
      'qty' => '1',
    ),
    'listener_min' => 500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_fish_drysalmon',
    'chain' => 'gather_fish_drysalmon',
  ),
  'ach_1_apple' => 
  array (
    'name' => 'Apples and pears',
    'artfile' => 'basket_fruits.png',
    'listener' => 'collected_apple',
    'formulation' => 'Collect XX Juicy apple',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_apple',
  ),
  'ach_2_apple' => 
  array (
    'name' => 'Fruity fortunes',
    'artfile' => 'fruit_felronanpumpkin.jpg',
    'listener' => 'collected_apple',
    'formulation' => 'Collect XX Juicy apple',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_apple',
    'chain' => 'gather_apple',
  ),
  'ach_3_apple' => 
  array (
    'name' => 'Gardens of Idunn',
    'artfile' => 'LifeFruit.png',
    'listener' => 'collected_apple',
    'formulation' => 'Collect XX Juicy apple',
    'reward' => 
    array (
      'type' => 'fruitcap',
      'qty' => '1',
    ),
    'listener_min' => 500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_apple',
    'chain' => 'gather_apple',
  ),
  'ach_craft1_berry_wild' => 
  array (
    'name' => 'Berry nice',
    'artfile' => 'Berry_02.png',
    'listener' => 'craftspent_berry_wild',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Ravenberry on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_berry_wild',
  ),
  'ach_1_berry_wild' => 
  array (
    'name' => 'Berrylicious',
    'artfile' => 'Berry_01.png',
    'listener' => 'collected_berry_wild',
    'formulation' => 'Collect XX Ravenberry',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_berry_wild',
  ),
  'ach_craft1_herb' => 
  array (
    'name' => 'Bushwhacker',
    'artfile' => 'herbs.png',
    'listener' => 'craftspent_herb',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Sunweed on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_herb',
  ),
  'ach_1_herb' => 
  array (
    'name' => 'First pickings',
    'artfile' => 'FlowerBunch_03.png',
    'listener' => 'collected_herb',
    'formulation' => 'Collect XX Sunweed',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_herb',
  ),
  'ach_2_herb' => 
  array (
    'name' => 'Plick pluckery',
    'artfile' => 'FlowerBunch_01.png',
    'listener' => 'collected_herb',
    'formulation' => 'Collect XX Sunweed',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_herb',
    'chain' => 'gather_herb',
  ),
  'ach_3_herb' => 
  array (
    'name' => 'Deforestation',
    'artfile' => 'FlowerBunch_02.png',
    'listener' => 'collected_herb',
    'formulation' => 'Collect XX Sunweed',
    'reward' => 
    array (
      'type' => 'poti_plucker',
      'qty' => '1',
    ),
    'listener_min' => 500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_herb',
    'chain' => 'gather_herb',
  ),
  'ach_4_herb' => 
  array (
    'name' => 'Herbal vendetta',
    'artfile' => 'bag_bagofallowances.jpg',
    'listener' => 'collected_herb',
    'formulation' => 'Collect XX Sunweed',
    'reward' => 
    array (
      'type' => 'herbtool_satchel',
      'qty' => '1',
    ),
    'listener_min' => 1500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_3_herb',
    'chain' => 'gather_herb',
  ),
  'ach_1_whispertail' => 
  array (
    'name' => 'Whisperpicker',
    'artfile' => '0013_flowers_512.png',
    'listener' => 'collected_whispertail',
    'formulation' => 'Collect XX Whispertail',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_whispertail',
  ),
  'ach_craft1_wood_oak' => 
  array (
    'name' => 'Craftsman\'s Log',
    'artfile' => 'wood_pieces_512.png',
    'listener' => 'craftspent_wood_oak',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Oakwood on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_wood_oak',
  ),
  'ach_1_wood_oak' => 
  array (
    'name' => 'Barking glad',
    'artfile' => 'skill_nature_barkskin.jpg',
    'listener' => 'collected_wood_oak',
    'formulation' => 'Collect XX Oakwood',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_wood_oak',
  ),
  'ach_2_wood_oak' => 
  array (
    'name' => 'All kids loves log',
    'artfile' => 'wood_felchwood.jpg',
    'listener' => 'collected_wood_oak',
    'formulation' => 'Collect XX Oakwood',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_wood_oak',
    'chain' => 'gather_wood_oak',
  ),
  'ach_3_wood_oak' => 
  array (
    'name' => 'Keep up trunking',
    'artfile' => 'wood_pine.jpg',
    'listener' => 'collected_wood_oak',
    'formulation' => 'Collect XX Oakwood',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 100,
    ),
    'listener_min' => 500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_wood_oak',
    'chain' => 'gather_wood_oak',
  ),
  'ach_1_obsidian' => 
  array (
    'name' => 'No water nor lava',
    'artfile' => 'Gem_Grade_01_Black.png',
    'listener' => 'collected_obsidian',
    'formulation' => 'Collect XX Obsidian',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_obsidian',
  ),
  'ach_2_obsidian' => 
  array (
    'name' => 'Fade to black',
    'artfile' => 'Gem_Grade_02_Black.png',
    'listener' => 'collected_obsidian',
    'formulation' => 'Collect XX Obsidian',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_obsidian',
    'chain' => 'gather_obsidian',
  ),
  'ach_1_copper' => 
  array (
    'name' => 'Bronze tan',
    'artfile' => 'Scales_03.png',
    'listener' => 'collected_copper',
    'formulation' => 'Collect XX Copper nugget',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_copper',
  ),
  'ach_craft1_iron' => 
  array (
    'name' => 'Metal fan',
    'artfile' => 'Rock_02.png',
    'listener' => 'craftspent_iron',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Iron nugget on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_iron',
  ),
  'ach_1_iron' => 
  array (
    'name' => 'The 9 iron',
    'artfile' => 'Rock_02.png',
    'listener' => 'collected_iron',
    'formulation' => 'Collect XX Iron nugget',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_iron',
  ),
  'ach_2_iron' => 
  array (
    'name' => 'Magnetic fingers',
    'artfile' => 'Rock_02.png',
    'listener' => 'collected_iron',
    'formulation' => 'Collect XX Iron nugget',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_iron',
    'chain' => 'gather_iron',
  ),
  'ach_3_iron' => 
  array (
    'name' => 'Heavy Metals',
    'artfile' => 'Rock_02.png',
    'listener' => 'collected_iron',
    'formulation' => 'Collect XX Iron nugget',
    'reward' => 
    array (
      'type' => 'mining_box',
      'qty' => '1',
    ),
    'listener_min' => 500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_iron',
    'chain' => 'gather_iron',
  ),
  'ach_4_iron' => 
  array (
    'name' => 'True Metals',
    'artfile' => 'Rock_02.png',
    'listener' => 'collected_iron',
    'formulation' => 'Collect XX Iron nugget',
    'reward' => 
    array (
      'type' => 'dwarven_leggings',
      'qty' => '1',
    ),
    'listener_min' => 1500,
    'category' => 'Gathering',
    'prerequisite' => 'ach_3_iron',
    'chain' => 'gather_iron',
  ),
  'ach_craft1_goldnugget' => 
  array (
    'name' => 'Gold grifter',
    'artfile' => 'CrownEpic.png',
    'listener' => 'craftspent_goldnugget',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Gold nugget on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_goldnugget',
  ),
  'ach_1_goldnugget' => 
  array (
    'name' => 'Gold digger Junior',
    'artfile' => 'metal_goldennugget.jpg',
    'listener' => 'collected_goldnugget',
    'formulation' => 'Collect XX Gold nugget',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 20,
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
    'chain' => 'gather_goldnugget',
  ),
  'ach_2_goldnugget' => 
  array (
    'name' => 'Klondyke',
    'artfile' => 'metal_goldennugget.jpg',
    'listener' => 'collected_goldnugget',
    'formulation' => 'Collect XX Gold nugget',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => 50,
    ),
    'listener_min' => 100,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_goldnugget',
    'chain' => 'gather_goldnugget',
  ),
  'ach_craft1_basespice' => 
  array (
    'name' => 'Currylicious',
    'artfile' => 'oiltank.png',
    'listener' => 'craftspent_basespice',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Common spices on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_basespice',
  ),
  'ach_craft2_basespice' => 
  array (
    'name' => 'The spice must flow',
    'artfile' => 'oiltank.png',
    'listener' => 'craftspent_basespice',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Common spices on crafts',
    'reward' => 
    array (
      'type' => 'infinitecurry',
      'qty' => '1',
    ),
    'prerequisite' => 'ach_craft2_basespice',
    'listener_min' => 500,
    'chain' => 'craft_basespice',
  ),
  'ach_craft1_dye_blue' => 
  array (
    'name' => 'Paint me blue',
    'artfile' => 'AquamarineGem01.png',
    'listener' => 'craftspent_dye_blue',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Blue dye on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_dye_blue',
  ),
  'ach_craft1_honey' => 
  array (
    'name' => 'The bee\'s knees',
    'artfile' => 'jar_honey.png',
    'listener' => 'craftspent_honey',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Honey on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_honey',
  ),
  'ach_craft1_sugar' => 
  array (
    'name' => 'Sugar daddy',
    'artfile' => 'candy_rasp.jpg',
    'listener' => 'craftspent_sugar',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Sugar on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_sugar',
  ),
  'ach_craft1_citrine_polished' => 
  array (
    'name' => 'Shardbreaker',
    'artfile' => 'IceBolt.png',
    'listener' => 'craftspent_citrine_polished',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Raw citrine on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
    'chain' => 'craft_citrine_polished',
  ),
); ?>