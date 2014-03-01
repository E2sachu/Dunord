<?php 

Class AutocompleteController extends KLib\BaseController{
	protected $actions = array( 'city' 			=> array(
												'before'	=>	'preAuthentify',
												'run' 		=>	'city',
								)
							);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('company')){
				$_SESSION['admin'] = serialize($this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID COMPANY', 401);
	}
	public function city(){
		print json_encode(AutoComplete::city($_GET['q']));
	}
}