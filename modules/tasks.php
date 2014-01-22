<?


function costBox($cost,$reward = false) {
	global $itembank,$g;
	foreach ($cost as $req) {
		if (!is_array($req)) {
		if (strstr($req, ':')) {
			$bits = explode(':',$req);
			$req = array();
			$req['type'] = 'itemqty';
			$req['item'] = trim($bits[0]);
			$req['cost'] = (int)$bits[1];
		}
		}
		if ($req['type']=='itemqty') {
			$count = 1;
			$ingdata = $itembank[$req['item']];
			if (!ingdata) {die('boop');}
			
			$hasqty = $g['inventory'][$req['item']];
				
				if ($req['cost'] >= 4) {
					if ($reward) {
							$inglist .= itemIcon($ingdata,'border:2px solid goldenrod',40,true,$req['cost']);
						} else {
						if ($hasqty >= $req['cost']) {
							$inglist .= itemIcon($ingdata,'border:2px solid green',40,true,$req['cost']);
						} elseif ($hasqty == 0) {
							$inglist .= itemIcon($ingdata,'border:2px solid red',40,true,$req['cost']);
						} else {
							$inglist .= itemIcon($ingdata,'border:2px solid green',40,true,$hasqty);
							$inglist .= itemIcon($ingdata,'border:2px solid red',40,true,$req['cost']-$hasqty);
						}
						}
						
				} else {
					if ($reward) {
						$inglist .= itemIcon($ingdata,'border:2px solid goldenrod',40,true);
					} else {
						while ($count <= $req['cost']) {
					
							$inglist .= itemIcon($ingdata,'border:2px solid '.($hasqty >= $count ? 'green':'red'),40,true);
							if (!($hasqty >= $count)) {
								$bring = 'res';
							}
							
						$count ++;
						}
					
					}
				}
			}
		}
		return $inglist;
		}

?>