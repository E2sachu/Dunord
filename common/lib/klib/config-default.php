<?php
namespace KLib;

//GLOBAL CONF
Config::setKey('DEV', true);
Config::setKey('BASEURL', '/');
//TOOLS LOG
Config::setKey('LOG_OUT_FILE', './log/test.log');
Config::setKey('LOG_REGISTRED', true);
Config::setKey('LOG_DEFAULT_LEVEL', Log::WARNING);
//BASE CONTROLLER
Config::setKey('CRTL_ROUTES', array());
//BENCH
Config::setKey('BENCH_LOG', false);