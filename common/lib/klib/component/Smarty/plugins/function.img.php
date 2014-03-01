<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.img.php
 * Type:     function
 * Name:     img
 * Purpose:  outputs the right url for the image
 * -------------------------------------------------------------
 */
function smarty_function_img($params, Smarty_Internal_Template $template)
{
    $prefix = 'http';
    if (!empty($_SERVER['HTTPS']))
    	$prefix = 'https';
    if (array_key_exists('ssl', $params)){
		if ($params['ssl'])
			$prefix = 'https';
		else
			$prefix = 'http';
		unset($params['ssl']);
    }
    if (isset($_SERVER['SERVER_NAME']))
        $host = $_SERVER['SERVER_NAME'];
    else
        $host = 'www.monkey-tie.com';
    if (array_key_exists('host', $params)){
		$host = $params['host'];
		unset($params['host']);
    }

    $args = implode('/', $params);
    return $prefix.'://'.$host.C::g('BASEURL').$args;
}
?>