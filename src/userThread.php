<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;				//ログイン情報チェック

require_once MODELS_PATH.'/userInfo.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー情報取得

$userInfoModel = new userinfomodel($_GET);
$userInfoModel->allThreadCount();				//ユーザーが投稿した総スレッド数カウント
$userInfoModel->checkGetPage();				//不正GET値のエラーチェック
$userInfoModel->setUserThread();				//ユーザーが投稿したスレッド情報取得
$userInfoModel->paging();							//ページング処理

include USER_PATH.'/userThread.inc';