<?php
namespace KLib;

class Mail extends PHPMailer{

	static protected $smarty = null;

	public function __construct($exceptions = false){
		parent::__construct($exceptions);
		if (C::g('PHPMAILER_MAILER') == 'smtp')
			$this->IsSMTP();
		$this->Mailer = C::g('PHPMAILER_MAILER');
		$this->Host = C::g('PHPMAILER_HOST');
		$this->Hostname = C::g('PHPMAILER_HOSTNAME');
		$this->Port = C::g('PHPMAILER_PORT');
		$this->Timeout = C::g('PHPMAILER_TIMEOUT');
		$this->SMTPSecure = C::g('PHPMAILER_SSL');
		$this->SMTPAuth = C::g('PHPMAILER_SMPTPAUTH');
		$this->AuthType = C::g('PHPMAILER_SMPTPAUTH_TYPE');
		$this->Username = C::g('PHPMAILER_SMPTPAUTH_USER');
		$this->Password = C::g('PHPMAILER_SMPTPAUTH_PSWD');
		$this->SMTPKeepAlive = C::g('PHPMAILER_SMPTP_KEEPALIVE');

		$this->DKIM_selector = C::g('PHPMAILER_DKIM_SELECTOR');
		$this->DKIM_identity = C::g('PHPMAILER_DKIM_IDENTITY');
		$this->DKIM_passphrase = C::g('PHPMAILER_DKIM_PASSPHRASE');
		$this->DKIM_domain = C::g('PHPMAILER_DKIM_DOMAIN');
		$this->DKIM_private = C::g('PHPMAILER_DKIM_PRIVATE');

		$this->CharSet = C::g('PHPMAILER_CHARSET');
		$this->ContentType = C::g('PHPMAILER_CONTENTTYPE');
		$this->Encoding = C::g('PHPMAILER_ENCODING');

		$this->From = C::g('PHPMAILER_FROM');
		$this->FromName = C::g('PHPMAILER_FROM_NAME');
		$this->AltBody = C::g('PHPMAILER_ALTBODY');
	}

	static public function sendMail($key, $args=array()){
		if (!array_key_exists($key, \Mailer::$mailDispatcher))
            throw new \Exception('INVALID MAILER');
        $mail = new self(true);
        $mthd = \Mailer::$mailDispatcher[$key];
        if (!\Mailer::$mthd($mail, $args))
			Log::warning('Mail '.$key.' Not send !');
		else{
			if (C::g('MAILER_DEV')){
	        	$mail->clearAddresses();
	        	$mail->clearCCs();
	        	$mail->clearBCCs();
	        	$mail->addAddress(C::g('MAILER_DEV_MAILTO'), 'DEBUG MAILER');
	        }
	        return $mail->send();
	    }
	}
}