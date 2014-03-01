<?php

namespace KLib;

abstract class i18n {
	static public function translate($key='', $domain=null, $lang=null){
		if (!is_string($key) || empty($key)){
			Log::warning('i18n key-error: '.var_export($key, true));
			return $key;
		}
		if (is_null($domain) || !is_string($domain))
			$domain = C::g('LANG_DOMAIN_CURRENT');
		if (is_null($lang) || !is_string($lang))
			$lang = C::g('LANG_CURRENT');
		if (array_key_exists($lang, C::g('LANG_AVAILABLE')))
			$lang = C::g('LANG_AVAILABLE', $lang);
		putenv('LC_ALL='.$lang);
		setlocale(LC_ALL, $lang);

		bindtextdomain($domain, C::g('LANG_DIR'));
		bind_textdomain_codeset($domain, 'utf-8');
		textdomain($domain);

		return gettext($key);
	}
	static public function l($key='', $domain=null, $lang=null){
		return self::translate($key, $domain, $lang);
	}
	static public function n($key='', $domain=null, $lang=null){
		return self::translate($key, $domain, $lang);
	}
}

class_alias('KLib\i18n', 'T');
class_alias('KLib\i18n', 'i');
?>