<?php

class DefaultController extends KLib\HTMLController{
	protected $js = array(
			
		);
	protected $css = array(
			
		);
	protected $actions = array( '' => array(
												'before'	=>	'preDefault',
												'run' 		=>	'defaultMethod',
											),
								'logout' => array(
												'before'	=>	'preDefault',
												'run' 		=>	'logout',
											),
								);
	public function preDefault(){
		try{
			$this->args['admin'] = null;
			if (isset($_SESSION['admin'])){
				$this->args['admin'] = Admin::authentifyBySession();
			}elseif (isset($_POST['login']) && isset($_POST['password']) && 
					!empty($_POST['login']) && !empty($_POST['password'])){
				$this->args['admin'] = Admin::authentify($_POST['login'], $_POST['password']);
			}
			if (is_a($this->args['admin'], 'Admin'))
				$_SESSION['admin'] = serialize($this->args['admin']);
			elseif (!empty($_POST['login']) || !empty($_POST['password'])){
				$this->notifications[] = array('type' => 'error', 'msg' => 'Votre login/mot de passe est érronée ou vous ne disposez pas de droit d\'accès suffisant.', 'title' => 'Utilisateur Invalide');
			}
		}catch(Exception $e){
			if (isset($_POST['login']) && isset($_POST['password']) && 
				!empty($_POST['login']) && !empty($_POST['password']))
				throw $e;
		}
		$this->smarty->assign('admin', $this->args['admin']);
	}

	public function defaultMethod(){
		if(is_a($this->args['admin'], 'Admin')){
			$this->mainTpl = 'home.tpl';
		}else{
			$this->headerTpl = 'loginHeader.tpl';
			$this->mainTpl = 'login.tpl';
			$this->footerTpl = 'loginFooter.tpl';
		}
		$this->smarty->assign('admin', $this->args['admin']);
	}
	public function logout(){
		session_unset();
		session_destroy();
		header('Location: '.C::getKey('BASEURL'));
	}
}
?>