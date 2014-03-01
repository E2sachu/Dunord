<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.i.php
 * Type:     function
 * Name:     i
 * Purpose:  Translate a key of text
 * -------------------------------------------------------------
 */
function smarty_function_i($params, Smarty_Internal_Template $template){
	$lang = null;
	if (array_key_exists('lang', $params))
		$lang = $params['lang'];
	$domain = null;
	if (array_key_exists('domain', $params))
		$domain = $params['domain'];
	if (array_key_exists('key', $params))
		return T::l($params['key'], $domain, $lang);
}
?>