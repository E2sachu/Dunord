<?php

class CompanyController extends KLib\HTMLController{
	protected $js = array();
	protected $css = array();
	protected $actions = array( 'home' 			=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'home',
								),
								'search' 		=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'search',
								),
								'view' 			=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'view',
								),
								'visibility'	=>array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'visibility',
								),
								'freeApplication'=>array(
												'before'	=> 'preAuthentify',
												'run'		=> 'freeApplication',
								),
								'addF'			=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'addForm',
								),
								'updateF'		=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'updateForm',
								)
							);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('company')){
				$_SESSION['admin'] = serialize($this->args['admin']);
				$this->smarty->assign('admin', $this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID COMPANY', 401);
	}
	public function home(){
		$this->smarty->assign('stat', STAT::companys());
		$this->mainTpl = 'company/layout.tpl';
	}
	public function addForm(){
		$this->smarty->assign('recruiters', SELECT::allRecruiter());
		$this->smarty->assign('companys', SELECT::allCompany());
		$this->mainTpl = 'company/add.tpl';
	}
	public function updateForm(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$company = new Company($this->args['param2']);
		$this->smarty->assign('sectors', C::g('SECTORS'));
		$this->smarty->assign('countries', C::g('COUNTRIES'));
		$this->smarty->assign('cas', C::g('CA'));
		$this->smarty->assign('effectives', C::g('EFFECTIVE'));
		$this->smarty->assign('recruiters', SELECT::allRecruiter());
		$this->smarty->assign('parents', SELECT::allCompany());
		$this->smarty->assign('company', $company);
		$this->mainTpl = 'company/update.tpl';
	}
	public function search(){
		$this->setAjax();
		$results = array();
		if (array_key_exists('needle', $_POST));
			$results = SEARCH::searchCompanys($_POST['needle']);
		$this->smarty->assign('companys', $results);
		$this->mainTpl = 'company/list.tpl';
	}
	public function view(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$company = KLib\instance::of('Company', $this->args['param2']);
		$this->smarty->assign('company', $company);
		$this->smarty->assign('corps', 'company/viewLayout.tpl');
		$this->mainTpl = 'company/layout.tpl';
	}
	public function visibility(){
		$this->setAjax();
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$company = new Company($this->args['param2']);
		if ($company->getVisibility())
			$company->setVisibility(false);
		else
			$company->setVisibility(true);
		$company->update();
		print json_encode(array('status'=>$company->getVisibility()));
	}
		public function freeApplication(){
		$this->setAjax();
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$company = new Company($this->args['param2']);
		if ($company->getFreeApplication())
			$company->setFreeApplication(false);
		else
			$company->setFreeApplication(true);
		$company->update();
		print json_encode(array('status'=>$company->getFreeApplication()));
	}
}
?>