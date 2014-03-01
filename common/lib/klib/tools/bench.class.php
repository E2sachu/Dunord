<?php

namespace KLib;

abstract class Bench{
	
	public static $timer = array();

	static public function start($name=null){
		if (!is_string($name))
			$name = 'total';
		if (!array_key_exists($name, self::$timer))
			self::$timer[$name]['start'] = microtime(true);
		return true;
	}
	static public function current($name=null){
		if (!is_string($name))
			$name = 'total';
		if (array_key_exists($name, self::$timer))
			return microtime(true) - self::$timer[$name]['start'];
		return 0.0;
	}
	static public function stop($name=null){
		if (!is_string($name))
			$name = 'total';
		if (array_key_exists($name, self::$timer)){
			if (!array_key_exists('stop', self::$timer[$name]))
				self::$timer[$name]['stop'] = microtime(true);
			return self::$timer[$name]['stop'] - self::$timer[$name]['start'];
		}
		return false;
	}
	static public function shutdown(){
		if (C::g('BENCH_LOG')){
			foreach(self::$timer as $key=>$timer){
				$time = self::stop($key);
				Log::notice($key.' => '.($time * 1000).'ms', array('BENCH'));
			}
		}
	}
}

//ALIAS
class_alias('KLib\Bench', 'B');
class_alias('KLib\Bench', 'Bench');
class_alias('KLib\Bench', 'KLib\B');

Bench::$timer['total']['start'] = microtime(true);
register_shutdown_function('KLib\Bench::shutdown');