<?php
/**
 * 会員登録処理
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
require 'models/login.php';
class regmodel extends loginmodel{
	private $name;

	public function __construct($data=array()){
		parent::__construct($data);
		$this->name       =(isset($data['name'])) ? $data['name'] : '';
	}
/*
 * 入力フォームの「名前」「ID」「PASS」の正規表現チェック
 */
	public function regexp(){
		if(mb_strlen($this->name) && !mb_strlen(trim(mb_convert_kana($this->name, "s", 'UTF-8')))){
			$this->error[] = '名前にスペースが入っています。';
		}
		if(!preg_match("/^.{1,20}$/",$this->name)){
			$this->error[] = '名前が不正です。';
		}
		if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\-]{8,20}$/", $this->loginId)){
			$this->error[] ="不正なログインID(大小英数字を含む8~20文字)";
		}
		if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\-]{8,20}$/", $this->pass)){
			$this->error[] ="不正なパスワード(大小英英数字含む8~20文字)";
		}
	}
/*
 * ID重複チェック
 */
	public function checkLoginId(){
		$sql = 'SELECT `loginId` ' //count(`loginId`) AS `cnt`'
				. ' FROM `member`'
				. ' WHERE `loginId` = BINARY :id';
		$checkLoginId = $this->db->prepare($sql);
		$checkLoginId->bindValue(':id',$this->loginId,PDO::PARAM_STR);
		$checkLoginId->execute();
		$check = $checkLoginId->fetch();
			if($check['loginId'] === $this->loginId){
				$this->error[] = 'そのIDは既に登録されています。';
			}
	}
/*
 * 入力データインサート
 */
	public function insertReg(){
		$pass = password_hash($this->pass, PASSWORD_DEFAULT);
		$date = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
		try{
			$sql = 'INSERT INTO `member`(`userName`,`loginId`,`pass`,`date`)values(:name,:loginId,:pass,:date)';
			$insert = $this->db->prepare($sql);
			$insert->bindValue(':name',$this->name);
			$insert->bindValue(':loginId',$this->loginId);
			$insert->bindValue(':pass',$pass);
			$insert->bindValue(':date',$date);
			$insert->execute();
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
/*
 * ユーザー名リターン
 */
	public function getName(){
		return $this->name;
	}
/*
 * ログインIDリターン
 */
	public function getLoginId(){
		return $this->loginId;
	}
}