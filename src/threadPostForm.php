<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報

require_once MODELS_PATH.'/threadPost.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$threadPostModel = new threadpostmodel($_POST);	//確認画面から戻ってきた時用
include THREAD_PATH.'/threadPost.inc';