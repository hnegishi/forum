<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;				//ログイン情報チェック

require_once MODELS_PATH.'/userFormUpdate.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー名取得

$userInfoUpdateModel = new userinfoupdatemodel();
$userInfoUpdateModel->renameUserImg();		//ユーザーアイコンを一時フォルダからDB登録用フォルダに移動
$userInfoUpdateModel->userInfoUpdate();			//ユーザー情報を入力値で更新
header('Location: '.WEB_ROOT_PATH.'/userUpdateResult.php');