<?php

class ErrorController extends KLib\HTMLController{
	protected $js = array(
			'static/js/libs/jquery.min.js',
			'static/js/libs/jquery.pnotify.min.js',
			'static/js/libs/bootstrap.min.js',
			'static/js/main.js',
		);
	protected $css = array(
			'static/css/style.css',
        	'static/css/bootstrap.min.css',
			'static/css/bootstrap-theme.min.css',
			'static/css/font-awesome.min.css',
			'static/css/jquery.pnotify.default.css',
		);
	protected $actions = array( 'authFailed' => array(
												'run' => 'authFailed',
											),
								'internalError' => array(
												'run' => 'internalError',
											),
								'notFound' => array(
												'run' => 'notFound',
											),
								'conflict' => array(
												'run' => 'conflict',
											)
						);
	public function authFailed(){
		if (array_key_exists('exception', $this->args)){
			$this->notifications[] = array('type' => 'success', 'title'=>"Erreur d'identification", 'msg' => "Votre login/mot de passe est érronée ou vous ne disposez pas de droit d'accès suffisant.", 'title' => 'Utilisateur Invalide');
		}
		$this->headerTpl = 'loginHeader.tpl';
		$this->mainTpl = 'login.tpl';
		$this->footerTpl = 'loginFooter.tpl';
	}
	public function internalError(){
		if (array_key_exists('exception', $this->args)){
			$this->notifications[] = array('type' => 'error', 'title'=>"Erreur interne", 'msg' => 'Une erreur est survenue.');
		}
		$this->mainTpl = 'error/internalError.tpl';
	}
	public function notFound(){
		if (array_key_exists('exception', $this->args)){
			$this->notifications[] = array('type' => 'error', 'title'=>"404", 'msg' => 'Page introuvable.');
		}
		$this->mainTpl = 'error/notFound.tpl';
	}
	public function conflict(){
		if (array_key_exists('exception', $this->args))
			print json_encode(array('text' => $this->args['exception']->getCode(), 'title'=>$this->args['exception']->getMessage()));
	}
}