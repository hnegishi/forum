<?php
/**
 * ユーザー情報更新
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 *スレッド投稿モデル継承
 */
require THREADPOST_PATH;
class userinfoupdatemodel extends threadpostmodel{
	private $result;
	public   $error;

	public function __construct($data=array(),$file=array()){
		$this->userName         =(isset($data['userName'])) ? $data['userName'] : '';
		$this->from                 =(isset($data['from'])) ? $data['from'] : '';
		$this->comment          =(isset($data['comment'])) ? $data['comment'] : '';
		$this->error                 = array();
		parent::__construct($data,$file);
	}
/**
 * 入力文字数/スペースチェック。
 */
	public function strLimit(){
		if(mb_strlen($this->userName) && !mb_strlen(trim(mb_convert_kana($this->userName, "s", 'UTF-8')))){
			$this->error[] = '名前にスペースが入っています。';
		}
		if(mb_strlen($this->from) && !mb_strlen(trim(mb_convert_kana($this->from, "s", 'UTF-8')))){
			$this->error[] = '住まいにスペースが入っています。';
		}
		if(mb_strlen($this->comment) && !mb_strlen(trim(mb_convert_kana($this->comment, "s", 'UTF-8')))){
			$this->error[] = 'ひとことにスペースが入っています。';
		}
		if(mb_strlen($this->userName) > 20){
			$this->error[] =  "なまえは２０文字までです。";
		}
		if(mb_strlen($this->from) > 30){
			$this->error[] =  "住まいは３０文字までです。";
		}
		if(mb_strlen($this->comment) > 255){
			$this->error[] =  "ひとことは２５５文字までです。";
		}
	}
/*
 * ユーザー情報取得
 */
	public function setUserInfo(){
		$sql = 'SELECT `userName`,`userImg`,`from`,`comment` FROM `member`'
				. ' WHERE `userId` = :userId';
		$setUserInfo = $this->db->prepare($sql);
		$setUserInfo->bindValue('userId',$_SESSION['userId'],PDO::PARAM_STR);
		$setUserInfo->execute();
		$this->result = $setUserInfo->fetchall();
	}
/*
 * 取得したユーザー情報リターン
 */
	public function getResult(){
		return $this->result;
	}
/*
 * 一時フォルダに保存されたユーザーアイコンをＤＢ登録用フォルダに移動
 */
	public function renameUserImg(){
		rename(FILE_TMP_PATH.$this->dbfile,SERVER_PATH.FILE_PATH.$this->dbfile);
	}
/*
 * ユーザー情報更新
 *
 * ユーザーアイコンの有無、既にある場合にも対応
 */
	public function userInfoUpdate(){
		if($this->dbfile){
			$filepass = FILE_PATH.$this->dbfile;
		}elseif($this->through){
			$filepass = $this->through;
		}else{
			$filepass = '';
		}
		$sql ='UPDATE `member`'
			. ' SET `userName`=:userName,`userImg`=:userImg,`from`=:from,`comment`=:comment'
			. ' WHERE `userId` = :userId';
		$setUserInfoUpdate = $this->db->prepare($sql);
		$setUserInfoUpdate->bindValue(':userName',$this->userName,PDO::PARAM_STR);
		$setUserInfoUpdate->bindValue(':userImg',$filepass,PDO::PARAM_STR);
		$setUserInfoUpdate->bindValue(':from',$this->from,PDO::PARAM_STR);
		$setUserInfoUpdate->bindValue(':comment',$this->comment,PDO::PARAM_STR);
		$setUserInfoUpdate->bindValue(':userId',$_SESSION['userId'],PDO::PARAM_INT);
		$setUserInfoUpdate->execute();
	}
}