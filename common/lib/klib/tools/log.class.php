<?php

namespace KLib;

abstract class Log{
	const DEBUG = 100;
	const INFO = 200;
	const NOTICE = 250;
	const WARNING = 300;
	const ERROR = 400;
	const ALERT = 550;
	const EMERGENCY = 600;

	static protected $logs = array();
	static protected $file = null;

	static public function me($message, $level=Log::NOTICE, $additional=array()){
		if (!is_resource(self::$file))
			self::$file = fopen(C::g('LOG_OUT_FILE'), 'a');
		if (is_resource(self::$file)){
			$data = array(
					'date'		=>	date('d/m/Y H:i:s'),
					'ts'		=>	time(),
					'clientIp' 	=> 	isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'CLI',
					'uri'		=>	isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'CLI',
					'level' 	=> 	$level,
					'message' 	=> 	$message,
				);
			if ($level >= C::g('LOG_DEFAULT_LEVEL') || $level == Log::DEBUG){
				$traces = debug_backtrace();
				unset($traces[0]);
				$track = "Track : \n";
				$cpt = 0;
				foreach($traces as $trace){
					$track .= $cpt.' -> '.@$trace['file'].'(l'.@$trace['line'].'): '.@$trace['class'].@$trace['type'].@$trace['function'].'()'."\n";
					$cpt++;
				}
			}
			if (is_array($data['message']))
				$data['message'] = var_export($data['message'], true);
			if (isset($track)){
				$log = '['.implode ('][', array_merge($data, $additional)).']'."\n".$track;
			}else
				$log = '['.implode ('][', array_merge($data, $additional)).']'."\n";
			fwrite(self::$file, $log);
			if (Config::getKey('LOG_REGISTRED'))
				self::$logs[] = $data;
		}
	}

	static public function debug($message, $additional=array()){
		return self::me($message, Log::DEBUG, $additional);
	}
	static public function info($message, $additional=array()){
		return self::me($message, Log::INFO, $additional);
	}
	static public function notice($message, $additional=array()){
		return self::me($message, Log::NOTICE, $additional);
	}
	static public function warning($message, $additional=array()){
		return self::me($message, Log::WARNING, $additional);
	}
	static public function error($message, $additional=array()){
		return self::me($message, Log::ERROR, $additional);
	}
	static public function alert($message, $additional=array()){
		return self::me($message, Log::ALERT, $additional);
	}
	static public function emergency($message, $additional=array()){
		return self::me($message, Log::EMERGENCY, $additional);
	}
	static public function getLogs(){
		return self::$logs;
	}
}

//ALIAS
class_alias('KLib\Log', 'Log');
class_alias('KLib\Log', 'L');
class_alias('KLib\Log', 'KLib\L');
?>