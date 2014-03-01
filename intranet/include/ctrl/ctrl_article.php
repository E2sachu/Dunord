<?php

class ArticleController extends KLib\HTMLController{
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
								'add'			=> array(
												'before'	=> 'preAuthentify',
												'run'		=> 'add',
												'validator' => 'articleAdd'
								),
								'addF'			=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'addForm',
								),
								'update'		=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'update',
												'validator'	=>	'articleAdd'
								),
								'updateF'		=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'updateForm',
								),
								'searchPublished'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'searchPublished'
								),
								'searchUnpublished'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'searchPublished'
								),
								'contentTpl'	=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'contentTplForm',
								),
								'published'		=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'published',
								),
								'delete'		=>	array(
												'before'	=>	'preAuthentify',
												'run'		=>	'delete',
								),
							);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin')){
			if ($this->args['admin']->isAuthorized('article')){
				$_SESSION['admin'] = serialize($this->args['admin']);
				$this->smarty->assign('admin', $this->args['admin']);
			}else
				throw new Exception('Forbidden Access', 403);
		}else
			throw new Exception('INVALID COMPANY', 401);
	}
	public function home(){
		$this->smarty->assign('articles', SELECT::allArticles());
		$this->mainTpl = 'article/layout.tpl';
	}
	public function contentTplForm(){
		$this->setAjax();
		if (!is_file('views/templates/article/content/'.$_POST['tpl']))
			throw new Exception('INVALID TPL', 404);
		$this->smarty->assign('idc', $_POST['idc']);
		$this->mainTpl = 'article/content/'.$_POST['tpl'];
	}
	public function delete(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$article = KLib\instance::of('Article', $this->args['param2']);
		$article->remove();
		print json_encode(array('status' => true));
	}
	public function add(){
		$article = new Article();
		$article->setPublished(false); // est déjà false par défaut, juste au cas ou.
		$article->setContents($_POST['content']);
		$article->setTitle($_POST['title']);
		$article->setUri($_POST['uri']);
		$article->setPageTitle($_POST['pageTitle']);
		$article->setLayout($_POST['layout']);
		if (array_key_exists('author', $_POST))
			$article->setAuthor($_POST['author']);
		if (array_key_exists('datePublished', $_POST))
			$article->setDatePublished($_POST['datePublished']);
		if (array_key_exists('description', $_POST))
			$article->setDescription($_POST['description']);
		if (array_key_exists('language', $_POST))
			$article->setLanguage($_POST['language']);
		if (array_key_exists('tags', $_POST))
			$article->setTags(explode(',', $_POST['tags']));
		if (array_key_exists('keywords', $_POST))
			$article->setKeywords(explode(',', $_POST['keywords']));
		
		$article->save();
		print json_encode(array('status'=>true));
	}
	public function addForm(){
		$this->setAjax();
		$this->smarty->assign('layouts', SELECT::getLayout());
		$this->smarty->assign('templates', SELECT::getTemplate());
		$this->smarty->assign('authors', SELECT::getAuthor());
		$this->smarty->assign('types', SELECT::getType());
		$this->smarty->assign('langues', SELECT::getLang());
		$this->mainTpl = 'article/add.tpl';
	}
	public function update(){
				if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$article = KLib\instance::of('Article', $this->args['param2']);
		$article->setContents($_POST['content']);
		$article->setTitle($_POST['title']);
		$article->setUri($_POST['uri']);
		$article->setPageTitle($_POST['pageTitle']);
		$article->setLayout($_POST['layout']);
		if (array_key_exists('author', $_POST))
			$article->setAuthor($_POST['author']);
		if (array_key_exists('datePublished', $_POST))
			$article->setDatePublished($_POST['datePublished']);
		if (array_key_exists('description', $_POST))
			$article->setDescription($_POST['description']);
		if (array_key_exists('language', $_POST))
			$article->setLanguage($_POST['language']);
		if (array_key_exists('tags', $_POST))
			$article->setTags(explode(',', $_POST['tags']));
		if (array_key_exists('keywords', $_POST))
			$article->setKeywords(explode(',', $_POST['keywords']));
		$article->update();
		print json_encode(array('status'=>true));
	}
	public function updateForm(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$article = KLib\instance::of('Article', $this->args['param2']);
		$this->smarty->assign('layouts', SELECT::getLayout());
		$this->smarty->assign('templates', SELECT::getTemplate());
		$this->smarty->assign('authors', SELECT::getAuthor());
		$this->smarty->assign('types', SELECT::getType());
		$this->smarty->assign('langues', SELECT::getLang());
		$this->smarty->assign('article', $article);
		$this->smarty->assign('corps', 'article/update.tpl');
		$this->mainTpl = 'article/layout.tpl';
	}
	public function search(){
		$this->setAjax();
		$results = array();
		if (array_key_exists('needle', $_POST));
			$results = SEARCH::searchArticles($_POST['needle']);
		$this->smarty->assign('articles', $results);
		$this->mainTpl = 'article/list.tpl';
	}
	public function view(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$article = KLib\instance::of('Article', $this->args['param2']);
		$this->smarty->assign('langues', SELECT::getLang());
		$this->smarty->assign('article', $article);
		$this->smarty->assign('corps', 'article/viewLayout.tpl');
		$this->mainTpl = 'article/layout.tpl';
	}
	public function searchPublished(){
		$this->setAjax();
		$results = array();
		if ($this->args['controllerAction'] == 'searchPublished')
			$results = SELECT::allArticles(true);
		else
			$results = SELECT::allArticles(false);
		$this->smarty->assign('articles', $results);
		$this->mainTpl = 'article/list.tpl';
	}
	public function published(){
	$this->setAjax();
	if (!isset($this->args['param2']))
		throw new Exception ('Not Found', 404);
	$article = KLib\instance::of('Article', $this->args['param2']);
	if ($article->isPublished())
		$article->setPublished(false);
	else
		$article->setPublished(true);
	$article->update();
	print json_encode(array('status'=>$article->isPublished()));
	}
}

?>