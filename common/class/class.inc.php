<?php
require_once(__DIR__.'/user.class.php');
require_once(__DIR__.'/material.class.php');

Config::setKey('CLASS_COLLECTION', array(
		'user'		=>	'user',
		'material'	=> 	'material'
	), true);
?>