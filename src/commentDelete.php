<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/commentDelete.php';

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー情報取得

$commentDeleteModel = new commentdeletemodel($_POST);
$commentDeleteModel->checkUserComment();		//そのコメントとユーザーが紐づいているかチェック
$commentDeleteModel->hideDeletedComment();	//削除済みのコメントは参照できないように
$commentDeleteModel->setComment();			//コメント情報取得
if($commentDeleteModel->error){
	header('Location: '.WEB_ROOT_PATH.'/error.php' );
	exit;
}
include COMMENT_PATH.'/commentDeleteCheck.inc';