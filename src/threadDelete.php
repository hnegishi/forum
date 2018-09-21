<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/threadDelete.php';
require_once MODELS_PATH.'/models/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー名取得

$threadDeleteModel = new threaddeletemodel($_POST);
$threadDeleteModel->checkUserThread();			//スレッドの投稿者かチェック
$threadDeleteModel->hideDeletedThread();		//削除されたスレッドかチェック
$threadDeleteModel->setThread();						//スレッド情報取得
$threadDeleteModel->getResult();
if($threadDeleteModel->error){
	header('Location: '.WEB_ROOT_PATH.'/error.inc');
	exit;
}
include THREAD_PATH.'/threadDelete.inc';