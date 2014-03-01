<?php
namespace KLib;
if (class_exists('\MongoClient')){
	require_once(__DIR__.'/config.default.php');
	require_once(__DIR__.'/mongodb.class.php');
}else{
	Log::debug('MongoDB extension not load. please install pecl install mongo');
	throw new \Exception('Internal Server Error', 500);
}
?>