<?php
/**
 * 定数/DB接続/ユーザー名取得
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
class parentmodel{
	protected $userName;
	protected $db;

	public function __construct(){
		$this->db             = new PDO('mysql:host=localhost;dbname=bord;charset=utf8','root','r(fwdlCc)1kK');
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
/*
 * ユーザー名取得
 */
	public function setUserName(){
		$sql = 'SELECT `userName` FROM `member`'
				. ' WHERE `userId` = :userId';
				$setUserName = $this->db->prepare($sql);
				$setUserName->bindValue(':userId',$_SESSION['userId'],PDO::PARAM_STR);
				$setUserName->execute();
				$this->userName = $setUserName->fetch();
	}
	/*
	 * 取得ユーザー名リターン
	 */
	public function getUserName(){
		return $this->userName['userName'];
	}
}