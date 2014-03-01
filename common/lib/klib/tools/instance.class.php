<?php
/**
 * This KLib package add function to cache/instanciate object
 *
 * @package KLib
 * @author Quentin DORE <quentin@diva-cloud.com> 
 * @version 3.0
 */
namespace KLib;
/** This KLib package add function to cache/instanciate object 
  * @package KLib
  */

abstract class instance{
	/**
	 * Objects cache
	 */
	static public $objects = array();
	//static private $instance = array();
	
	/**
	 * Instanciate an object and put it into the cache
	 * 
	 * @param 	string $className Class name
	 * @param 	string $id 		Id
	 * @return 	object
	 */
	static public function of($className, $id){
		$className = strtolower($className);
		if(!class_exists($className))
			throw new \Exception('CLASS NOT FOUND', 404);
		if (!array_key_exists($className, self::$objects) || !array_key_exists($id, self::$objects[$className]) || !is_a(self::$objects[$className][$id], $className))
			self::$objects[$className][$id] = new $className($id);
		return self::$objects[$className][$id];
	}
	/**
	 * Reinstanciate an object and put it into the cache
	 * 
	 * @param string $className Class name
	 * @param string $id 		Id
	 */
	static public function reload($className, $id){
		if (is_object($className)){
			$cName = get_class($className);
			self::$objects[$cName][$id] = $className;
		}else{
			$className = strtolower($className);
			self::$objects[$className][$id] = new $className($id);
		}
	}
	/**
	 * Put an object into the cache
	 * 
	 * @param string $object 	Object
	 * @param string $id 		Id
	 */
	static public function add(&$object, $id){
		$className = strtolower(get_class($object));
		self::$objects[$className][$id] = $object;
	}
	/**
	 * Delete an object from cache
	 * 
	 * @param string $className Class name
	 * @param string $id 		Id
	 */
	static public function del($className, $id){
		$className = strtolower($className);
		if (array_key_exists($className, self::$objects)){
			if (array_key_exists($id, self::$objects[$className]))
				unset(self::$objects[$className][$id]);
			elseif (in_array($className, self::$instance)){
				foreach(self::$instance as $cName){
					if (array_key_exists($cName, self::$objects) && array_key_exists($id, self::$objects[$cName]) )
						unset(self::$objects[$cName][$id]);
				}
			}
		}
	}
	/**
	 * Instanciate an object and put it into the cache by instanciate method
	 * 
	 * @param 	string 	$className 	Class name
	 * @param 	string 	$data 		data for instance
	 * @param 	string 	$idName 	Data key of which store the primary key (id)
	 * @param 	string 	$fieldHide 	Key which not used in the instanciate
	 * @param 	boolean $force 		Force to delete previous object (def. : false)
	 * @return 	object
	 */
	static public function addOne($className, &$data, $idName='_id', $fieldHide=array(), $force=false){
		$className = strtolower($className);
		if (!array_key_exists($className, self::$objects))
			self::$objects[$className] = array();
		if (!array_key_exists((string)$data[$idName], self::$objects[$className]) || $force){
			if (method_exists($className, 'instanciate')){
				$obj = array_diff_key($data, $fieldHide);
				self::$objects[$className][(string)$data[$idName]] = $className::instanciate($obj, $className);
			}else{
				self::$objects[$className][(string)$data[$idName]] = new $className($data[$idName]);
			}
		}
		return self::$objects[$className][(string)$data[$idName]];
	}
	/**
	 * Instanciate objects and put it into the cache BY instanciate method
	 * 
	 * @param 	string 	$className 	Class name
	 * @param 	string 	$array 		data for instance
	 * @param 	string 	$idName 	Data key of which store the primary key (id)
	 * @param 	boolean $force 		Force to delete previous object (def. : false)
	 * @param 	string 	$key
	 * @return 	object[]
	 */
	static public function massAdd($className, &$array, $idName='_id', $force=false, $key=null){
		$className = strtolower($className);
		$ret = array();
		foreach($array as $obj){
			$k = (string)$obj[$idName];
			if (!array_key_exists($className, self::$objects) || !array_key_exists($k, self::$objects[$className]) || !is_a(self::$objects[$className][$k], $className) || $force){
				if (method_exists($className, 'instanciate')){
					self::$objects[$className][$k] = $className::instanciate($obj, $className);
				}else
					self::$objects[$className][$k] = new $className($k);
			}
			if (is_null($key))
				$ret[] = &self::$objects[$className][$k];
			else
				$ret[$obj[$key]] = &self::$objects[$className][$k];
		}
		return $ret;
	}
}
?>
