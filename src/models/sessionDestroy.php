<?php
/**
 * ログアウトが押された時のセッションデストロイ
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
$_SESSION = array();
if(isset($_COOKIE[session_name()])){
	setcookie(session_name(),'',time()-1000,'/');
}
session_destroy();