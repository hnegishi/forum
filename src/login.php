<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once  MODELS_PATH.'/login.php';

session_start();
$loginModel = new loginmodel($_POST);
$loginModel->loginCheck();			//ユーザー情報をDBと照合
if($_POST['loginId'] and $_POST['pass']){
	if(!$loginModel->error){
		header('Location: '.WEB_ROOT_PATH.'/top.php');
	}
}
include LOGIN_PATH.'/login.inc';