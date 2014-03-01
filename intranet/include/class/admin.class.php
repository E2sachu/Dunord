<?php

class Admin extends KLib\BaseModel{
	protected $id = null;
	protected $password = '';
	protected $actived = false;
	protected $mail = '';
	protected $sureName = '';
	protected $firstName = '';
	protected $rights = array();

	public function __construct($id = null){
		if (is_string($id)){
			$datas = json_decode(file_get_contents(C::g('AUTHFILE')), true);
			if (array_key_exists($id, $datas)){
				$data = $datas[$id];
				$this->id = (string)$id;
				$this->actived = array_key_exists('actived', $data)?(bool)$data['actived']: false;
				$this->mail = array_key_exists('mail', $data)?(string)$data['mail']: '';
				$this->password = array_key_exists('password', $data)?(string)$data['password']: '';
				$this->sureName = array_key_exists('sureName', $data)?(string)$data['sureName']: '';
				$this->firstName = array_key_exists('firstName', $data)?(string)$data['firstName']: '';
				$this->rights = array_key_exists('rights', $data)?$data['rights']: array();
			}else
				throw new Exception('INVALID ADMIN ID', 500);
		}elseif(!is_null($id)){
			throw new Exception('INVALID ADMIN ID', 500);
		}
	}
	static public function authentify($id, $password){
		try{
			$admin = new Admin($id);
			if ($admin->getPassword() == md5($password))
				return $admin;
			return null;
		}catch(Exception $e){
			return null;
		}
	}
	static public function authentifyBySession(){
		if (array_key_exists('admin', $_SESSION))
			return unserialize($_SESSION['admin']);
		return null;
	}
	public function isAuthorized($key){
		if (!is_string($key))
			return false;
		return (in_array('*', $this->rights) || in_array($key, $this->rights));
	}
	//GETTER
	public function getId(){
		return $this->id;
	}
	public function isActived(){
		return $this->actived;
	}
	public function getMail(){
		return $this->mail;
	}
	public function getSureName(){
		return $this->sureName;
	}
	public function getFirstName(){
		return $this->firstName;
	}
	public function getRights(){
		return $this->rights;
	}
	public function getPassword(){
		return $this->password;
	}
	//SETTER
	public function setPassword($data){
		if (!is_string($data) || empty($data))
			throw new Exception('INVALID PASSWORD ADMIN', 500);
		$this->password = md5($data);
	}
	public function setActived($data){
		if (!is_bool($data))
			throw new Exception('INVALID ACTIVED ADMIN', 500);
		$this->actived = $data;
	}
	public function setMail($data){
		if (!is_string($data) || empty($data) || !filter_var($data, FILTER_VALIDATE_EMAIL))
			throw new Exception('INVALID MAIL ADMIN', 500);
		$this->mail = $data;
	}
	public function setSureName($data){
		if (!is_string($data) || empty($data))
			throw new Exception('INVALID SURENAME ADMIN', 500);
		$this->sureName = $data;
	}
	public function setFirstName($data){
		if (!is_string($data) || empty($data))
			throw new Exception('INVALID FIRSTNAME ADMIN', 500);
		$this->firstName = $data;
	}
	public function setRights($data){
		if (!is_array($data))
			throw new Exception('INVALID RIGHTS ADMIN', 500);
		$this->rights = $data;
	}
	public function addRights($data){
		if (!is_string($data) || empty($data))
			throw new Exception('INVALID RIGHT ADMIN', 500);
		if (!in_array($data, $this->rights))
			$this->rights[] = $data;
	}
	public function delRights($data){
		if (!is_string($data) || empty($data))
			throw new Exception('INVALID RIGHT ADMIN', 500);
		if (in_array($data, $this->rights))
			unset($this->rights[array_search($data, $this->rights)]);
	}
}