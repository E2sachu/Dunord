<?php 

class SEARCH{
	static public function searchUsers($text){
		$results = array();
		if (is_string($text) && strlen($text) >= 2){
			$regexp = new MongoRegex('/'.$text.'/i');
			$datas = KLib\MongoDB::find(array('$or'=> array(
										array('mail1'=> $regexp),
										array('nom'=> $regexp),
										array('prenom'=> $regexp)
										)) , 'users');
			foreach($datas as $data)
				$results[] = User::loadUser($data);
		}
		return $results;
	}
	static public function searchCompanys($text){
		$results = array();
		$regexp = new MongoRegex('/'.$text.'/i');
		$datas = KLib\MongoDB::find(array('label'=> $regexp)
								    , 'company');
		if (is_array($datas) && !empty($datas))
			$results = KLib\instance::massAdd('Company', $datas);
		return $results;
	}
	static public function searchActivedUsers($active=true){
		$results = array();
		if (!is_bool($active))
			return array();
		$datas = KLib\MongoDB::find(array('actived'=> $active) , 'users');
		foreach($datas as $data)
			$results[] = User::loadUser($data);
		return $results;
	}
	static public function searchLockedUsers($locked=true){
		$results = array();
		if (!is_bool($locked))
			return array();
		$datas = KLib\MongoDB::find(array('locked'=> $locked) , 'users');
		foreach($datas as $data)
			$results[] = User::loadUser($data);
		return $results;
	}
	static public function searchArticles($text){
		if (is_string($text) && strlen($text) >= 2){
			$regexp = new MongoRegex('/'.$text.'/i');
			$datas = KLib\MongoDB::find(array('$or'=> array(
										array('title'=> $regexp),
										array('pageTitle'=> $regexp),
										array('subTitle'=> $regexp),
										)) , 'article');
			return KLib\instance::massAdd('Article', $datas);
		}
		return array();
	}
}