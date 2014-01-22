<?

include('passive_skills.php');

// FLORA
$skillbank['fruitpicking'] = array('name'=>'Fruitpicking','category'=>'flora','travel_vs_process'=>0.9,'picktimedif'=> -5);
$skillbank['fruitpicking']['rarekeys'] = array(0=>'pumpkin',1=>'pumpkin');

$skillbank['herbalism'] = array('name'=>'Herbalism','category'=>'flora','travel_vs_process'=>0.8,'picktimedif' => -5);
$skillbank['herbalism']['rarekeys'] = array(0=>'herb_dracorns',1=>'herb_dracorns',2=>'herb_dracorns',3=>'herb_dracorns',4=>'herb_dracorns');

$skillbank['farming'] = array('name'=>'Farming','category'=>'flora');

/// PROCESS
$skillbank['looming'] = array('name'=>'Weaving','category'=>'processing','craftskill'=>true);
$skillbank['skinning'] = array('name'=>'Skinning','category'=>'processing');
$skillbank['gemcutting'] = array('name'=>'Gemcutting','category'=>'processing','craftskill'=>true);

// ARMORMAKING
$skillbank['tailoring'] = array('name'=>'Tailoring','category'=>'flora','craftskill'=>true);
$skillbank['leatherworking'] = array('name'=>'Leatherworking','category'=>'flora','craftskill'=>true);
$skillbank['blacksmithing'] = array('name'=>'Blacksmithing','category'=>'flora','craftskill'=>true);

// TOOLMAKING
$skillbank['carving'] = array('name'=>'Carving','category'=>'flora','craftskill'=>true);
$skillbank['engineering'] = array('name'=>'Engineering','category'=>'flora','craftskill'=>true);
$skillbank['jewelcrafting'] = array('name'=>'Jewelcrafting','category'=>'flora','craftskill'=>true);

// CHEMISTRY
$skillbank['brewery'] = array('name'=>'Brewing','category'=>'flora','craftskill'=>true);
$skillbank['alchemy'] = array('name'=>'Alchemy','category'=>'flora','craftskill'=>true);
//$skillbank['transmutation'] = array('name'=>'Transmutation','category'=>'flora','craftskill'=>true);

// ARCANISM
$skillbank['runecarver'] = array('name'=>'Runecarving','category'=>'flora','craftskill'=>true);
$skillbank['scrollmaking'] = array('name'=>'Scrollmaking','category'=>'flora','craftskill'=>true);
$skillbank['arcanism'] = array('name'=>'Arcanism','category'=>'flora','craftskill'=>true);

// SOCIAL
$skillbank['cooking'] = array('name'=>'Cooking','category'=>'flora','craftskill'=>true);
$skillbank['entertaining'] = array('name'=>'Entertainment','category'=>'flora');
$skillbank['leadership'] = array('name'=>'Leadership','category'=>'flora');

// INDUSTRY
$skillbank['mining'] = array('name'=>'Mining','category'=>'industry','travel_vs_process'=>0.05,'picktimedif' => 20);
$skillbank['mining']['rarekeys'] = array(0=>'citrine_polished',1=>'topaz',2=>'topaz',3=>'topaz',4=>'ruby_raw');

$skillbank['masonry'] = array('name'=>'Masonry','category'=>'flora','travel_vs_process'=>0.15,'picktimedif' => 10);

$skillbank['lumbering'] = array('name'=>'Lumbering','category'=>'flora','travel_vs_process'=>0.15,'picktimedif' => 10);

// FAUNA
$skillbank['hunting'] = array('name'=>'Hunting','category'=>'fauna','travel_vs_process'=>0.75,'picktimedif' => 10);
$skillbank['hunting']['rarekeys'] = array(0=>'basemeat',1=>'basemeat',2=>'basemeat',3=>'basemeat',4=>'basemeat');

$skillbank['fishing'] = array('name'=>'Fishing','category'=>'fauna','travel_vs_process'=>0.4,'picktimedif' => 25);
$skillbank['animalhusbandry'] = array('name'=>'Animal Husbandry','category'=>'fauna','travel_vs_process'=>0.6);



// ADVENTURE
$skillbank['scouting'] = array('name'=>'Scouting','category'=>'adventure','travel_vs_process'=>0.95);
$skillbank['questing'] = array('name'=>'Questing','category'=>'flora');
$skillbank['espionage'] = array('name'=>'Espionage','category'=>'flora');


?>