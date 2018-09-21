<?php
require_once __DIR__. '/config/const.inc';		//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー名取得

include THREAD_PATH.'/threadUpdateResult.inc';