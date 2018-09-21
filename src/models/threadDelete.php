<?php
/**
 * スレッド論理削除
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
include PARENT_PATH;
class threaddeletemodel extends parentmodel{
	private $result;			//スレッドデータ
	public $error;

	public function __construct($data=array()){
		$this->threadNo       =(isset($data['threadNo'])) ? $data['threadNo'] : $got['threadNo'];
		parent::__construct();
	}
/*
 * スレッドデータ取得
 *
 * @param int 0 ユーザーに表示するデータ
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
 * 取得スレッド リターン
 */
	public function getResult(){
		return $this->result;
	}
/*
 * スレッド論理削除
 *
 * @param int 1 ユーザーに非表示データ
 */
	public function threadDelete(){
		$sql = 'UPDATE `thread`'
				. ' SET `deleteFlag` = :deleteFlag'
				. ' WHERE `threadNo` = :threadNo';
		$setDeleteThread = $this->db->prepare($sql);
		$setDeleteThread->bindValue(':deleteFlag',DELETED_FLAG,PDO::PARAM_INT);
		$setDeleteThread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$setDeleteThread->execute();
	}
/*
 * ユーザーとスレッド照合
 */
	public function checkUserThread(){
		$sql = 'SELECT `userId` FROM `thread` WHERE `threadNo` = :threadNo';
		$userThread = $this->db->prepare($sql);
		$userThread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$userThread->execute();
		$userThread1 = $userThread->fetchall();
		foreach($userThread1 as $ut){
			if($_SESSION['userId'] !== $ut['userId']){
				$this->error[] = 'ユーザーIDが一致しません。';
			}
		}
	}
/*
 * スレッドを論理削除したものは見られないように
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