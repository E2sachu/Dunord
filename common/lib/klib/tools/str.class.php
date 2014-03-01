<?php

namespace KLib;

abstract class STR{
	/**
     * Generate random password
     * @param        int     $PwdLength      Password length (def. 8)
     * @param        string  $PwdType        Can be one of these (def. 'any'):
     * - test          always returns the same password = "test"
     * - any           returns a random password, which can contain strange characters
     * - hexa          returns a random password, which can contain hexadecimal characters
     * - numeric  returns a random password, which can contain numeric characters
     * - alphanum returns a random password containing alphanumerics only
     * @return string
     */
    static public function genPassword($PwdLength=8, $PwdType='any'){
        if ('test' == $PwdType)
            return 'test';
        elseif ($PwdType == 'numeric')
            $list = "0123456789";
        elseif ($PwdType == 'hexa')
            $list = "0123456789ABCDEF";
        elseif ($PwdType == 'alphanum')
            $list = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        else
            $list = "0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";

        mt_srand((double)microtime()*1000000);
        $newstring="";
        while( strlen($newstring) < $PwdLength)
			$newstring .= $list[mt_rand(0, strlen($list)-1)];
        return $newstring;
    }
    /**
     * Convert specials chars in corresponding normal chars
     * 
     * @param        string  $str    The string to convert
     * @param        bool    $ponct  Add ponctuation translation
     * @return       string Return Converted string
     */
    static public function toAlNum($str, $ponct=false){
		$chars = array(
			"À" => "A",
			"Á" => "A",
			"Â" => "A",
			"Ä" => "A",
			"Ç" => "C",
			"È" => "E",
			"É" => "E",
			"Ê" => "E",
			"Ä" => "E",
			"Ì" => "I",
			"Í" => "I",
			"Î" => "I",
			"Ï" => "I",
			"Ò" => "O",
			"Ó" => "O",
			"Ô" => "O",
			"Ö" => "O",
			"Ù" => "U",
			"Ú" => "U",
			"Û" => "U",
			"Ü" => "U",
			"à" => "a",
			"á" => "a",
			"â" => "a",
			"ä" => "a",
			"ç" => "c",
			"è" => "e",
			"é" => "e",
			"ê" => "e",
			"ë" => "e",
			"ì" => "i",
			"í" => "i",
			"î" => "i",
			"ï" => "i",
			"ò" => "o",
			"ó" => "o",
			"ô" => "o",
			"ö" => "o",
			"ù" => "u",
			"ú" => "u",
			"û" => "u",
			"ü" => "u",
			"ÿ" => "y");
		if ($ponct){
			$ponctuation = array(
				"\n" => "",
				" " => "",
				"¨" => "",
				'"' => "",
				"'" => "",
				"’" => "",
				"\\" => "",
				"<" => "",
				">" => "",
				"&" => "",
				";" => "");
			$chars = array_merge($chars, $ponctuation);
		}
		$str = strtr($str, $chars);
		return $str;
    }
    /**
     * Convert specials chars in HTML chars
     * 
     * @param        string $str The string to convert
     * @return       string Return Converted string
     */
    static public function toHTML($str){
		$chars = array(
			"\n" => "<BR>",
			"¨" => "&uml;",
			"À" => "&Agrave;",
			"Á" => "&Aacute;",
			"Â" => "&Acirc;",
			"Ä" => "&Auml;",
			"Ç" => "&Ccedil;",
			"È" => "&Egrave;",
			"É" => "&Eacute;",
			"Ê" => "&Ecirc;",
			"Ä" => "&Euml;",
			"Ì" => "&Igrave;",
			"Í" => "&Iacute;",
			"Î" => "&Icirc;",
			"Ï" => "&Iuml;",
			"Ò" => "&Ograve;",
			"Ó" => "&Oacute;",
			"Ô" => "&Ocirc;",
			"Ö" => "&Ouml;",
			"Ù" => "&Ugrave;",
			"Ú" => "&Uacute;",
			"Û" => "&Ucirc;",
			"Ü" => "&Uuml;",
			"à" => "&agrave;",
			"á" => "&aacute;",
			"â" => "&acirc;",
			"ä" => "&auml;",
			"ç" => "&ccedil;",
			"è" => "&egrave;",
			"é" => "&eacute;",
			"ê" => "&ecirc;",
			"ë" => "&euml;",
			"ì" => "&igrave;",
			"í" => "&iacute;",
			"î" => "&icirc;",
			"ï" => "&iuml;",
			"ò" => "&ograve;",
			"ó" => "&oacute;",
			"ô" => "&ocirc;",
			"ö" => "&ouml;",
			"ù" => "&ugrave;",
			"ú" => "&uacute;",
			"û" => "&ucirc;",
			"ü" => "&uuml;",
			"ÿ" => "&yuml;",
			'"' => "&quot;",
			"'" => "&rsquo;",
			"’" => "&rsquo;",
			"\\" => "",
			"<" => "&lt;",
			">" => "&gt;",
			"&" => "&amp;",
			";" => " ");
		$str = strtr($str, $chars);
		return $str;
    }
    /**
     * Convert HTML specials characters to UTF-8 String
     * 
     * @param        string $str The string to convert
     * @return       string Return converted string
     */
    static public function toNorm($str){
		$chars = array(
			"<BR>" => "",
			"&uml;" => "",
			"&nbsp;" => " ",
			"&Agrave;" => "À",
			"&Aacute;" => "Á",
			"&Acirc;" => "Â",
			"&Auml;" => "Ä",
			"&Ccedil;" => "Ç",
			"&Egrave;" => "È",
			"&Eacute;" => "É",
			"&Ecirc;" => "Ê",
			"&Euml;" => "Ä",
			"&Igrave;" => "Ì",
			"&Iacute;" => "Í",
			"&Icirc;" => "Î",
			"&Iuml;" => "Ï",
			"&Ograve;" => "Ò",
			"&Oacute;" => "Ó",
			"&Ocirc;" => "Ô",
			"&Ouml;" => "Ö",
			"&Ugrave;" => "Ù",
			"&Uacute;" => "Ú",
			"&Ucirc;" => "Û",
			"&Uuml;" => "Ü",
			"&agrave;" => "à",
			"&aacute;" => "á",
			"&acirc;" => "â",
			"&auml;" => "ä",
			"&ccedil;" => "ç",
			"&egrave;" => "è",
			"&eacute;" => "é",
			"&ecirc;" => "ê",
			"&euml;" => "ë",
			"&igrave;" => "ì",
			"&iacute;" => "í",
			"&icirc;" => "î",
			"&iuml;" => "ï",
			"&ograve;" => "ò",
			"&oacute;" => "ó",
			"&ocirc;" => "ô",
			"&ouml;" => "ö",
			"&ugrave;" => "ù",
			"&uacute;" => "ú",
			"&ucirc;" => "û",
			"&uuml;" => "ü",
			"&yuml;" => "ÿ",
			"&quot;" => '"',
			"&rsquo;" => "'",
			"&lt;" => "<",
			"&gt;" => ">",
			"&amp;" => "&");
		$str = strtr($str, $chars);
		return $str;
    }
    /**
     * Convert HTML specials characters to UTF-8 String
     * 
     * @param        string $str The string to convert
     * @return       string Return converted string
     */
    static public function toPDF($str){
		return utf8_decode(self::to_NORM($str));
    }
    /**
     * Convert date string to timestamp
     * 
     * @param        string $str The string to convert
     * @return       int Return converted timestamp
     */
    static public function toTime($str, $format='d/m/Y H:i'){
    	if ((!is_string($format) || empty($format)) && (!is_string($str) || empty($str)))
    		throw new Exception('INVALID DATETIME FORMAT', 500);
    	$date = date_parse_from_format($format, $str);
    	return mktime(	$date['hour'], $date['minute'], $date['second'], 
    					$date['month'], $date['day'], $date['year']
    				);
    }
} 