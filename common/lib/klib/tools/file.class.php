<?php

namespace KLib;

abstract class File{
	/**
	 * Transfert file from upload directory to an other
	 *
	 * @param     string[]        $fich                   The file($_FILES['file'])
	 * @param     string          $dossier                The destination
	 * @param     string          $new_name               New filename if empty use the regular file name (def. '')
	 * @param     bool            $createfolder   Create the directory if necessary (def. false)
	 * @return    string filename of the file. FALSE if error.
	 */
	static public function move ($fich, $dossier, $new_name = '', $createfolder=false){
		if(!empty($fich["name"])){
			if (substr($dossier, -1) != '/')
				$dossier .= '/';
			if ($new_name == '')
				$new_name = $fich["name"] ;
			if (!is_dir($dossier) && $createfolder)
				mkdir($dossier, 0755, true);
			$num = 0;
			$origin_name = $new_name;
			while((is_file($dossier.$new_name))){
				$num++;
				$new_name = self::fileNameWithoutExtension($origin_name).'_('.$num.').'.self::get_Extension_File($origin_name);
			}
			if(copy($fich["tmp_name"], $dossier.$new_name))
				return $new_name;
			else
				return false;
		}
		return false;
	}
	/**
	 * Encode file in base64
	 *
	 * @param     string[]        $fich                   The file($_FILES['file'])
	 * @return    string encoded file. FALSE if error.
	 */
	static public function encodeB64($file){
		if(!empty($file["name"])){
			return base64_encode(file_get_contents($file['tmp_name']));
		}
		return false;
	}
	/**
     * Get the filename without the extension
     *
     * @param       string $str Filename
     * @return      string the filename of the file
     */
    static public function fileNameWithoutExtension($str){
        return substr($str, 0, strrpos($str, '.'));
    }
    /**
     * Get the file extension
     *
     * @param       string $str Filename
     * @return      string the extension  of the file
     */
    static public function fileNameExtension($str){
		return substr($str, (strrpos($str, '.')+1));
    }
}