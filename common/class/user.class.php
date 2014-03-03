<?php

class User extends KLib\baseModel {

	/**
	 * User Id
	 * @var String
	 */
	protected $id = null;

	/**
	 * User Name
	 * @var String
	 */
	protected $name = '';

	/**
	 * User Surname
	 * @var String
	 */
	protected $surname = '';

	/**
	 * User Mail
	 * @var String
	 */
	protected $mail = '';

	/**
	 * User Password
	 * @var String
	 */
	protected $password = '';

	/**
	 * User Services
	 * @var array
	 */
	protected $serviceId = '';

	/**
	 * User Materials
	 * @var array
	 */
	protected $materials = array ();

	/**
	 * User Date Create
	 * @var int
	 */
	protected $dateCrea = 0;

	/**
	 * User Last Login
	 * @var int
	 */
	protected $lastLogin = 0;

	/**
	 *	User Right
	 * @var int
	 */
	protected $right = 0;

	public function __construct($id=null) {
		if (is_a($id, 'MongoId'))
			$id = (string)$id;
		if (is_string($id)) {
			$data = KLib\MongoDB::findOne(array('_id' => $id), 'user');
			$this->id 		=	(string)$data['_id'];
			$this->name 	=	(string)$data['name'];
			$this->surname 	=	(string)$data['surname'];
			$this->mail 	=	(string)$data['mail'];
			$this->password =	(string)$data['password'];
			$this->serviceId = 	(string)$data['serviceId'];
			$this->materials =	(array)$data['materials'];
			$this->dateCrea =	(int)$data['dateCrea'];
			$this->lastLogin = 	(int)$data['lastLogin'];
			$this->right 	=	(int)$data['right'];
		} elseif (!is_null($id)){
			throw new Exception("INVALID USER ID", 500);
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function getMail() {
		return $this->mail;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getServiceId() {
		return $this->serviceId;
	}

	public function getMaterials() {
		return $this->materials;
	}

	public function getDateCrea() {
		return $this->dateCrea;
	}

	public function getLastLogin() {
		return $this->lastLogin;	
	}

	public function getRight() {
		return $this->right;
	}

	public function setName($data='') {
		if (!is_string($data) && !is_null($data))
			throw new Exception("INVALID USER NAME", 500);
		$this->name = $data;
	}

	public function setSurname($data='') {
		if (!is_string($data) && !is_null($data))
			throw new Exception("INVALID USER SURNAME", 500);
		$this->surname = $data;
	}

	public function setMail($data='') {
		if (!is_string($data) && !is_null($data))
			throw new Exception("INVALID USER MAIL", 500);
		$this->mail = $data;
	}

	public function setPassword($data='') {
		if (!is_string($data) && !is_null($data))
			throw new Exception("INVALID USER PASSWORD", 500);
		$this->password = md5($data);
	}

	public function setServiceId($data='') {
		if (!is_string($data) && !is_null($data))
			throw new Exception("INVALID USER SERVICE ID", 500);
		$this->serviceId = $data;
	}

	public function setDateCrea($data=0) {
		if (!is_numeric($data))
			throw new Exception("INVALID USER DATE", 500);
		$this->dateCrea = intval($data);		
	}

	public function setLastLogin($data=0) {
		if (!is_numeric($data))
			throw new Exception("INVALID USER DATE", 500);
		$this->lastLogin = intval($data);
	}

	public function setRight($data=0) {
		if (!is_numeric($data))
			throw new Exception("INVALID USER RIGHT", 500);
		$this->right = intval($data);
	}

	public function save($fields=array(), $collection=null){
        if (!is_array($fields) && !empty($fields))
            throw new Exception('INVALID SAVEDFIELDS', 500);
        $this->setDateCreate();
        $savedFields = array(
        	'id',
        	'name',
        	'surname',
        	'mail',
        	'password',
        	'serviceId',
        	'dateCrea',
        	'lastLogin',
        	'right'
        );
        return parent::save(array_merge($savedFields, $fields), $collection);
    }
    public function update($fields=array(), $collection=null){
        if (!is_array($fields) && !empty($fields))
            throw new Exception('INVALID SAVEDFIELDS', 500);
        $this->setDateModify();
        $savedFields = array(
        	'id',
        	'name',
        	'surname',
        	'mail',
        	'password',
        	'serviceId',
        	'dateCrea',
        	'lastLogin',
        	'right'
        );
        return parent::update(array_merge($savedFields, $fields), $collection);
    }
}