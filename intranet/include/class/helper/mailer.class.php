<?php

abstract class Mailer extends KLib\Mail{

	static protected $mailDispatcher = array(
        'TEST' => 'mailerTest',
    );

    static public function mailerTest($mail, $args){
    	var_dump($mail);
    }
}