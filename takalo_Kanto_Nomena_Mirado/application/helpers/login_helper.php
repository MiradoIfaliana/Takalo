<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function isLoginValide($nom,$pwd,$users){
	for($i=0;$i<count($users);$i++){
		if($users[$i]['nom']==$nom && $users[$i]['pwd']==$pwd){
			return true;
		}
	}
	return false;
}
function getOneUser($mail,$pwd,$users){
	for($i=0;$i<count($users);$i++){
		if($users[$i]['mail']==$mail && $users[$i]['pwd']==$pwd){
			return $users[$i];
		}
	}
	return null;
}


