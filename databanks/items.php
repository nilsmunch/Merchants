<?

include('auto_items.php');

$itembank = $lib_items;

$itembank['xp'] = array('name'=>'Experience points','itemclass'=>'currency','artfile'=>'xp.png','name_plural'=>'Experience points');

$itembank['gold'] = array('name'=>'Gold coins','itemclass'=>'currency','artfile'=>'coins.png','name_plural'=>'Gold coins');

$itembank['tool_loom'] = array('name'=>'Wooden loom','artfile'=>'loom.png','skillgrant'=>'looming',
    'entrypoint_market' => '1',
    'market_price' => '25',
    'storekey' => 'tool');

$itembank['sickle_bonusherb'] = array('name'=>'Silver sickle','artfile'=>'sickle.png','skillgrant'=>'passive','gather_boost_herb'=>25);

$itembank['tool_sowingkit'] = array('name'=>'Basic sowing kit','artfile'=>'sowingkit_simple.png','skillgrant'=>'tailoring',
    'entrypoint_market' => '1',
    'market_price' => '25',
    'storekey' => 'tool');

?>