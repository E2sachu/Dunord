<?php
session_start();
require_once('include/global.inc.php');
try{
	//VERIFICATION
	if (!VALIDATOR::basicParams())
		throw new Exception('Precondition Failed', 412);
	//START ACTION
	if (!isset($_GET['ctrl']) || empty($_GET['ctrl']))
		$_GET['ctrl'] = 'default';
	if (!isset($_GET['param1']) || empty($_GET['param1']))
		$_GET['param1'] = '';
	KLib\BaseController::run($_GET['ctrl'], $_GET['param1'], $_GET);
}catch(Exception $e){
	//LOG EXCEPTION
	KLib\Log::warning($e->getCode().' '.$e->getMessage());
	//FORMAT EXCEPTION
	switch ($e->getCode()) {
		case 404:
			KLib\BaseController::run('error', 'notFound', array('exception' => $e));
		break;
		case 500:
			KLib\BaseController::run('error', 'internalError', array('exception' => $e));
		break;
		case 409:
    		KLib\BaseController::run('error', 'conflict', array('exception' => $e));
		break;
		case 401:
    		KLib\BaseController::run('error', 'authFailed', array('exception' => $e));
		break;
		default:
			header('HTTP/1.1 '.$e->getCode().' '.$e->getMessage());
		break;
	}
}
?>