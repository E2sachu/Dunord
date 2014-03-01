<?php
namespace KLib;

abstract class Config{
	static protected $config = array();
	static protected $configLock = array();

	static public function getKey($key=null, $sskey=false){
		if (!is_string($key) && !is_null($key))
			throw new Exception('INVALID CONFIG KEY', 403);
		if (is_null($key))
			return self::$config;
		if (array_key_exists($key, self::$config)){
			if (is_array(self::$config[$key]) && is_scalar($sskey) && $sskey !== false && array_key_exists($sskey, self::$config[$key]))
				return self::$config[$key][$sskey];
			else
				return self::$config[$key];
		}
		return null;
	}
	//ALIAS getKey
	static public function g($key=null, $sskey=false){
		return self::getKey($key, $sskey);
	}
	static public function setKey($key, $value, $lock=false){
		if (!is_string($key))
			throw new Exception('INVALID CONFIG KEY', 403);
		if (!in_array($key, self::$configLock)){
			self::$config[$key] = $value;
			if ($lock)
				self::$configLock[] = $key;
		}
		return false;
	}
	//ALIAS setKey
	static public function s($key, $value, $lock=false){
		return self::setKey($key, $value, $lock);
	}
	static public function isLock($key){
		if (!is_string($key))
			throw new Exception('INVALID CONFIG KEY', 403);
		return in_array($key, self::$configLock);
	}
	static public function unLock($key){
		if (self::isLock($key))
			unset(self::$configLock[array_search($key, self::$config)]);
		return true;
	}
	static public function lock($key){
		if (!self::isLock($key))
			self::$configLock[] = $key;
		return true;
	}

}

//ALIAS
class_alias('KLib\Config', 'C');
class_alias('KLib\Config', 'Config');
class_alias('KLib\Config', 'KLib\C');