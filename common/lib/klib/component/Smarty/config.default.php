<?php
/**
 * auto literal on delimiters with whitspace
 * @var boolean
 */
!defined('SMARTY_AUTO_LITERAL')?define('SMARTY_AUTO_LITERAL', true):true;
/**
 * display error on not assigned variables
 * @var boolean
 */
!defined('SMARTY_ERROR_UNASSIGNED')?define('SMARTY_ERROR_UNASSIGNED', false):true;
/**
 * look up relative filepaths in include_path
 * @var boolean
 */
!defined('SMARTY_USE_INCLUDE_PATH')?define('SMARTY_USE_INCLUDE_PATH', false):true;
/**
 * template directory
 * @var string
 */
!defined('SMARTY_TEMPLATE_DIR')?define('SMARTY_TEMPLATE_DIR', './views/templates/'):true;

/**
 * config directory
 * @var array
 */
!defined('SMARTY_COMPILE_FORCE')?define('SMARTY_COMPILE_FORCE', false):true;
/**
 * check template for modifications?
 * @var boolean
 */
!defined('SMARTY_COMPILE_CHECK')?define('SMARTY_COMPILE_CHECK', true):true;
/**
 * use sub dirs for compiled/cached files?
 * @var boolean
 */
!defined('SMARTY_USE_SUB_DIRS')?define('SMARTY_USE_SUB_DIRS', true):true;
/**
 * compile directory
 * @var string
 */
!defined('SMARTY_COMPILE_DIR')?define('SMARTY_COMPILE_DIR', '../cache/Smarty/'.APPNAME.'/templates_c/'):true;
/**
 * cache directory
 * @var string
 */
!defined('SMARTY_CACHE_DIR')?define('SMARTY_CACHE_DIR', '../cache/Smarty/'.APPNAME.'/cache/'):true;
/**
 * caching enabled
 * @var boolean
 */
!defined('SMARTY_CACHING')?define('SMARTY_CACHING', false):true;
/**
 * cache lifetime in seconds
 * @var integer
 */
!defined('SMARTY_CACHE_LIFETIME')?define('SMARTY_CACHE_LIFETIME', 3600):true;
/**
 * force cache file creation
 * @var boolean
 */
!defined('SMARTY_CACHE_FORCE')?define('SMARTY_CACHE_FORCE', false):true;
/**
 * template left-delimiter
 * @var string
 */
!defined('SMARTY_LEFT_DELIMITER')?define('SMARTY_LEFT_DELIMITER', '{'):true;
/**
 * template right-delimiter
 * @var string
 */
!defined('SMARTY_RIGHT_DELIMITER')?define('SMARTY_RIGHT_DELIMITER', '}'):true;
?>