<?


function gatherOutcome($qty,$item,$skill,$formulate = false) {
	global $boosts;
	if (!$qty) {$qty = 1;}
	if (!$boosts[$skill] && !$boosts[$item]) {
		return $qty;
	}
	$boost = (int)$boosts[$skill];
	$boostqty = floor(($qty / 100) * $boost);
	if ($boostqty == 0) {		return $qty;	}
	if ($formulate) {
		return $qty.' <font style="color:cyan">(+ '.$boostqty.')</font>';
	}
	return (int)$qty+$boostqty;
}

//gather_boost_herb
?>