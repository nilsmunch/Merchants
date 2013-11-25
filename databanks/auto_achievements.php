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
    'prerequisite' => 'ach_2_fish_drysalmon',
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
    'prerequisite' => 'ach_1_wool',
  ),
); ?>