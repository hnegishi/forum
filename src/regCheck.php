<?php
require_once __DIR__. '/config/const.inc';

require_once MODELS_PATH.'/reg.php';

$regmodel = new regmodel($_POST);
$regmodel->checkLoginId();			//ログインID重複チェック
$regmodel->regexp();					//会員登録入力情報チェック
if(isset($_POST['back']) or $regmodel->error){
	include REG_PATH.'/regForm.inc';
}else{
	include REG_PATH.'/regCheck.inc';
}