<?php

class CouponController extends KLib\HTMLController{
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
												'validator'	=>	'couponAdd'
									),
								'update'=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'update',
												'validator' =>	'couponAdd'
									),
								'delete'	=> array(
												'before'	=>	'preAuthentify',
												'run'		=>	'delete',
									),
								);
	public function preAuthentify(){
		try{
			$this->args['admin'] = null;
			if (isset($_SESSION['admin'])){
				$this->args['admin'] = Admin::authentifyBySession(3);
			}elseif (isset($_POST['login']) && isset($_POST['password']) && 
					!empty($_POST['login']) && !empty($_POST['password'])){
				$this->args['admin'] = Admin::authentify($_POST['login'], $_POST['password'], 3);
			}
			if (is_a($this->args['admin'], 'Admin'))
				$_SESSION['admin'] = serialize($this->args['admin']);
			else{
				throw new Exception('INVALID USER', 401);
			}
		}catch(Exception $e){
			if (isset($_POST['login']) && isset($_POST['password']) && 
					!empty($_POST['login']) && !empty($_POST['password']))
				throw $e;
		}
		$this->smarty->assign('admin', $this->args['admin']);
	}
	public function home(){
		$this->smarty->assign('coupons', SELECT::allCoupons());
		$this->mainTpl = 'coupon/layout.tpl';
	}
	public function view(){
		$this->onlyContent = true;
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$coupon = KLib\instance::of('Coupon', $this->args['param2']);
		$this->smarty->assign('coupon', $coupon);
		$this->mainTpl = 'coupon/view.tpl';
	}
	public function updateForm(){
		$this->onlyContent = true;
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$coupon = KLib\instance::of('Coupon', $this->args['param2']);
		$this->smarty->assign('coupon', $coupon);
		$this->smarty->assign('products', SELECT::allProducts());
		$this->mainTpl = 'coupon/update.tpl';
	}

	public function addForm(){
		$this->onlyContent = true;
		$this->smarty->assign('products', SELECT::allProducts());
		$this->mainTpl = 'coupon/add.tpl';
	}
	public function add(){
		$this->onlyContent = true;
		//VERIFICATION
		if (Coupon::alreadyExists(trim($_POST['couponKey'])))
			throw new Exception('Conflict', 409);
		$coupon = new Coupon();
		$product = new Product($_POST['productId']);
		$coupon->setProduct($product);
		$coupon->setKey($_POST['couponKey']);
		$coupon->setDateCreate();
		$coupon->setDateStart(KLib\STR::toTime($_POST['couponDateStart']));
		$coupon->setDateEnd(KLib\STR::toTime($_POST['couponDateEnd']));
		$coupon->setCounter($_POST['couponCounter']);
		$coupon->setPrice($_POST['couponPrice']);
		$coupon->save();
		print json_encode(array('id'=>$coupon->getId()));
	}
	public function update(){
		$this->onlyContent = true;
		if (!isset($this->args['param2']))
			throw new Exception ('Not Found', 404);
		$coupon = KLib\instance::of('Coupon', $this->args['param2']);
		$product = new Product($_POST['productId']);
		$coupon->setProduct($product);
		//$coupon->setKey($_POST['couponKey']);
		$coupon->setDateStart(KLib\STR::toTime($_POST['couponDateStart']));
		$coupon->setDateEnd(KLib\STR::toTime($_POST['couponDateEnd']));
		$coupon->setCounter($_POST['couponCounter']);
		$coupon->setStatus($_POST['couponStatus']);
		$coupon->setPrice($_POST['couponPrice']);
		$coupon->update();
		print json_encode(array('id'=>$coupon->getId()));
	}
	public function delete(){
		$coupon = KLib\instance::of('Coupon', $this->args['param2']);
		$coupon->remove();
	}
}
?>