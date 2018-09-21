<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報取得

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

include COMMENT_PATH.'/commentDeleteResult.inc';