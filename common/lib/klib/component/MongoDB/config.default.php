<?php
Config::setKey('MONGODB_HOST', 'localhost');
Config::setKey('MONGODB_PORT', 27017);
Config::setKey('MONGODB_USER', null);
Config::setKey('MONGODB_PASS', null);
Config::setKey('MONGODB_DBNAME', 'dunord');
Config::setKey('MONGODB_COLLECTNAME', 'users');
Config::setKey('MONGODB_READPREF', \MongoClient::RP_SECONDARY_PREFERRED);
Config::setKey('MONGODB_SEARCH_LIMIT', 100);
