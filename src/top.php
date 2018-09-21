<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;				//ログイン情報チェック

require_once MODELS_PATH.'/top.php';
require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();			//ユーザー名取得

$topModel = new topmodel($_POST,$_GET);
$topModel->allThreadCount();				//総スレッド数カウント（検索された場合も）
$topModel->checkGetPage();					//不正GET値のエラーチェック
$topModel->threadList();						//スレッド情報取得	（検索された場合も）
$topModel->paging();;							//ページング処理s

if($_GET['searchSnd'] or $_GET['search']){		//ワード検索された場合
	include TOP_PATH.'/topSearch.inc';
	exit;

}elseif($_GET['sndTag'] or $_GET['tagName']){			//タグ検索された場合
	$topModel->searchTag();
	include TOP_PATH.'/topTagSearch.inc';
	exit;

}else{				//通常のTOPページ
	include TOP_PATH.'/top.inc';
	exit;
}
