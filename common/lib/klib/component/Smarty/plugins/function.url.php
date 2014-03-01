<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.url.php
 * Type:     function
 * Name:     url
 * Purpose:  outputs the right url
 * -------------------------------------------------------------
 */
function smarty_function_url($params, Smarty_Internal_Template $template)
{
    if (array_key_exists('path', $params) && filter_var($params['path'], FILTER_VALIDATE_URL))
        return $params['path'];
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
    $host = $_SERVER['HTTP_HOST'];
    if (array_key_exists('host', $params)){
		$host = $params['host'];
		unset($params['host']);
    }
    if (!array_key_exists('path', $params)){
        $uri = $_SERVER['REQUEST_URI'];
        if (array_key_exists('uri', $params)){
            $uri = $params['uri'];
            unset($params['uri']);
        }
        $args = array();
        foreach($params as $key=>$value){
            $args[] = $key.'='.$value;
        }
        $arg = implode('&', $args);
        return $prefix.'://'.$host.$uri.'?'.$arg;
    }else
        return $prefix.'://'.$host.C::g('BASEURL').$params['path'];
}
?>