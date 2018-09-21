<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require MODELS_PATH.'/reg.php';
$regModel = new regmodel($_POST);
$regModel->insertReg();				//入力情報DB登録
header ('Location: '.WEB_ROOT_PATH.'/regResult.php');