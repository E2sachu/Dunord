<?php

namespace KLib;

abstract class Validator{

	static public function arrayCheck($data=array(), $checks=array()){
		foreach($checks as $key => $check){
			//print $key." -> ".$check;
			$optional = false;
			if ($key[0] == '#'){
				$optional = true;
				$key = substr($key, 1);
			}
			if (array_key_exists($key, $data)){
				if (is_array($check) && is_array($data[$key])){
					$res = self::arrayCheck($data[$key], $check);
					//print ' '.var_export($res, true);
					if (!$res && !$optional)
						return false;
				}elseif (is_array($check)){
					throw new Exception('INVALID VALIDATOR CHECKER', 500);
				}else{
					$res = self::varCheck($data[$key], $check);
					//print ' '.var_export($res, true);
					if (!$res && !$optional)
						return false;
				}
			}else{
				if (!$optional)
					return false;
			}
			//print "\n";
		}
		return true;
	}
	static public function varCheck($data, $checkString){
		if (!is_string($checkString))
			throw new \Exception('INVALID CHECK', 500);
		$checks = explode('-', $checkString);
		$res = true;
		foreach($checks as $check){
			//NOT
			$not = false;
			if ($check[0] == '!'){
				$not = true;
				$check = substr($check, 1);
			}
			//OR
			$or = false;

			if ($check[strlen($check)-1] == '|'){
				$or = true;
				$check = substr($check, 0, -1);
			}
			if (is_callable($check)){
				if ($or)
					$res = ($res || ($check($data) == !$not));
				else
					$res = ($res && ($check($data) == !$not));
			}
		}
		if (!$res)
			return false;
		return true;
	}
}