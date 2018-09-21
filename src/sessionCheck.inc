<?php
/*
 * ログイン保持
 *
 * ログイン成功時に生成されたセッション値でＤＢのログインＩＤ/ＰＷを照合する
 * 一致しなければログインフォームへ。
 * 同時にユーザーＩＤのセッションも生成
 */
require_once __DIR__.'/config/const.inc';	//定数ファイル
session_start();
$loginId = $_SESSION['loginId'];
$pass1    = $_SESSION['pass'];

$db = new PDO('mysql:host=localhost;dbname=bord;charset=utf8','root','r(fwdlCc)1kK');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT `pass` FROM `member`
			WHERE `loginId` = :loginId';
$setLoginId = $db->prepare($sql);
$setLoginId->bindValue(':loginId',$loginId,PDO::PARAM_STR);
$setLoginId->execute();
$pass = $setLoginId->fetch();	//ログインIDでパスワードをセレクト

if(!password_verify($pass1, $pass['pass'])){		//上で取得したパスと入力パスワードが一致しなければエラー
	header('Location: '.WEB_ROOT_PATH.'/login.php');
}

$sql1 = 'SELECT `userId` FROM `member`
			WHERE `loginId` = :loginId and `pass` = :pass';
$setUserId = $db->prepare($sql1);
$setUserId->bindValue(':loginId',$loginId,PDO::PARAM_STR);
$setUserId->bindValue(':pass',$pass['pass'],PDO::PARAM_STR);
$setUserId->execute();
$userId = $setUserId->fetch();				//ログインIDとパスワードからユーザー番号を取得

$_SESSION['userId'] = $userId['userId'];
