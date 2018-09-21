<?php
/**
 * スレッド編集
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 *スレッド投稿を継承
 */
require THREADPOST_PATH;
class threadupdatemodel extends threadpostmodel{
	private $result;			//データ取得結果格納
	public  $error;
/*
 * 値を初期化。
 */
	public function __construct($data=array(),$file=array()){
		$this->threadNo       =(isset($data['threadNo'])) ? $data['threadNo'] : $got['threadNo'];
		parent::__construct($data,$file);
	}
/**
 * 入力文字数/スペースチェック。
 */
	public function strLimit(){
		if(mb_strlen($this->title) && !mb_strlen(trim(mb_convert_kana($this->title, "s", 'UTF-8')))){
			$this->error[] = 'タイトルにスペースが入っています。';
		}
		if(mb_strlen($this->content) && !mb_strlen(trim(mb_convert_kana($this->content, "s", 'UTF-8')))){
			$this->error[] = 'サブタイトルにスペースが入っています。';
		}
		if(mb_strlen($this->title) >= 255){
			$this->error[] =  "タイトルが255文字を超えています。";
		}
		if(mb_strlen($this->content) >= 255){
			$this->error[] =  "サブタイトルが255文字を超えています。";
		}
	}
/*
 * スレッド情報を取得。
 */
	public function setThread(){
		$sql = 'SELECT `title`,`threadImg`,`content` FROM `thread`'
				. ' WHERE `threadNo` = :threadNo AND `deleteFlag` =:deleteFlag';
		$setUserThread= $this->db->prepare($sql);
		$setUserThread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$setUserThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setUserThread->execute();
		$this->result = $setUserThread->fetchall();
	}
/*
 * スレッド取得情報リターン
 */
	public function getResult(){
		return $this->result;
	}
/*
 * スレッド更新処理
 *
 * スレッド画像の有無、既に登録されている場合を考慮して場合分け
 */
	public function threadUpdate(){
		if($this->dbfile){
			$filepass = FILE_PATH.$this->dbfile;
		}elseif($this->through){
			$filepass = $this->through;
		}else{
			$filepass = '';
		}
		$sql = 'UPDATE `thread`'
				. ' SET `title`=:title , `threadImg`=:threadImg , `content`=:content'
				. ' WHERE `threadNo` = :threadNo';
		$setThreadUpdate = $this->db->prepare($sql);
		$setThreadUpdate->bindValue(':title',$this->title,PDO::PARAM_STR);
		$setThreadUpdate->bindValue(':threadImg',$filepass,PDO::PARAM_STR);
		$setThreadUpdate->bindValue(':content',$this->content,PDO::PARAM_STR);
		$setThreadUpdate->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$setThreadUpdate->execute();
	}
/*
 *ユーザーとスレッド照合
 */
	public function checkUserThread(){
		$sql = 'SELECT `userId` FROM `thread` WHERE `threadNo` = :threadNo';
		$userThread = $this->db->prepare($sql);
		$userThread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$userThread->execute();
		$userThread1 = $userThread->fetchall();
		foreach($userThread1 as $ut){
			if($_SESSION['userId'] !== $ut['userId']){
				$this->error[] = 'ユーザーとスレッド情報が一致しません。';
			}
		}
	}
/*
 * スレッドで論理削除したものは見れないように
 */
	public function hideDeletedThread(){
		$sql = 'SELECT `deleteFlag` FROM `thread` WHERE `threadNo` = :threadNo';
		$hideDeletedThread = $this->db->prepare($sql);
		$hideDeletedThread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$hideDeletedThread->execute();
		$hideDeletedThread1 = $hideDeletedThread->fetchall();
		foreach($hideDeletedThread1 as $hdt){
			if($hdt['deleteFlag'] == DELETED_FLAG){
				exit;
			}
		}
	}
}