<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;		//ログイン情報チェック

require_once MODELS_PATH.'/commentDelete.php';

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();		//ユーザー名取得

$commentDeleteModel = new commentdeletemodel($_POST);
$commentDeleteModel->checkUserComment();		//ユーザーとコメントが紐づいているかチェック
$commentDeleteModel->commentDelete();			//コメント論理削除処理
header('Location: '. WEB_ROOT_PATH .'/commnetDeleteResult.php?threadNo='.$_POST['threadNo'].'');