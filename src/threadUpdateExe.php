<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/threadUpdate.php';
$threadUpdateModel = new threadupdatemodel($_POST);
$threadUpdateModel->setUserName();		//ユーザー名取得
$threadUpdateModel->checkUserThread();		//スレッド投稿者かチェック
$threadUpdateModel->renameThreadImg();	//添付した画像を一時フォルダからDB登録用フォルダに移動
$threadUpdateModel->threadUpdate();			//スレッド情報をアップデート
header('Location: '.WEB_ROOT_PATH.'/threadUpdateResult.php?threadNo='.$_POST['threadNo'].'');