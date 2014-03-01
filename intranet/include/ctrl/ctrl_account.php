<?php

class AccountController extends KLib\HTMLController{
	protected $js = array();
	protected $css = array();
	protected $actions = array( 'home' 	=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'home',
								),
								'view' 	=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'view',
								),
								'addLog'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'addLog'
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
	public function view(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$account = new Account($this->args['param2']);
		$this->smarty->assign('account', $account);
		$this->smarty->assign('corps', 'account/viewLayout.tpl');
		$this->mainTpl = 'account/layout.tpl';
	}
	public function addLog(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$account = new Account($this->args['param2']);
		if ($_POST['amount'] > 0)
			$account->credit($_POST['amount'], $_POST['label'], $_POST['userId']);
		else
			$account->debit($_POST['amount'], $_POST['label'], $_POST['userId']);
		print json_encode(array('status'=>true));
	}
}
?>
