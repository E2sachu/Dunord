<?php

namespace KLib;

abstract class Cast{
	/**
     * Try to cast an array of string in float or int
     * 
     * @param        string[] $array Array of data to convert
     * @return       mixed[] Return converted array
     */
    static public function autocastArray($array){
		if (is_array($array)){
			foreach($array as $key=>$value){
                if (is_array($value))
					$array[$key] = self::autocastArray($value);
				else
					$array[$key] = self::autocast($value);
			}
		}
        return $array;
    }
    /**
     * Try to cast string in float or int
     * 
     * @param        string  $val String Data to convert
     * @return       mixed Return converted value
     */
    static public function autocast($val){
		if (is_string($val) && preg_match('/^[-+]?[0-9]*\.?[0-9]+$/', $val)){
			$val = floatval($val);
		if (fmod($val,1) === 0.0)
			$val = intval($val);
		}
        return $val;
    }
}