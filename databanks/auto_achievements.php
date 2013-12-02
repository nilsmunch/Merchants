<? global $lib_achievements; $lib_achievements = array (
  'ach_1_fish_drysalmon' => 
  array (
    'name' => 'Put and take',
    'artfile' => '0064_fish_512.png',
    'listener' => 'collected_fish_drysalmon',
    'formulation' => 'Collect XX Salmon',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '20',
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
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
      'qty' => '50',
    ),
    'listener_min' => 50,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_fish_drysalmon',
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
    'listener_min' => 250,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_fish_drysalmon',
  ),
  'ach_1_wood_oak' => 
  array (
    'name' => 'Barking glad',
    'artfile' => 'skill_nature_barkskin.jpg',
    'listener' => 'collected_wood_oak',
    'formulation' => 'Collect XX Oak wood',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '20',
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
  ),
  'ach_2_wood_oak' => 
  array (
    'name' => 'All kids loves log',
    'artfile' => 'wood_felchwood.jpg',
    'listener' => 'collected_wood_oak',
    'formulation' => 'Collect XX Oak wood',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 50,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_wood_oak',
  ),
  'ach_3_wood_oak' => 
  array (
    'name' => 'Keep up trunking',
    'artfile' => 'wood_pine.jpg',
    'listener' => 'collected_wood_oak',
    'formulation' => 'Collect XX Oak wood',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 250,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_wood_oak',
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
      'qty' => '20',
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
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
      'qty' => '50',
    ),
    'listener_min' => 50,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_apple',
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
    'listener_min' => 250,
    'category' => 'Gathering',
    'prerequisite' => 'ach_2_apple',
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
      'qty' => '20',
    ),
    'category' => 'Gathering',
    'listener_min' => 5,
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
      'qty' => '50',
    ),
    'listener_min' => 50,
    'category' => 'Gathering',
    'prerequisite' => 'ach_1_wool',
  ),
  'ach_craft1_herb' => 
  array (
    'name' => 'Bushwhacker',
    'artfile' => 'herbs.png',
    'listener' => 'craftspent_herb',
    'category' => 'Crafting',
    'formulation' => 'Spent XX Herbs on crafts',
    'reward' => 
    array (
      'type' => 'gold',
      'qty' => '50',
    ),
    'listener_min' => 100,
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
  ),
); ?>