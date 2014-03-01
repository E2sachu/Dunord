<?php

class AdminController extends KLib\HTMLController{
	protected $js = array();
	protected $css = array();
	protected $actions = array( 'home' 			=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'home',
								),
								'view' 		=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'view',
								),
								'addF'			=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'addForm',
								),
								'add'			=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'add',
								),
								'updateF'		=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'updateForm',
								)
							);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('admin')){
				$_SESSION['admin'] = serialize($this->args['admin']);
				$this->smarty->assign('admin', $this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID COMPANY', 401);
	}
	public function home(){
		$this->smarty->assign('admins', SELECT::allAdmins());
		$this->mainTpl = 'admin/layout.tpl';
	}
	public function addForm(){
		$this->mainTpl = 'admin/add.tpl';
	}
	public function updateForm(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$admin = KLib\instance::of('Admin', $this->args['param2']);
		$this->smarty->assign('admin', $admin);
		$this->mainTpl = 'admin/update.tpl';
	}
	public function view(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$admin = KLib\instance::of('Admin', $this->args['param2']);
		$this->smarty->assign('user', $admin);
		$this->smarty->assign('corps', 'admin/view.tpl');
		$this->mainTpl = 'admin/layout.tpl';
	}
}
?>