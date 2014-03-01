<?php

abstract class Validator{

	static public function basicParams(){
		$checks = array(
				'#ctrl' => 'is_string-!is_empty',
				'#param1' => 'is_string-!is_empty',
				'#param2' => 'is_string-!is_empty'
			);
		return KLib\Validator::arrayCheck($_GET, $checks);
	}

	static public function productAdd(){
		$checks = array(
				'productLabel' => 'is_string-!is_empty',
				'productPrice' => 'is_int_greater_than_z',
				'productNbRelation' => 'is_int_greater_than_z',
				'productDescription' => 'is_string',
				'#productDurationRelation' => 'is_int_greater_than_z',
				'#productExecFct' => 'is_string-!is_empty',
				'#productType'	=>	'is_string-!is_empty'
			);
		return KLib\Validator::arrayCheck($_POST, $checks);
	}
	static public function couponAdd(){
		$checks = array(
				'productId' => 'is_string-!is_empty',
				'couponKey' => 'is_string-!is_empty',
				'#couponDateStart' => 'is_string-!is_empty',
				'#couponDateEnd' => 'is_string-!is_empty',
				'#couponCounter' => 'is_string-!is_empty',
				'#couponPrice' => 'is_string-!is_empty'
			);
		return KLib\Validator::arrayCheck($_POST, $checks);
	}
	static public function userAdd(){
		$checks = array(
				'nom' => 'is_string-!is_empty',
				'prenom' => 'is_string-!is_empty',
				'password' => 'is_string-!is_empty',
				'mail' => 'is_string-!is_empty',
				'profilType' => 'is_string-!is_empty',
				'#dateInscription' => 'is_string-!is_empty',
				'#actived' => 'is_string-!is_empty',
				'#locked' => 'is_string-!is_empty',
				'#parentId' => 'is_string-!is_empty',
			);
		return KLib\Validator::arrayCheck($_POST['user'], $checks);
	}
	static public function companyAdd(){
		$checks = array(
				'label' => 'is_string-!is_empty',
			);
		return KLib\Validator::arrayCheck($_POST['company'], $checks);
	}
	static public function articleAdd(){
		$checks = array(
				'layout' => 'is_string-!is_empty',
				'title' => 'is_string-!is_empty',
				'pageTitle' => 'is_string-!is_empty',
				'content' => 'is_array-!is_empty',
				'uri' => 'is_string-!is_empty',
				'#author' => 'is_string-!is_empty',
				'#language' => 'is_string-!is_empty',
				'#description' => 'is_string-!is_empty',
				'#tags' => 'is_string-!is_empty',
				'#keywords' => 'is_string-!is_empty',
				'#datePublished' => 'is_string-!empty',
			);
		return KLib\Validator::arrayCheck($_POST, $checks);	
	}
}