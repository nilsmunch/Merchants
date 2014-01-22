<?


class InventoryItemBalancer { 
	protected $itemData = array();
	protected $itemMetalevel = 0;
	protected $balancingCriteria = array();
	
    public function __construct( $array ) {
        $this->itemData = $array;
        $this->itemMetalevel = $array['itemlevel'];
        $this->balancingCriteria = array();
    }
    
    
	public function PolishedItemData() { return $this->itemData;}

	public function NewBalancingValue($title,$type,$variable) {
		$value = 0;
		switch ($type) {
			case 'scale_by_level': $value = floor($this->itemMetalevel * $variable * (1 + ($this->itemMetalevel / 1000)));
			$value = round($value,-1*(strlen($value)-1));
			break;
		}
	
		$this->balancingCriteria[] = array('title'=>$title,'form'=>$formula,'result'=>$value);
	}
	
	public function BalanceReport() {
		$report = array();
		foreach ((array)$this->balancingCriteria as $crit) {
			$report[] = $crit;
		}
		return $report;
	}
}

?>