<?php
namespace KLib;

class MongoDB {
	static public $instance = null;

	protected $client = null;

	private function __construct(){
		if (is_null(C::g('MONGODB_USER')) && is_null(C::g('MONGODB_PASS')))
			$this->client = new \MongoClient(C::g('MONGODB_HOST').':'.C::g('MONGODB_PORT'), array('db'=>C::g('MONGODB_DBNAME'), 'readPreference'=>C::g('MONGODB_READPREF')));
		else{
			$this->client = new \MongoClient('mongodb://'.C::g('MONGODB_USER').':'.C::g('MONGODB_PASS').'@'.C::g('MONGODB_HOST').':'.C::g('MONGODB_PORT'), array('db'=>C::g('MONGODB_DBNAME'), 'readPreference'=>C::g('MONGODB_READPREF')));
		}
	}
	static public function getInstance(){
		if (!is_a(self::$instance, 'MongoDB'))
			self::$instance = new MongoDB();
		return self::$instance;
	}
	/**
     * Change database
     * 
     * @param   string  $db             Database name (def. : MONGODB_DBNAME)
     * @throws  \Exception Throws   	Exception if the database or collection name is invalid.
     * @return  \MongoCollection 		Returns a new collection object.
     */
    public function selectDB($db=null){
		if(is_null($db))
			$db = C::g('MONGODB_DBNAME');
        return $this->client->selectDB($db);
    }
	/**
     * Change collection
     * 
     * @param   string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param   string  $db             Database name (def. : MONGODB_DBNAME)
     * @throws  \Exception Throws   	Exception if the database or collection name is invalid.
     * @return  \MongoCollection 		Returns a new collection object.
     */
    public function selectCollection($collection=null, $db=null){
		if(is_null($db))
			$db = C::g('MONGODB_DBNAME');
		if(is_null($collection))
			$collection = C::g('MONGODB_COLLECTNAME');
        return $this->client->selectCollection($db, $collection);
    }
    static public function count($query, $collection=null, $limit=0, $skip=0, $dbname=null){
        if(is_null($dbname))
            $dbname = C::g('MONGODB_DBNAME');
        if(is_null($collection))
            $collection = C::g('MONGODB_COLLECTNAME');
        if (array_key_exists('_id', $query) && !is_a($query['_id'], 'MongoId'))
            $query['_id'] = new \MongoId($query['_id']);
        return self::getInstance()->selectCollection($collection, $dbname)->count($query, $limit, $skip);
    }
    static public function command($command, $options=null){
        if (is_null($options))
            $options = array();
        return sel::getInstance()->selectDB()->command($command, $options);
    }
    /**
     * Find data if a query field is '_id' and not a MongoId, it will be converted.
     * 
	 * @param       array   $query          The fields for which to search. MongoDB's query language is quite extensive.
     * @param       string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param       array   $fields         Fields of the results to return. The array is in the format array('fieldname' => true, 'fieldname2' => true). The _id field is always returned.
     * @param       string  $dbname         Database name (def. : MONGODB_DBNAME)
     * @return      \MongoCursor Returns a cursor for the search results.
     */
    static public function find($query, $collection=null, $out='array', $fields=array(), $dbname=null){
		if(is_null($dbname))
			$dbname = C::g('MONGODB_DBNAME');
		if(is_null($collection))
			$collection = C::g('MONGODB_COLLECTNAME');
        if (array_key_exists('_id', $query) && !is_a($query['_id'], 'MongoId'))
            $query['_id'] = new \MongoId($query['_id']);
        $result = self::getInstance()->selectCollection($collection, $dbname)->find($query, $fields);
        if ($out == 'array')
        	return iterator_to_array($result);
        return $result;
    }
    /**
     * Distinct data if a query field is '_id' and not a MongoId, it will be converted.
     * 
     * @param       string   $fields         Fields of the results to return. The array is in the format array('fieldname' => true, 'fieldname2' => true). The _id field is always returned.
     * @param       array   $query          The fields for which to search. MongoDB's query language is quite extensive.
     * @param       string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param       string  $dbname         Database name (def. : MONGODB_DBNAME)
     * @return      \MongoCursor Returns a cursor for the search results.
     */
    static public function distinct($fields='', $query, $collection=null, $out='array', $dbname=null){
        if(is_null($dbname))
            $dbname = C::g('MONGODB_DBNAME');
        if(is_null($collection))
            $collection = C::g('MONGODB_COLLECTNAME');
        if (array_key_exists('_id', $query) && !is_a($query['_id'], 'MongoId'))
            $query['_id'] = new \MongoId($query['_id']);
        $result = self::getInstance()->selectCollection($collection, $dbname)->distinct($fields, $query);
        if ($out == 'array' && is_array($result))
            return iterator_to_array($result);
        return $result;
    }
    /**
     * FindOne data if a query field is '_id' and not a MongoId, it will be converted.
     * 
     * @param       array   $query          The fields for which to search. MongoDB's query language is quite extensive.
     * @param       string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param       array   $fields         Fields of the results to return. The array is in the format array('fieldname' => true, 'fieldname2' => true). The _id field is always returned.
     * @param       string  $dbname         Database name (def. : MONGODB_DBNAME)
     * @throws      \MongoConnectionException Throws MongoConnectionException if it cannot reach the database.
     * @return      array   Returns record matching the search or NULL.
     */
    static public function findOne($query, $collection=null, $fields=array(), $dbname=null){
		if(is_null($dbname))
			$dbname = C::g('MONGODB_DBNAME');
		if(is_null($collection))
			$collection = C::g('MONGODB_COLLECTNAME');
        if (array_key_exists('_id', $query) && !is_a($query['_id'], 'MongoId'))
            $query['_id'] = new \MongoId($query['_id']);
        return self::getInstance()->selectCollection($collection, $dbname)->findOne($query, $fields);
    }
    /**
     * Remove data if a query field is '_id' and not a MongoId, it will be converted.
     * 
     * @param       array   $query Description of records to remove.
     * @param       string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param       string  $dbname Database name (def. : MONGODB_DBNAME)
     * @param       string  $options Options for remove.
     * @return      bool    Returns an array containing the status of the removal if the "w" option is set. Otherwise, returns TRUE.
     */
    static public function remove($query, $collection=null, $dbname=null, $options=array()){
		if(is_null($dbname))
			$dbname = C::g('MONGODB_DBNAME');
		if(is_null($collection))
			$collection = C::g('MONGODB_COLLECTNAME');
        if (array_key_exists('_id', $query) && !is_a($query['_id'], 'MongoId'))
            $query['_id'] = new \MongoId($query['_id']);
        return self::getInstance()->selectCollection($collection, $dbname)->remove($query, $options);
    }
    /**
     * Save data.
     * 
     * @param       array   $data Data to insert
     * @param       string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param       string  $dbname Database name (def. : MONGODB_DBNAME)
     * @param       string  $options Options for remove.
     * @return      bool    Returns an array containing the status of the removal if the "w" option is set. Otherwise, returns TRUE.
     */
    static public function save($data, $collection=null, $dbname=null, $options=array()){
		if(is_null($dbname))
			$dbname = C::g('MONGODB_DBNAME');
		if(is_null($collection))
			$collection = C::g('MONGODB_COLLECTNAME');
        if (array_key_exists('_id', $data) && is_string($data['_id']))
            $data['_id'] = new \MongoId($data['_id']);
        $res = self::getInstance()->selectCollection($collection, $dbname)->save($data, $options);
        if (is_null($res['err']) && $res['ok'] == 1)
            return $data['_id'];
        return $res;
    }
    /**
     * Full text search.
     * 
     * @param       string  $data Searching string
     * @param       string  $collection     Collection name (def. : MONGODB_COLLECTNAME)
     * @param       array  $options Options.
     * @param       string  $dbname Database name (def. : MONGODB_DBNAME)
     * @return      bool    Returns an array containing the results.
     */
    static public function fullText($string, $collection=null, $out='cursor', $option=array(), $dbname=null){
		if (!is_string($string))
			throw new \Exception('INVALID FULLTEXT PARAM', 500);
		if(is_null($dbname))
			$dbname = C::g('MONGODB_DBNAME');
		if(is_null($collection))
			$collection = C::g('MONGODB_COLLECTNAME');
		$command = array();
		$command['text'] = $collection;
        $command['search'] = $string;
        $command['limit'] = C::g('MONGODB_SEARCH_LIMIT');
        $command = array_merge($command, $option);
		try {
            $result = self::getInstance()->selectDB($dbname)->command($command);
            if ($out == 'array')
            	return iterator_to_array($result);
            return $result;
        } catch (\MongoException $e) {
            throw new \Exception('MONGODB ERROR', 500);
        }
    }
}