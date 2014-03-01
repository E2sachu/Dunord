<?php
C::s('PHPMAILER_MAILER', 'smtp');
C::s('PHPMAILER_HOST', 'localhost');
C::s('PHPMAILER_HOSTNAME', 'localhost');
C::s('PHPMAILER_PORT', 25);
C::s('PHPMAILER_TIMEOUT', 10);
C::s('PHPMAILER_SSL', '');
C::s('PHPMAILER_SMPTPAUTH', false);
C::s('PHPMAILER_SMPTPAUTH_TYPE', '');
C::s('PHPMAILER_SMPTPAUTH_USER', '');
C::s('PHPMAILER_SMPTPAUTH_PSWD', '');
C::s('PHPMAILER_SMPTP_KEEPALIVE', false);

C::s('PHPMAILER_DKIM_SELECTOR', '');
C::s('PHPMAILER_DKIM_IDENTITY', '');
C::s('PHPMAILER_DKIM_PASSPHRASE', '');
C::s('PHPMAILER_DKIM_DOMAIN', '');
C::s('PHPMAILER_DKIM_PRIVATE', '');

C::s('PHPMAILER_CHARSET', 'UTF-8');
C::s('PHPMAILER_CONTENTTYPE', 'text/html');
C::s('PHPMAILER_ENCODING', '8bit');

C::s('PHPMAILER_FROM', 'root@localhost');
C::s('PHPMAILER_REPLYTO', array('root@localhost'));
C::s('PHPMAILER_FROM_NAME', 'Root User');
C::s('PHPMAILER_ALTBODY', 'To view the message, please use an HTML compatible email viewer!');
?>