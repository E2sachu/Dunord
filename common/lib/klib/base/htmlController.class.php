<?php

namespace KLib;

abstract class HTMLController extends BaseController{

	protected $smarty = null;
	protected $css = array();
	protected $js = array();
	protected $notifications = array();
	protected $title = 'Dunord S.A.';
	protected $mainTpl = null;
	protected $headerTpl = 'header.tpl';
	protected $footerTpl = 'footer.tpl';
	protected $onlyContent = false;

	public function __construct($action, $args){
		parent::__construct($action, $args);
		$this->smarty = new \Smarty();
		$this->smarty->assign('now', time());
	}

	public function runAction(){
		parent::runAction();
		if (!is_null($this->mainTpl) && is_string($this->mainTpl))
			$this->render();
	}
	public function setAjax($status = true){
		if (!is_bool($status))
			$status = true;
		$this->onlyContent = $status;
	}
	public function render(){
		if (!is_null($this->mainTpl) && is_string($this->mainTpl)){
			if (!$this->onlyContent){
				$this->smarty->assign('headerCss', array_unique(array_merge(C::g('HTMLCONTROLLER_DEFAULT_CSS'), $this->css)));
				$this->smarty->assign('headerJs', array_unique(array_merge(C::g('HTMLCONTROLLER_DEFAULT_JS'), $this->js)));
				$this->smarty->assign('headerTitle', $this->title);
				$this->smarty->assign('headerNotifs', $this->notifications);
				$this->smarty->display($this->headerTpl);
			}
			$this->smarty->display($this->mainTpl);
			if (!$this->onlyContent)
				$this->smarty->display($this->footerTpl);
		}
	}
}