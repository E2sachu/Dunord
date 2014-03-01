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
function smarty_function_config($params, Smarty_Internal_Template $template){
    if (array_key_exists('key', $params))
        return C::g($params['key']);
}
?>