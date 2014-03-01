<?php
require_once(__DIR__.'/ctrl_material.php');
require_once(__DIR__.'/ctrl_product.php');
require_once(__DIR__.'/ctrl_coupon.php');
require_once(__DIR__.'/ctrl_error.php');
require_once(__DIR__.'/ctrl_default.php');
require_once(__DIR__.'/ctrl_user.php');
require_once(__DIR__.'/ctrl_company.php');
require_once(__DIR__.'/ctrl_account.php');
require_once(__DIR__.'/ctrl_article.php');
require_once(__DIR__.'/ctrl_admin.php');
require_once(__DIR__.'/ctrl_autocomplete.php');

KLib\Config::setKey('CRTL_ROUTES', array(
	'material'	=>	'MaterialController',
	'admin'		=>	'AdminController',
	'company'	=>	'CompanyController',
	'account'	=>	'AccountController',
	'stat'		=>	'StatController',
	'user'		=>	'UserController',
	'product'	=>	'ProductController',
	'coupon'	=>	'CouponController',
	'default'	=> 	'DefaultController',
	'error'		=>	'ErrorController',
	'autocomplete' => 'AutocompleteController'
	), true);
?>