<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/top.php';
$topModel = new topmodel($_POST,$_GET);
$topModel->allThreadCount();			//検索ワードの結果の総スレッド数カウント
$topModel->checkGetPage();				//不正GET値のエラーチェック
$topModel->threadList();					//検索ワードからスレッド情報取得
$topModel->paging();						//ページング処理
$topModel->setUserName();				//ユーザー名取得
include TOP_PATH.'/topSearch.inc';