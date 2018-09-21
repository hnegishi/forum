<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once  MODELS_PATH.'/sessionDestroy.php';		//ログアウトが押されたらセッションデストロイ

header ('Location: '.WEB_ROOT_PATH.'/login.php');