<?php
require_once __DIR__. '/config/const.inc';		//定数ファイル
require_once SESSION_PATH;						//ログイン情報チェック

require_once MODELS_PATH.'/comment.php';

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$commentModel = new commentmodel($_POST,$_GET);
if(!$_GET['threadNo'] and !$_POST['threadNo']){
	header('Location:'.WEB_ROOT_PATH.'/deletedThreadError.php' );
	exit;
}
$commentModel->checkThread();		//削除済みのスレッドかチェック
$commentModel->checkThreadNo();	//存在するスレッドかチェック
if($commentModel->error){
	header('Location:'.WEB_ROOT_PATH.'/deletedThreadError.php');
	exit;
}
$commentModel->setThread();		//スレッド情報取得
$commentModel->setUserInfo();	//ユーザー情報取得
$commentModel->setComment();	//登録コメント情報取得
$commentModel->setThreadTag();	//スレッド登録タグ情報取得
include COMMENT_PATH.'/comment.inc';