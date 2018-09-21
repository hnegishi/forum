<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require MODELS_PATH.'/threadPost.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー名取得

$threadPostModel = new threadpostmodel($_POST,$_FILES);
$threadPostModel->strLimit();			//スレッド入力フォームのエラーチェック
if($_FILES['upfile']['name'] !==''){
	$threadPostModel->createImgName();	//添付画像名作成
	$threadPostModel->threadImgUpload();	//一時フォルダに画像を登録
}
if($threadPostModel->error){
	include THREAD_PATH.'/threadPost.inc';
	exit;
}
include THREAD_PATH.'/threadCheck.inc';

