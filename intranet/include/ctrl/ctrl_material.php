<?php

Class MaterialController extends KLib\HTMLController{
	protected $js = array();
	protected $css = array();
	protected $actions = array( 'home' 	=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'home',
								),
							);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('account')){
				$_SESSION['admin'] = serialize($this->args['admin']);
				$this->smarty->assign('admin', $this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID USER', 401);
	}
	public function home($corp=null){
		$this->smarty->assign('stat', STAT::materials());
		$this->mainTpl = 'material/layout.tpl';
	}
}