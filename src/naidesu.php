<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得
include USER_PATH.'/error.inc';