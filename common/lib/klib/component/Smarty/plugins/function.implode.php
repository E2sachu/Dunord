<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.config.php
 * Type:     function
 * Name:     config
 * Purpose:  outputs the config parameter for the KLib\Config
 * -------------------------------------------------------------
 */
function smarty_function_implode($params, Smarty_Internal_Template $template){
	$needle = ',';
	if (array_key_exists('needle', $params))
		$needle = $params['needle'];
	$data = array();
	if (array_key_exists('data', $params))
		$data = $params['data'];
	return implode($needle, $data);
}
?>