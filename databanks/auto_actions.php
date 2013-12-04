<? global $lib_actions; $lib_actions = array (
  'finding_fish_drysalmon' => 
  array (
    'title' => 'Go fishing in the City River',
    'time' => '30',
    'itemgain' => 'fish_drysalmon',
    'gearneed' => 'fishing',
    'transitive' => 'Fishing for salmon',
  ),
  'finding_fish_drysalmon_3' => 
  array (
    'title' => 'Go fishing in the Silverling Lake',
    'qty' => 7,
    'time' => 270,
    'itemgain' => 'fish_drysalmon',
    'taskart' => 'action_silverlinglake.png',
    'gearneed' => 'fishing',
    'transitive' => 'Fishing for salmon',
  ),
  'finding_fish_drysalmon_4' => 
  array (
    'title' => 'Go fishing in the Thunderdusk Docks',
    'qty' => 21,
    'time' => 750,
    'itemgain' => 'fish_drysalmon',
    'taskart' => 'action_thunderduskdocks.png',
    'gearneed' => 'fishing',
    'transitive' => 'Fishing for salmon',
  ),
  'finding_fish_drysalmon_5' => 
  array (
    'title' => 'Go fishing in the Blackbite Sea',
    'qty' => 30,
    'time' => 990,
    'itemgain' => 'fish_drysalmon',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'fishing',
    'transitive' => 'Fishing for salmon',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 2,
      ),
    ),
  ),
  'crafting_prety_carpet' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'prety_carpet',
    'gearneed' => 'tailoring',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'cloth_hemp',
        'cost' => 5,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'yarn_simple',
        'cost' => 1,
      ),
      2 => 
      array (
        'type' => 'itemqty',
        'item' => 'dye_blue',
        'cost' => 1,
      ),
    ),
  ),
  'finding_wood_oak' => 
  array (
    'title' => 'Lumber oak in City Outskirts',
    'time' => '60',
    'itemgain' => 'wood_oak',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'finding_wood_oak_6' => 
  array (
    'title' => 'Lumber oak in Brokewater Forest',
    'qty' => 7,
    'time' => 540,
    'itemgain' => 'wood_oak',
    'taskart' => 'action_silverlinglake.png',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
  ),
  'finding_wood_oak_7' => 
  array (
    'title' => 'Lumber oak in Thousand Oaks',
    'qty' => 21,
    'time' => 1500,
    'itemgain' => 'wood_oak',
    'taskart' => 'action_thunderduskdocks.png',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
  ),
  'finding_wood_oak_8' => 
  array (
    'title' => 'Lumber oak in Farcreek',
    'qty' => 36,
    'time' => 2760,
    'itemgain' => 'wood_oak',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 1,
      ),
    ),
  ),
  'finding_wood_oak_9' => 
  array (
    'title' => 'Lumber oak in Spiderling Woods',
    'qty' => 30,
    'time' => 1980,
    'itemgain' => 'wood_oak',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 2,
      ),
    ),
  ),
  'finding_wood_oak_10' => 
  array (
    'title' => 'Lumber oak in the Darks of Dunkelberg',
    'qty' => 60,
    'time' => 3600,
    'itemgain' => 'wood_oak',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 3,
      ),
    ),
  ),
  'finding_wood_oak_11' => 
  array (
    'title' => 'Lumber oak in Living Forest of Qurash',
    'qty' => 120,
    'time' => 6600,
    'itemgain' => 'wood_oak',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'lumbering',
    'transitive' => 'Cutting down oak trees',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 4,
      ),
    ),
  ),
  'finding_apple' => 
  array (
    'title' => 'Pick apples in City Gardens',
    'time' => '25',
    'itemgain' => 'apple',
    'gearneed' => 'fruitpicking',
    'transitive' => 'Picking apples',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'finding_apple_0' => 
  array (
    'title' => 'Pick apples in Windy Vineyards',
    'qty' => 5,
    'time' => 150,
    'itemgain' => 'apple',
    'taskart' => NULL,
    'gearneed' => 'fruitpicking',
    'transitive' => 'Picking apples',
  ),
  'finding_apple_1' => 
  array (
    'title' => 'Pick apples in Creeky Woods',
    'qty' => 16,
    'time' => 500,
    'itemgain' => 'apple',
    'taskart' => NULL,
    'gearneed' => 'fruitpicking',
    'transitive' => 'Picking apples',
    'rare_chance' => 1,
    'rare_drop' => 'pumpkin',
  ),
  'finding_apple_2' => 
  array (
    'title' => 'Pick apples in Gallow Acres',
    'qty' => 34,
    'time' => 1000,
    'itemgain' => 'apple',
    'taskart' => 'action_gallowacres.png',
    'gearneed' => 'fruitpicking',
    'transitive' => 'Picking apples',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 1,
      ),
    ),
    'rare_chance' => 2,
    'rare_drop' => 'pumpkin',
  ),
  'crafting_salty_potion' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'salty_potion',
    'gearneed' => 'alchemy',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'herb',
        'cost' => 5,
      ),
    ),
  ),
  'crafting_dust_weak' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'dust_weak',
    'gearneed' => 'arcanism',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'citrine_polished',
        'cost' => 1,
      ),
    ),
  ),
  'finding_stone_sandstone' => 
  array (
    'title' => 'Dig for sandstone',
    'time' => '75',
    'itemgain' => 'stone_sandstone',
    'gearneed' => 'masonry',
    'transitive' => 'Mining sandstone',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'crafting_herbpouch_masterwork' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'herbpouch_masterwork',
    'gearneed' => 'tailoring',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'cloth_hemp',
        'cost' => 5,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'yarn_simple',
        'cost' => 1,
      ),
    ),
  ),
  'finding_wool' => 
  array (
    'title' => 'Gather wool',
    'time' => '50',
    'itemgain' => 'wool',
    'gearneed' => 'animalhusbandry',
    'transitive' => 'Gathering wool',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'crafting_potion_oaktime' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'potion_oaktime',
    'gearneed' => 'alchemy',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'herb',
        'cost' => 3,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'apple',
        'cost' => 2,
      ),
    ),
  ),
  'finding_copper' => 
  array (
    'title' => 'Mine for copper',
    'time' => '35',
    'itemgain' => 'copper',
    'gearneed' => 'mining',
    'transitive' => 'Mining copper',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
    'rare_chance' => '10',
    'rare_drop' => 'citrine_polished',
  ),
  'finding_copper_12' => 
  array (
    'title' => 'Dig deep for copper',
    'qty' => 12,
    'time' => 385,
    'itemgain' => 'copper',
    'taskart' => NULL,
    'gearneed' => 'mining',
    'transitive' => 'Mining copper',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 1,
      ),
    ),
    'rare_chance' => 13,
    'rare_drop' => 'citrine_polished',
  ),
  'finding_herb' => 
  array (
    'title' => 'Gather herbs in City Outskirts',
    'time' => '15',
    'itemgain' => 'herb',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'finding_herb_6' => 
  array (
    'title' => 'Gather herbs in Brokewater Forest',
    'qty' => 7,
    'time' => 135,
    'itemgain' => 'herb',
    'taskart' => 'action_silverlinglake.png',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
  ),
  'finding_herb_7' => 
  array (
    'title' => 'Gather herbs in Thousand Oaks',
    'qty' => 21,
    'time' => 375,
    'itemgain' => 'herb',
    'taskart' => 'action_thunderduskdocks.png',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
    'rare_chance' => 1,
    'rare_drop' => 'herb_dracorns',
  ),
  'finding_herb_8' => 
  array (
    'title' => 'Gather herbs in Farcreek',
    'qty' => 36,
    'time' => 690,
    'itemgain' => 'herb',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 1,
      ),
    ),
    'rare_chance' => 2,
    'rare_drop' => 'herb_dracorns',
  ),
  'finding_herb_9' => 
  array (
    'title' => 'Gather herbs in Spiderling Woods',
    'qty' => 30,
    'time' => 495,
    'itemgain' => 'herb',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 2,
      ),
    ),
    'rare_chance' => 2,
    'rare_drop' => 'herb_dracorns',
  ),
  'finding_herb_10' => 
  array (
    'title' => 'Gather herbs in the Darks of Dunkelberg',
    'qty' => 60,
    'time' => 900,
    'itemgain' => 'herb',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 3,
      ),
    ),
    'rare_chance' => 2,
    'rare_drop' => 'herb_dracorns',
  ),
  'finding_herb_11' => 
  array (
    'title' => 'Gather herbs in Living Forest of Qurash',
    'qty' => 120,
    'time' => 1650,
    'itemgain' => 'herb',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'herbalism',
    'transitive' => 'Gathering herbs',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 4,
      ),
    ),
    'rare_chance' => 3,
    'rare_drop' => 'herb_dracorns',
  ),
  'crafting_xmas_honeybread' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'xmas_honeybread',
    'gearneed' => 'cooking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'honey',
        'cost' => 1,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'flour',
        'cost' => 1,
      ),
      2 => 
      array (
        'type' => 'itemqty',
        'item' => 'basespice',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_pomono_rune' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'pomono_rune',
    'gearneed' => 'runecarver',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'stone_sandstone',
        'cost' => 1,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'dust_weak',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_gem_citrine_pol' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'gem_citrine_pol',
    'gearneed' => 'gemcutting',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'citrine_polished',
        'cost' => 2,
      ),
    ),
  ),
  'crafting_gem_citrine_shin' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'gem_citrine_shin',
    'gearneed' => 'gemcutting',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'gem_citrine_pol',
        'cost' => 3,
      ),
    ),
  ),
  'crafting_xmas_crystalcandy' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'xmas_crystalcandy',
    'gearneed' => 'cooking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'sugar',
        'cost' => 3,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'honey',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_scroll_swift' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'scroll_swift',
    'gearneed' => 'scrollmaking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'parch_bleak',
        'cost' => 1,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'blue_ink',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_coppernails' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'coppernails',
    'gearneed' => 'blacksmithing',
    'qty' => '10',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'copper',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_neck_peasants' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'neck_peasants',
    'gearneed' => 'jewelcrafting',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'copper',
        'cost' => 3,
      ),
    ),
  ),
  'finding_pumpkin' => 
  array (
    'title' => '',
    'time' => '0',
    'itemgain' => 'pumpkin',
    'gearneed' => '',
    'transitive' => '',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'finding_herb_dracorns' => 
  array (
    'title' => '',
    'time' => '0',
    'itemgain' => 'herb_dracorns',
    'gearneed' => '',
    'transitive' => '',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'finding_topaz' => 
  array (
    'title' => '',
    'time' => '0',
    'itemgain' => 'topaz',
    'gearneed' => '',
    'transitive' => '',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'crafting_waterskin_light' => 
  array (
    'title' => '',
    'time' => 60,
    'itemgain' => 'waterskin_light',
    'gearneed' => 'leatherworking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'leather_rough',
        'cost' => 3,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'yarn_simple',
        'cost' => 1,
      ),
    ),
  ),
  'finding_iron' => 
  array (
    'title' => 'Mine for iron',
    'time' => '160',
    'itemgain' => 'iron',
    'gearneed' => 'mining',
    'transitive' => 'Mining iron',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '1',
      ),
    ),
    'rare_chance' => '10',
    'rare_drop' => 'topaz',
  ),
  'finding_iron_12' => 
  array (
    'title' => 'Dig deep for iron',
    'qty' => 12,
    'time' => 1760,
    'itemgain' => 'iron',
    'taskart' => NULL,
    'gearneed' => 'mining',
    'transitive' => 'Mining iron',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 2,
      ),
    ),
    'rare_chance' => 13,
    'rare_drop' => 'topaz',
  ),
  'crafting_food_bakedsalmon' => 
  array (
    'title' => '',
    'time' => 60,
    'itemgain' => 'food_bakedsalmon',
    'gearneed' => 'cooking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'fish_drysalmon',
        'cost' => 1,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'herb',
        'cost' => 2,
      ),
    ),
  ),
  'crafting_blue_ink' => 
  array (
    'title' => '',
    'time' => 60,
    'itemgain' => 'blue_ink',
    'gearneed' => 'alchemy',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'dye_blue',
        'cost' => 3,
      ),
    ),
  ),
  'crafting_leather_armor' => 
  array (
    'title' => '',
    'time' => 90,
    'itemgain' => 'leather_armor',
    'gearneed' => 'leatherworking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'leather_rough',
        'cost' => 6,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'yarn_simple',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_axe_copper' => 
  array (
    'title' => '',
    'time' => 120,
    'itemgain' => 'axe_copper',
    'gearneed' => 'blacksmithing',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'wood_oak',
        'cost' => 3,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'copper',
        'cost' => 4,
      ),
    ),
  ),
  'crafting_cider_apple' => 
  array (
    'title' => '',
    'time' => 120,
    'itemgain' => 'cider_apple',
    'gearneed' => 'brewery',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'apple',
        'cost' => 6,
      ),
    ),
  ),
  'crafting_cake_apple' => 
  array (
    'title' => '',
    'time' => 150,
    'itemgain' => 'cake_apple',
    'gearneed' => 'cooking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'apple',
        'cost' => 3,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'flour',
        'cost' => 1,
      ),
      2 => 
      array (
        'type' => 'itemqty',
        'item' => 'sugar',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_tool_arcanism' => 
  array (
    'title' => '',
    'time' => 300,
    'itemgain' => 'tool_arcanism',
    'gearneed' => 'gemcutting',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'gem_citrine_shin',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_tool_fishrod' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'tool_fishrod',
    'gearneed' => 'carving',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'wood_oak',
        'cost' => 2,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'yarn_simple',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_basespice' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'basespice',
    'gearneed' => 'cooking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'herb',
        'cost' => 2,
      ),
    ),
  ),
  'crafting_yarn_simple' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'yarn_simple',
    'gearneed' => 'looming',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'wool',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_bow_beginner' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'bow_beginner',
    'gearneed' => 'carving',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'wood_oak',
        'cost' => 3,
      ),
    ),
  ),
  'finding_leather_rough' => 
  array (
    'title' => 'Hunt for leather in City Outskirts',
    'time' => '45',
    'itemgain' => 'leather_rough',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => '0',
      ),
    ),
  ),
  'finding_leather_rough_6' => 
  array (
    'title' => 'Hunt for leather in Brokewater Forest',
    'qty' => 7,
    'time' => 405,
    'itemgain' => 'leather_rough',
    'taskart' => 'action_silverlinglake.png',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
  ),
  'finding_leather_rough_7' => 
  array (
    'title' => 'Hunt for leather in Thousand Oaks',
    'qty' => 21,
    'time' => 1125,
    'itemgain' => 'leather_rough',
    'taskart' => 'action_thunderduskdocks.png',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
  ),
  'finding_leather_rough_8' => 
  array (
    'title' => 'Hunt for leather in Farcreek',
    'qty' => 36,
    'time' => 2070,
    'itemgain' => 'leather_rough',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 1,
      ),
    ),
  ),
  'finding_leather_rough_9' => 
  array (
    'title' => 'Hunt for leather in Spiderling Woods',
    'qty' => 30,
    'time' => 1485,
    'itemgain' => 'leather_rough',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 2,
      ),
    ),
  ),
  'finding_leather_rough_10' => 
  array (
    'title' => 'Hunt for leather in the Darks of Dunkelberg',
    'qty' => 60,
    'time' => 2700,
    'itemgain' => 'leather_rough',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 3,
      ),
    ),
  ),
  'finding_leather_rough_11' => 
  array (
    'title' => 'Hunt for leather in Living Forest of Qurash',
    'qty' => 120,
    'time' => 4950,
    'itemgain' => 'leather_rough',
    'taskart' => 'action_blackbite.png',
    'gearneed' => 'hunting',
    'transitive' => 'Hunting',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'courage',
        'value' => 4,
      ),
    ),
  ),
  'crafting_parch_bleak' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'parch_bleak',
    'gearneed' => 'leatherworking',
    'qty' => '10',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'leather_rough',
        'cost' => 1,
      ),
    ),
  ),
  'crafting_loom_antasi' => 
  array (
    'title' => '',
    'time' => 180,
    'itemgain' => 'loom_antasi',
    'gearneed' => 'engineering',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'wood_oak',
        'cost' => 7,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'coppernails',
        'cost' => 2,
      ),
    ),
  ),
  'crafting_militia_helmet' => 
  array (
    'title' => '',
    'time' => 30,
    'itemgain' => 'militia_helmet',
    'gearneed' => 'leatherworking',
    'qty' => '1',
    'requirements' => 
    array (
      0 => 
      array (
        'type' => 'itemqty',
        'item' => 'leather_rough',
        'cost' => 3,
      ),
      1 => 
      array (
        'type' => 'itemqty',
        'item' => 'yarn_simple',
        'cost' => 1,
      ),
    ),
  ),
); ?>