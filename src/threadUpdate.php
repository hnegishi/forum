<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/threadUpdate.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$threadUpdateModel = new threadupdatemodel($_POST);
$threadUpdateModel->checkUserThread();				//スレッドの投稿者であるかチェック
$threadUpdateModel->hideDeletedThread();			//削除済みのスレッドかチェック
$threadUpdateModel->setThread();						//スレッド情報取得
if($threadUpdateModel->error){
	header('Location: '.WEB_ROOT_PATH.'/error.inc');
}
include THREAD_PATH.'/threadUpdate.inc';