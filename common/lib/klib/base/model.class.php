<?php
namespace KLib;

abstract class BaseModel{
	private static $banSetter = array('setdatecreate', 'setdateinscription', 'setdatemodify', 'setmotdepasse');
	/**
      * Abstract constructor
      * @param int $id Instance ID/UUID
      * @throws Exception if ID/UUID not exists
      * @return void
      */
	abstract public function __construct($id=null);

	/**
      * Instanciate method avoid SQL/NoSQL loading, used by the method of KLib\instance class
      * @param  mixed[] $data Object attributs in key/value array
      * @param  string  $classname Instance class name
      * @return object  The new instance
      */
    static public function instanciate($data, $classname){
        if (!class_exists($classname))
            throw new \Exception('CLASS NOT FOUND', 404);
        $instance = new $classname();
        foreach($data as $key=>$value){
            $mthd = strtolower('set'.$key);
            if (method_exists($classname, $mthd) && !in_array($mthd, self::$banSetter)){
				$instance->$mthd($value);
            }else
				$instance->set($key, $value);
        }
        return $instance;
    }
    /**
	* Set value in object attributs
	* @param 	string  $name   Attributs
	* @param    mixed   $value  Value
	* @return 	void
	*/
	public function set($name, $value){
		if ($name == '_id')
			$name = 'id';
		if (!empty($name) && array_key_exists($name, get_object_vars($this))){
			if (is_a($value, 'MongoId'))
				$value = (string)$value;
			elseif(is_a($value, 'MongoDate'))
				$value = $value->sec;
			$this->$name = $value;
		}
	}
	protected function save($fields=array(), $collection=null){
		if (!is_null($this->id))
			return $this->update($fields);
		if (empty($fields))
			return false;
		if (is_null($collection))
			$collection = Config::getKey('CLASS_COLLECTION', strtolower(get_class($this)));
		if (is_null($collection))
			throw new \Exception('COLLECTION NOT FOUND', 500);
		$data = array();
		$realFields = get_object_vars($this);
		foreach($fields as $field){
			if (array_key_exists($field, $realFields) && !is_object($realFields[$field]) && $field != 'id')
				$data[$field] = $realFields[$field];
		}
		$this->id = (string)MongoDB::save($data, $collection);
		return $this->id;
	}
	protected function update($fields=array(), $collection=null){
		if (is_null($this->id))
			return $this->update($fields);
		if (empty($fields))
			return false;
		if (is_null($collection))
			$collection = Config::getKey('CLASS_COLLECTION', strtolower(get_class($this)));
		if (is_null($collection))
			throw new \Exception('COLLECTION NOT FOUND', 500);
		$data = array();
		$realFields = get_object_vars($this);
		foreach($fields as $field){
			if (array_key_exists($field, $realFields) && !is_object($realFields[$field])){
				if ($field == 'id')
					$data['_id'] = $realFields[$field];
				else
					$data[$field] = $realFields[$field];
			}
		}
		$res = MongoDB::save($data, $collection);
		return $this->id;
	}
	public function remove(){
		if (is_null($this->id))
			return false;
		$collection = Config::getKey('CLASS_COLLECTION', strtolower(get_class($this)));
		return MongoDB::remove(array('_id' => $this->id), $collection);
	}
}