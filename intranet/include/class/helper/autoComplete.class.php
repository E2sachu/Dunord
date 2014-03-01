<?php

abstract class AutoComplete{
	static public function city($term, $country='FR'){
		if (is_string($term) && strlen($term) >= 2){
			$regexp = new MongoRegex('/'.$term.'/i');
			$datas = KLib\MongoDB::find(array('$or'=> array(
										array('name'=> $regexp),
										array('postalCode'=> $regexp),
										)) , 'country'.strtoupper($country));
			$ret = array();
			foreach($datas as $data){
				$ret[] = array('id'=>(string)$data['_id'], 'name' => $data['name']);
			}
			return $ret;
		}
		return array();
	}
}

?>