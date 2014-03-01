<?php

class UserController extends KLib\HTMLController{
	protected $js = array();
	protected $css = array();
	protected $actions = array( 'home' 	=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'home',
								),
								'search' 	=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'search',
								),
								'searchRecruiter' => array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'searchRecruiter',
								),
								'view' 	=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'view',
								),
								'actived'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'actived',
								),
								'locked'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'locked',
								),
								'reinitPwd'	=> 	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'reinitPassword',
								),
								'searchUnlocked'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'searchLocked',
								),
								'searchLocked'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'searchLocked',
								),
								'searchActived'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'searchActived',
								),
								'searchUnactived'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'searchActived',
								),
								'add'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'add',
												'validator'	=>	'userAdd'
									),
								'addF'=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'addForm',
								),
								'updateF'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'updateForm',
								),
								'update'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'update',
								),
								'delete'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'delete',
								),
							);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('user')){
				$_SESSION['admin'] = serialize($this->args['admin']);
				$this->smarty->assign('admin', $this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID USER', 401);
	}
	public function delete(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		if (!is_a($user, 'Candidate') || count($user->getCandidatures()) > 0 || count($user->getInvitations()) > 0 )
			throw new Exception('DELETE NOT AVAILABLE FOR THIS USER ACCOUNT', 403);
		$account = $user->getAccount();
		$account->remove();
		$user->remove();
		print json_encode(array('status' => true));
	}
	public function updateForm(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		$this->smarty->assign('user', $user);
		$this->smarty->assign('corps', 'user/update.tpl');
		$this->mainTpl = 'user/layout.tpl';
	}
	public function update(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		$user->setNom($_POST['user']['nom']);
		$user->setMail1($_POST['user']['mail']);
		$user->setPrenom($_POST['user']['prenom']);
		if (is_string($_POST['user']['parent']) && !empty($_POST['user']['parent'])){
			$parent = User::getUser($_POST['user']['parent']);
			if (is_a($parent, 'User'))
				$user->setParent($parent);
		}
		$user->update();
		print json_encode(array('status'=>true));
	}
	public function add(){
		if ($_POST['user']['profilType'] == '2'){//RECRUITER
			$user = new Recruiter();
			$user->setProfilType(2);
		}else{//CANDIDAT
			$user = new Candidate();
			$user->setProfilType(1);
		}
		$already = KLib\MongoDB::findOne(array('mail1'=>$_POST['user']['mail']), 'users');
		if (empty($already)){
			$img = file_get_contents("static/img/profil_userPhotoDefault.jpg");
			$user->setNom($_POST['user']['nom']);
			$user->setPrenom($_POST['user']['prenom']);
			$user->setMail1($_POST['user']['mail']);
			$user->setMotDePasse($_POST['user']['password']);
			$user->setActived(($_POST['user']['actived']=='true')?true:false);
			$user->setLocked(($_POST['user']['locked']=='true')?true:false);
			$user->setValidateMail(hash("sha256", $_POST['user']['prenom'] . rand(0, 1000000) . strtoupper($_POST['user']['nom'])));
	        $user->setPhoto("data:image/jpg;base64," . base64_encode($img));
			$user->setDateInscription($_POST['user']['dateinscrit']);
			$user->save();
			if (is_a($user, 'Recruiter')) {
				if (is_string($_POST['user']['parent']) && !empty($_POST['user']['parent'])){
					$parent = User::getUser($_POST['user']['parent']);
					if (is_a($parent, 'User'))
						$user->setParent($parent);
					$company = $parent->getCompany();
					$account = $parent->getAccount();
				}else{
					if (is_string($_POST['company']['id']) && !empty($_POST['company']['id'])){
						$company = new Company($_POST['company']['id']);
						$account = $company->getAdmin()->getAccount();
					}elseif (VALIDATOR::companyAdd()){
						$company = new Company();
						$company->setLabel($_POST['company']['label']);
						$company->setAddress1($_POST['company']['addr1']);
						$company->setAddress2($_POST['company']['addr2']);
						$company->setCountry($_POST['company']['country']);
						$company->setCity($_POST['company']['city']);
						$company->setZipCode($_POST['company']['zipcode']);
						$company->setMailContact($_POST['company']['mail']);
						$company->setFreeApplication(($_POST['company']['freeApplication']=='true')?true:false);
						$company->setMission($_POST['company']['mission']);
						$company->setVisibility(($_POST['company']['visible']=='true')?true:false);
						$company->setAdmin($user);
						if (is_string($_POST['company']['parent']) && !empty($_POST['company']['parent'])){
							$parent = new Company($_POST['company']['parent']);
							$company->setParent($parent);
						}
						$company->save();
						$account = new Account();
						$account->setAdmin($user);
						$account->save();
					}else{
						$this->notifications[] = array('type'=> 'error', 'msg'=> 'Informations invalide pour la compagnie', 'title'=>'Erreur');
						$this->home();
					}
				}
				$user->setCompanyId($company->getId());
				$user->setAccountId($account->getId());
				$user->update();
			}else{
				$account = new Account();
				$account->setAdmin($user);
				$account->save();
				$user->setAccountId($account->getId());
				$user->update();
			}
			$this->args['param2'] = $user->getId();
			$this->view();
		}else{
			$this->notifications[] = array('type'=> 'error', 'msg'=> 'Adresse mail déjà existante', 'title'=>'Erreur');
			$this->home();
		}
			
	}
	public function addForm(){
		$this->smarty->assign('recruiters', SELECT::allRecruiter());
		$this->smarty->assign('companys', SELECT::allCompany());
		$this->mainTpl = 'user/add.tpl';
	}
	public function home($corp=null){
		$this->smarty->assign('stat', STAT::users());
		$this->mainTpl = 'user/layout.tpl';
	}
	public function search(){
		$this->setAjax();
		$results = array();
		if (array_key_exists('needle', $_POST));
			$results = SEARCH::searchUsers($_POST['needle']);
		$this->smarty->assign('users', $results);
		$this->mainTpl = 'user/list.tpl';
	}
	public function searchRecruiter(){
		$this->setAjax();
		$this->smarty->assign('users', SELECT::allRecruiter());
		$this->mainTpl = 'user/list.tpl';
	}
	public function view(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		$this->smarty->assign('user', $user);
		$this->smarty->assign('corps', 'user/viewLayout.tpl');
		$this->mainTpl = 'user/layout.tpl';
	}
	public function actived(){
		$this->setAjax();
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		if ($user->isActived())
			$user->disactived();
		else
			$user->actived();
		$user->update();
		print json_encode(array('status'=>$user->isActived()));
	}
	public function locked(){
		$this->setAjax();
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		if ($user->isLocked())
			$user->dislocked();
		else
			$user->locked();
		$user->update();
		print json_encode(array('status'=>$user->isLocked()));
	}
	public function reinitPassword(){
		$this->setAjax();
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$user = User::getUser($this->args['param2']);
		$user->setMotDePasse(array_key_exists('password', $_POST)?$_POST['password']:'MonkeyTie2014');
		$user->update();
		print json_encode(array('status'=>true));
	}
	public function searchActived(){
		$this->setAjax();
		$results = array();
		if ($this->args['controllerAction'] == 'searchActived')
			$results = SEARCH::searchActivedUsers(true);
		else
			$results = SEARCH::searchActivedUsers(false);
		$this->smarty->assign('users', $results);
		$this->mainTpl = 'user/list.tpl';
	}
	public function searchLocked(){
		$this->setAjax();
		$results = array();
		if ($this->args['controllerAction'] == 'searchLocked')
			$results = SEARCH::searchLockedUsers(true);
		else
			$results = SEARCH::searchLockedUsers(false);
		$this->smarty->assign('users', $results);
		$this->mainTpl = 'user/list.tpl';
	}
}
?>
