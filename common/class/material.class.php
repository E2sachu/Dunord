<?php

class Material extends KLib\BaseModel {

	/**
	 * Material Id
	 * @var String
	 */
	protected $id = null;

	/**
	 * Material Label
	 * @var String
	 */
	protected $label = '';

	/**
	 * Material Type
	 * @var String
	 */
	protected $type = '';

	/**
	 * Material userId
	 * @var String
	 */
	protected $userId = '';

	/**
	 * Material Date Create
	 * @var int
	 */
	protected $dateCrea = 0;

	public function __construct($id=null) {
		if (is_a($id, 'MongoId'))
			$id = (string)$id;
		if (is_string($id)){
			$data = KLib\MongoDB::findOne(array('_id'=> $id), 'material');
			$this->id 		= 	(string)$data['id'];
			$this->label 	=	(string)$data['label'];
			$this->type 	= 	(string)$data['type'];
			$this->userId	=	(string)$data['userId'];
			$this->dateCrea =	(string)$data['dateCrea'];
		} elseif (!is_null($id)){
			throw new Exception('INVALID MATERIAL ID', 500);
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getType() {
		return $this->type;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function getDateCrea() {
		return $this->dateCrea;
	}

	public function setLabel($data='') {
		if (!is_string($data) && !is_null($data))
            throw new Exception('INVALID MATERIAL LABEL', 500);
        $this->label = $data;
	}

	public function setType($data='') {
        if (!is_string($data) && !is_null($data) && $data >= 2)
            throw new Exception('INVALID MATERIAL TYPE', 500);
        $this->label = $data;
	}

	public function setUserId($data='') {
        if (!is_string($data) && !is_null($data))
            throw new Exception('INVALID MATERIAL USERID', 500);
        $this->label = $data;
	}

	public function setDateCrea($data=0) {
		if (!is_numeric($data))
            throw new Exception('INVALID MATERIAL DATE', 500);
        $this->ca = intval($data);
	}

	public function save($fields=array(), $collection=null){
        if (!is_array($fields) && !empty($fields))
            throw new Exception('INVALID SAVEDFIELDS', 500);
        $this->setDateCreate();
        $savedFields = array(
        	'id',
        	'label',
        	'type',
        	'userId',
        	'dateCrea'
        );
        return parent::save(array_merge($savedFields, $fields), $collection);
    }
    public function update($fields=array(), $collection=null){
        if (!is_array($fields) && !empty($fields))
            throw new Exception('INVALID SAVEDFIELDS', 500);
        $this->setDateModify();
        $savedFields = array(
          	'id',
        	'label',
        	'type',
        	'userId',
        	'dateCrea'
        );
        return parent::update(array_merge($savedFields, $fields), $collection);
    }
}
