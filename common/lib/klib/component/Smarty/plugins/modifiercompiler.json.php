<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsModifierCompiler
 */

/**
 * Smarty JsonPrettifier modifier plugin
 *
 * Type:     modifier<br>
 * Name:     json<br>
 * Purpose:  Prettify a JSON representation
 *
 * @link http://www.smarty.net/manual/en/language.modifier.lower.php lower (Smarty online manual)
 * @author Quentin DORE <q.dore@monkey-tie.com>
 * @param array $params parameters
 * @return string with compiled code
 */

function smarty_modifiercompiler_json($params, $compiler){
	return 'nl2br(json_encode('. $params[0] .', JSON_PRETTY_PRINT));';
}
