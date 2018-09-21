<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;				//ログイン情報チェック

require_once MODELS_PATH.'/userFormUpdate.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$userInfoUpdateModel = new userinfoupdatemodel($_POST,$_FILES);
$userInfoUpdateModel->strLimit();			//ユーザー編集の入力値チェック

if($_FILES['upfile']['name']){
	$userInfoUpdateModel->createImgName();			//ユーザーアイコンの画像名作成
	$userInfoUpdateModel->threadImgUpload();			//ユーザーアイコンを一時フォルダにアップロード
}

if($userInfoUpdateModel->error){
	$userInfoUpdateModel->setUserInfo();			//入力値にエラーがあれば入力フォームに戻る
	include USER_PATH.'/userForm.inc';
	exit;
}

include USER_PATH.'/userUpdateCheck.inc';
