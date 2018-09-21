<?php
require_once __DIR__. '/config/const.inc';		//定数ファイル
require_once SESSION_PATH;				//ログイン情報チェック

require_once MODELS_PATH.'/threadUpdate.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$threadUpdateModel = new threadupdatemodel($_POST,$_FILES);
$threadUpdateModel->checkUserThread();			//スレッド投稿者かチェック
$threadUpdateModel->setThread();					//スレッド情報取得
$threadUpdateModel->strLimit();						//入力値チェック
if($_FILES['upfile']['name'] !==''){
	$threadUpdateModel->createImgName();			//画像名を作成
	$threadUpdateModel->threadImgUpload();			//一時フォルダに画像をアップロード
}
if($threadUpdateModel->error){
	include THREAD_PATH.'/threadUpdate.inc';
	exit;
}
include THREAD_PATH.'/threadUpdateCheck.inc';

