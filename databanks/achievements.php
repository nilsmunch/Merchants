<?

include('auto_achievements.php');
$achievementsbank = $lib_achievements;

if ($g['lifetime']['minions_hired'] == 0) {$g['lifetime']['minions_hired'] = 1;}

$achievementsbank['10herbs'] = array('name'=>'First pickings','artfile'=>'FlowerBunch_03.png', 'listener'=>'collected_herb','listener_min'=>10,'reward'=>array('type'=>'gold','qty'=>'20'));


$achievementsbank['15herbs'] = array('name'=>'Baby steps','artfile'=>'candle_512.png','listener'=>'collected_herb','listener_min'=>15,'reward'=>array('type'=>'tool_loom','qty'=>'1'));


$achievementsbank['3hemp'] = array('name'=>'Need teaches','prerequisite'=>'15herbs','artfile'=>'shredded_material_512.png' ,'listener'=>'collected_cloth_hemp','listener_min'=>3,'reward'=>array('type'=>'tool_sowingkit','qty'=>'1'));


$achievementsbank['10hemp'] = array('name'=>'Fabric of society','listener'=>'collected_cloth_hemp','prerequisite'=>'3hemp','artfile'=>'Linen_00.png','listener_min'=>10,'reward'=>array('type'=>'sickle_bonusherb','qty'=>'1'));

$achievementsbank['50herbs'] = array('name'=>'Blushing bushels','listener'=>'collected_herb','artfile'=>'FlowerBunch_01.png','listener_min'=>50,'prerequisite'=>'10herbs','reward'=>array('type'=>'gold','qty'=>'50'));

$achievementsbank['100herbs'] = array('name'=>'Deforestation','artfile'=>'FlowerBunch_01.png','listener'=>'collected_herb','listener_min'=>100,'prerequisite'=>'50herbs','reward'=>array('type'=>'gold','qty'=>'50'));


$achievementsbank['3servants'] = array('name'=>'Three\'s company','artfile'=>'0040_holyman_512.png','listener'=>'minions_hired','listener_min'=>3,'reward'=>array('type'=>'gold','qty'=>'25'));

$achievementsbank['cheese_5'] = array('name'=>'Some crackers would do nicely','artfile'=>'cheese_512.png','listener'=>'tasted_cheeses_types','listener_min'=>5,'reward'=>array('type'=>'gold','qty'=>'50'));

$achievementsbank['foodxp_500'] = array('name'=>'Hearty eater','artfile'=>'cooking_512.png','listener'=>'xpgained_consume_food','listener_min'=>500,'reward'=>array('type'=>'gold','qty'=>'50'));

$achievementsbank['xmas_10tokens'] = array('name'=>'Naughty or Nice','artfile'=>'RecruitmentOrder.png',
    'formulation' => 'Collect XX of the random Yuletide token drops.' ,'listener'=>'gifted_yuletide','listener_min'=>10,'reward'=>array('type'=>'xmas_cloak','qty'=>'1'));



?>