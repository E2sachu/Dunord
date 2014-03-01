<?php

class STAT{

	static public function users(){
		$ret['total'] = KLib\MongoDB::count(array(), 'users');
		$ret['candidat'] = KLib\MongoDB::count(array('profilType'=>1), 'users');
		$ret['recruiter'] = KLib\MongoDB::count(array('profilType'=>2), 'users');
		return $ret;
	}
	static public function companys(){
		$ret['total'] = KLib\MongoDB::count(array(), 'company');
		return $ret;
	}
    static public function offers(){
        $ret['total'] = KLib\MongoDB::count(array(), 'offre');
        return $ret;
    }
    static public function candidatures(){
    	$ret['total'] = KLib\MongoDB::count(array(), 'offre');
    	$ret['enAttente'] = KLib\MongoDB::count(array('candidatures.status' => 0), 'offre');
    	$ret['accepter'] = KLib\MongoDB::count(array('candidatures.status' => 1), 'offre');
    	$ret['refuser'] = KLib\MongoDB::count(array('candidatures.status' => 2), 'offre');
    	return $ret;
    } 
    static public function materials(){
        $ret['total'] = KLib\MongoDB::count(array(), 'material');
        return $ret;
    }
}