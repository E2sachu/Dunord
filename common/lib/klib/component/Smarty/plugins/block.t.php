<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.t.php
 * Type:     block
 * Name:     t
 * Purpose:  Translate a block of text
 * -------------------------------------------------------------
 */
function smarty_block_t($params, $content, Smarty_Internal_Template $template, &$repeat){
	$lang = null;
	$domain = null;
	if (array_key_exists('lang', $params))
		$lang = $params['lang'];
	if (array_key_exists('domain', $params))
		$domain = $params['domain'];
	return T::l($content, $domain, $lang);
	
}
?>