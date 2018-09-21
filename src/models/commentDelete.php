<?php
/**
 * コメント論理削除処理
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
include PARENT_PATH;
class commentdeletemodel extends parentmodel{
	private $resultComment;
	private $commentNo;
	public $error;

	public function __construct($data=array()){
		$this->commentNo    =  (isset($data['commentNo'])) ? $data['commentNo'] : '';
		parent::__construct();
	}
/*
 * 確認画面用のコメントデータ取得
 */
	public function setComment(){
		$sql ='SELECT `userId`,`commentImg`,`text`,`CommentDate`,`commentNo` FROM `comment`'
				. ' WHERE `commentNo` = :commentNo AND `deleteFlag` = :deleteFlag'
				. ' ORDER BY `commentDate` DESC';
		$setComment = $this->db->prepare($sql);
		$setComment->bindValue(':commentNo',$this->commentNo,PDO::PARAM_INT);
		$setComment->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setComment->execute();
		$this->resultComment = $setComment->fetchall();
		foreach($this->resultComment as $rc){
			if($rc['text'] == ''){
				$this->error = "error";
			}
		}
	}
/*
 * コメントデータ取得結果リターン
 */
	public function getResultComment(){
		return $this->resultComment;
	}
/*
 * コメント論理削除実行
 */
	public function commentDelete(){
		$sql = 'UPDATE `comment`'
				. ' SET `deleteFlag` = :deleteFlag'
				. ' WHERE `commentNo` = :commentNo';
		$setDeleteComment = $this->db->prepare($sql);
		$setDeleteComment->bindValue(':deleteFlag',DELETED_FLAG,PDO::PARAM_INT);
		$setDeleteComment->bindValue(':commentNo',$this->commentNo,PDO::PARAM_INT);
		$setDeleteComment->execute();
	}
/*
 *ユーザーとコメントを照合
 */
	public function checkUserComment(){
		$sql = 'SELECT `userId` FROM `comment` WHERE `commentNo` = :commentNo';
		$userComment = $this->db->prepare($sql);
		$userComment->bindValue(':commentNo',$this->commentNo,PDO::PARAM_INT);
		$userComment->execute();
		$userComment1 = $userComment->fetchall();
		foreach($userComment1 as $uc){
			if($_SESSION['userId'] !== $uc['userId']){
				exit;
			}
		}
	}
/*
 * コメントを論理削除したものは見れないように
 */
	public function hideDeletedComment(){
		$sql = 'SELECT `deleteFlag` FROM `comment` WHERE `commentNo` = :commentNo';
		$hideDeletedComment = $this->db->prepare($sql);
		$hideDeletedComment->bindValue(':commentNo',$this->commentNo,PDO::PARAM_INT);
		$hideDeletedComment->execute();
		$hideDeletedComment1 = $hideDeletedComment->fetchall();
		foreach($hideDeletedComment1 as $hdc){
			if($hdc['deleteFlag'] == DELETED_FLAG){
				exit;
			}
		}
	}
}