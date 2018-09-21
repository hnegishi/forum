<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;				//ログイン情報チェック

require_once MODELS_PATH.'/threadDelete.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー名取得

$threadDeleteModel = new threaddeletemodel($_POST);
$threadDeleteModel->checkUserThread();			//スレッドの投稿者化チェック
$threadDeleteModel->threadDelete();					//スレッド論理削除
header('Location: '.WEB_ROOT_PATH.'/threadDeleteResult.php');