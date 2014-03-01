<?php

class SELECT{
	static public function allProducts(){
		$data = KLib\MongoDB::find(array(), 'product');
		return KLib\instance::massAdd('Product', $data);
	}
	static public function allCoupons(){
		$data = KLib\MongoDB::find(array(), 'coupon');
		return KLib\instance::massAdd('Coupon', $data);
	}
	static public function allRecruiter(){
		$data = KLib\MongoDB::find(array('profilType' => 2), 'users');
		return KLib\instance::massAdd('Recruiter', $data);
	}
	static public function allCompany(){
		$data = KLib\MongoDB::find(array(), 'company');
		return KLib\instance::massAdd('Company', $data);
	}
	static public function allAdmins(){
		$datas = json_decode(file_get_contents(C::g('AUTHFILE')), true);
		$admins = array();
		foreach($datas as $key=>$admin)
			$admins[] = array_merge($admin, array('id' => $key));
		return KLib\instance::massAdd('Admin', $admins, 'id');
	}
	
	static public function allArticles($published=null){
		if (is_bool($published))
			$datas = KLib\MongoDB::find(array('published' => $published), 'article');
		else
			$datas = KLib\MongoDB::find(array(), 'article');
		return KLib\instance::massAdd('Article', $datas);
	}
	static public function getLang() {
		$datas = array (
			'fr' => 'Français',
			'en' => 'English',
		);
		return $datas;
	}
	static public function getAuthor() {
		$datas = json_decode(file_get_contents(C::g('AUTHFILE')), true);
		$ret = array();
		foreach($datas as $id=>$data){
			$ret[$id] = $data['firstName'].' '.$data['sureName'];
		}
		return $ret;
	}
	static public function getLayout() {
		$datas = array (
			'default' => array(
					'label'=>'Default',
					'tpl'=>'default.tpl',
					),
			'index' => array(
					'label'=>'Index',
					'tpl'=>'index.tpl',
					),
		);
		return $datas;
	}
	static public function getType() {
		$datas = array (
		);
		return $datas;
	}
	static public function getTemplate() {
		$datas = array (
			'Raw'=>'raw.tpl',
			'Diaporama'=>'diaporama.tpl',
			'Youtube'=>'youtube.tpl',
			'Dailymotion'=>'dailymotion.tpl',
		);
		return $datas;
	}
}
?>