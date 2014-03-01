<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.lang.php
 * Type:     function
 * Name:     lang
 * Purpose:  outputs the translated string
 * -------------------------------------------------------------
 */
function smarty_function_lang($params, Smarty_Internal_Template $template){
    $separator = '-';
    if (array_key_exists('separator', $params)){
        $separator = $params['separator'];
        unset($params['separator']);
    }
    $truncate = false;
    if (array_key_exists('truncate', $params)){
        $truncate = $params['truncate'];
        unset($params['truncate']);
    }
    $key = implode($separator, $params);
    $trad = K($key);
    if (is_int($truncate)){
    	$trad = substr($trad, 0, $truncate);
    }elseif (is_string($truncate) && strlen($truncate) == 1){
    	$trad = substr($trad, 0, strpos($trad, $truncate));
    }
    return $trad;
}
?>