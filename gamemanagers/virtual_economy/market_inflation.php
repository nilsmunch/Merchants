<?

class MarketInflation { 
	static public function GetMarketBuyprice($item) {
		global $g;
		
		if (!$g['market_inflation'][$item['itemkey']]) {return $item['cityasking_gold'];}
		
		$time = date('U');
		$marketReducer = 60*5;
		
		if ($g['market_inflation']['timer'] <= $time) {
			$g['market_inflation']['timer'] = $time + $marketReducer;
				
			foreach ($g['market_inflation'] as $key => $value) {
				if ($key == 'timer') {continue;}
				$g['market_inflation'][$key] = floor($value*0.9);
			}
			$_SESSION['game_variables'] = $g;
		}
		foreach ($g['market_inflation'] as $key => $value) {
			if ($value == 0) { unset($g['market_inflation'][$key]);}
		}
		$val = $g['market_inflation'][$item['itemkey']];
		
		
		$price = floor($item['cityasking_gold']*(1-(0.01 * $val)));
		if ($price < 1) {$price = 1;}
		return $price;
	}
	static public function BoostMarketInflation($item,$units) {
		global $g;
		$g['market_inflation'][$item['itemkey']] += $units;
	}
}

?>