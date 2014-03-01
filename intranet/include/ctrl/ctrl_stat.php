<?php

class StatController extends KLib\HTMLController{
	protected $js = array();
	protected $css = array();
	protected $actions = array( 
								'home'	=>	array(
										'before'	=>	'preAuthentify',
										'run' 		=>	'home',
									),
								'userChart' 	=> array(
										'before'	=>	'preAuthentify',
										'run' 		=>	'userChart',
									),
								'todaySubscription' => array(
										'before'	=>	'preAuthentify',
										'run' 		=>	'todaySubscription',
									),
								'monthlySubsciption' => array(
										'before'	=>	'preAuthentify',
										'run' 		=>	'monthlySubsciption',	
									),
								'totalOffer'		=> array(
										'before'	=> 'preAuthentify',
										'run'		=> 'totalOffer',
									),
								'candidatureChart'	=> array(
										'before'	=> 'preAuthentify',
										'run'		=> 'candidatureChart',									)

								);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('stat')){
				$_SESSION['admin'] = serialize($this->args['admin']);
				$this->smarty->assign('admin', $this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID USER', 401);
	}
	public function home(){
		$this->mainTpl = 'stat/layout.tpl';
	}
	public function userChart(){
		$this->setAjax();
		$data[] = array(
					'color' => '#F7464A',
					'type' 	=>	'Recruteur',
					'value' => KLib\MongoDB::count(array('profilType' => 2), 'users')
					);
		$data[] = array(
					'color' => '#4D5360',
					'type' 	=>	'Candidat',
					'value' => KLib\MongoDB::count(array('profilType' => 1), 'users')
					);
		print json_encode($data);
	}
	public function todaySubscription(){
		$this->setAjax();
		$today = mktime(0,0,0);
		$data = KLib\MongoDB::count(array('dateInscription' => array('$gt'=> $today)), 'users');
		print json_encode(array('today' => $data));
	}
	public function monthlySubsciption(){
		$this->setAjax();
		print '{}';
	}
	public function totalOffer(){
		$this->setAjax();
		$data = KLib\MongoDB::count(array(	
											'datePublication' => array('$lt'=> time()), 
											'datePublication'=> array('$gt'=>10))
									, 'offre');
		print json_encode(array('total' => $data));
	}
	public function candidatureChart(){
		$this->setAjax();
		$data[] = array(
					'color' => '#AB8900',
					'type' 	=> 'En attente',
					'value' => KLib\MongoDB::count(array('candidatures.status' => 0), 'offre')
					);
		$data[] = array(
					'color' => '#06AB00',
					'type' 	=> 'Acceptées',
					'value' => KLib\MongoDB::count(array('candidatures.status' => 1), 'offre')
					);
		$data[] = array(
					'color' => '#AB0000',
					'type' 	=> 'Refusées',
					'value' => KLib\MongoDB::count(array('candidatures.status' => 2), 'offre')
					);
		print json_encode($data);
	}
}
?>