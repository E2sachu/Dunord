<?php

class ProductController extends KLib\HTMLController{
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
								'addF'	=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'addForm',
									),
								'updateF'=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'updateForm',
									),
								'add'	=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'add',
												'validator'	=>	'productAdd'
									),
								'update'=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'update',
												'validator'	=>	'productAdd'
									),
								'delete'=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'delete',
									)
								);
	public function preAuthentify(){
		$this->args['admin'] = Admin::authentifyBySession();
		if (is_a($this->args['admin'], 'Admin'))
			$_SESSION['admin'] = serialize($this->args['admin']);
		else
			throw new Exception('INVALID USER', 401);
		$this->smarty->assign('admin', $this->args['admin']);
	}
	public function home(){
		$this->smarty->assign('products', SELECT::allProducts());
		$this->mainTpl = 'product/layout.tpl';
	}
	public function view(){
		$this->onlyContent = true;
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$product = KLib\instance::of('Product', $this->args['param2']);
		$this->smarty->assign('product', $product);
		$this->mainTpl = 'product/view.tpl';
	}
	public function updateForm(){
		$this->onlyContent = true;
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$product = KLib\instance::of('Product', $this->args['param2']);
		$this->smarty->assign('product', $product);
		$this->mainTpl = 'product/update.tpl';
	}
	public function update(){
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$product = KLib\instance::of('Product', $this->args['param2']);
		$product->setLabel($_POST['productLabel']);
		$product->setPrice($_POST['productPrice']);
		if (array_key_exists('productDescription', $_POST))
			$product->setDescription($_POST['productDescription']);
		if (array_key_exists('productExecFct', $_POST))
			$product->setExecFct($_POST['productExecFct']);
		if (array_key_exists('productType', $_POST))
			$product->setType($_POST['productType']);
		$product->update();
		$this->home();
	}
	public function addForm(){
		$this->onlyContent = true;
		$this->mainTpl = 'product/add.tpl';
	}
	public function delete(){
		$this->onlyContent = true;
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$product = KLib\instance::of('Product', $this->args['param2']);
		$product->remove();
	}
	public function add(){
		$product = new Product();
		$product->setLabel($_POST['productLabel']);
		$product->setPrice($_POST['productPrice']);
		if (array_key_exists('productDescription', $_POST))
			$product->setDescription($_POST['productDescription']);
		if (array_key_exists('productExecFct', $_POST))
			$product->setExecFct($_POST['productExecFct']);
		if (array_key_exists('productType', $_POST))
			$product->setType($_POST['productType']);
		$product->save();
		$this->home();
	}
}
?>