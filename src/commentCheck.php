<?php
require_once __DIR__. '/config/const.inc';
require_once SESSION_PATH;

require_once MODELS_PATH.'/commentCheck.php';

require_once MODELS_PATH.'/parent.php';
$userName = new parentmodel();
$userName->setUserName();

$commentCheckModel = new commentcheckmodel($_POST,$_FILES);
if(!$_POST['threadNo']){
	header('Location: '.WEB_ROOT_PATH.'/error.inc' );
	exit;
}
$commentCheckModel->strLimit();	//コメント入力情報チェック
if($commentCheckModel->error){		//エラーがあった時からの以下の読み込み方はよくない気がする。。。
	require_once MODELS_PATH.'/comment.php';
	$commentModel = new commentmodel($_POST);
	$commentModel->setThread();			//スレッド情報取得
	$commentModel->setUserInfo();		//ユーザー情報取得
	$commentModel->setComment();		//コメントデータ取得
	include COMMENT_PATH.'/comment.inc';
	exit;
}else{
	if($_FILES['upfile']['name'] !==''){			//画像が添付されれば
		$commentCheckModel->createImgName();	//画像名作成
		if($commentCheckModel->error){			//拡張子チェック
			require_once MODELS_PATH.'/comment.php';
			$commentModel = new commentmodel($_POST);
			$commentModel->setThread();			//スレッド情報取得
			$commentModel->setUserInfo();		//ユーザー情報取得
			$commentModel->setComment();		//コメント情報取得
			include COMMENT_PATH.'/comment.inc';
			exit;
		}
		$commentCheckModel->threadImgUpload();		//画像を一時ファイルにアップロード
	}
	include COMMENT_PATH.'/commentCheck.inc';
}
