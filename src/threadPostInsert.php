<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once SESSION_PATH;					//ログイン情報チェック

require_once MODELS_PATH.'/threadPost.php';
$threadPostModel = new threadpostmodel($_POST);
$threadPostModel->renameThreadImg();			//画像を一時フォルダからDB登録ようのフォルダに移動
$threadPostModel->threadInsert();						//スレッド入力情報をDBに取る億
$threadPostModel->insertTag();							//タグ情報をDBに登録
header('Location: '.WEB_ROOT_PATH.'/threadPostResult.php?threadNo='.$_POST['threadNo'].'');