<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;			//ログイン情報チェック

require_once MODELS_PATH.'/commentCheck.php';

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$commentCheckModel = new commentcheckmodel($_POST);
$commentCheckModel->checkThreadNo();		//スレッドが存在するかチェック
if($commentCheckModel->error){
	header('Location: '.WEB_ROOT_PATH.'/error.php' );
	exit;
}
$commentCheckModel->renameCommentImg();	//コメントに添付した画像をDB登録要のフォルダに移動
$commentCheckModel->commentInsert();				//コメント登録
$commentCheckModel->ThreadDateUpdate();		//コメント投稿時間でスレッドの最終更新時間を上書き
header('Location:'. WEB_ROOT_PATH .'/comment.php?threadNo='.$_POST['threadNo'].'');