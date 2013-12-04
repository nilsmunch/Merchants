<?

include('auto_items.php');

$itembank = $lib_items;

$itembank['gold'] = array('name'=>'Gold coins','artfile'=>'coins.png','name_plural'=>'Gold coins');

$itembank['tool_loom'] = array('name'=>'Wooden loom','artfile'=>'loom.png','skillgrant'=>'looming',
    'entrypoint_market' => '1',
    'market_price' => '25',
    'storekey' => 'tool');

$itembank['sickle_bonusherb'] = array('name'=>'Silver sickle','artfile'=>'sickle.png','skillgrant'=>'passive','gather_boost_herb'=>25);

$itembank['tool_sowingkit'] = array('name'=>'Basic sowing kit','artfile'=>'sowingkit_simple.png','skillgrant'=>'tailoring',
    'entrypoint_market' => '1',
    'market_price' => '25',
    'storekey' => 'tool');

$itembank['cloth_hemp'] = array('name'=>'Hemp cloth','artfile'=>'rawcloth.png','cityasking_gold'=>10,'cityasking_qty'=>4);

?>