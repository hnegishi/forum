<?php
/**
 * スレッド内のコメント表示
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
include PARENT_PATH;
class commentmodel extends parentmodel{
	private $threadNo;				//スレッドの主キー
	private $resultComment;
	private $threadTag;
	public $error;

	public function __construct($data=array(),$got=array()){
		$this->threadNo            =(isset($data['threadNo'])) ? $data['threadNo'] : $got['threadNo'];
		$this->resultComment  = array();
		parent::__construct();
	}
/*
 *スレッドのデータ取得。
 */
	public function setThread(){
		$sql = 'SELECT `threadImg`,`title`,`content`,`userId`,`threadDate` FROM `thread`'
				. ' WHERE `threadNo`=:threadNo AND `deleteFlag` = :deleteFlag';
		$setThread = $this->db->prepare($sql);
		$setThread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$setThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setThread->execute();
		$this->resultThread = $setThread->fetchall();
	}
/*
 *
 */
	public function checkThreadNo(){
		$sql = 'SELECT * FROM `thread` WHERE `deleteFlag` = :deleteFlag and `threadNo` = :threadNo';
		$thread = $this->db->prepare($sql);
		$thread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$thread->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$thread->execute();
		$thread1 = $thread->fetchall();
		if($thread1 == NULL ){
			$this->error[] = '存在しないスレッドです。';
		}
		foreach($thread1 as $t){
			if($this->threadNo !== $t['threadNo']){
				$this->error[] = '存在しないスレッドです。';
			}
		}
		if(is_int(!$this->threadNo)){
			$this->error[] = '不正なスレッドNo.です';
		}
	}
/*
 * table threadの主キー リターン
 */
	public function getThreadNo(){
		return $this->threadNo;
	}
/*
 *取得したスレッドデータ リターン
 */
	public function getResultThread(){
		return $this->resultThread;
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
/*
 *スレッドを投稿したユーザーの情報取得
 */
	public function setUserInfo(){
		foreach($this->resultThread as $r){
			$userId = $r['userId'];
		}
		$sql = 'SELECT `userName`,`userImg` FROM `member`'
				. ' WHERE `userId` = :userId';
		$setUserInfo = $this->db->prepare($sql);
		$setUserInfo->bindValue(':userId',$userId,PDO::PARAM_INT);
		$setUserInfo->execute();
		$this->resultUserInfo = $setUserInfo->fetchall();
	}
/*
 * スレッドを投稿したユーザーの情報結果リターン
 */
	public function getResultUserInfo(){
		return $this->resultUserInfo;
	}
/*
 * スレッドの主キーを参照してコメント取得
 */
	public function setComment(){

		$sql ='SELECT `member`.`userId`,`member`.`userImg`,`userName`,`commentImg`,`text`,`CommentDate`,`commentNo` FROM `comment`'
				. ' INNER JOIN `member` ON `member`.`userId` = `comment`.`userId`'
				 . ' WHERE `threadNo` = :threadNo AND `deleteFlag` = :deleteFlag'
				. ' ORDER BY `commentDate` ASC';
		$setComment = $this->db->prepare($sql);
		$setComment->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$setComment->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setComment->execute();
		$this->resultComment = $setComment->fetchall();
		//echo '<pre>',var_dump($this->resultComment),'</pre>';
	}
/*
 * 取得したコメント リターン
 */
	public function getResultComment(){
		return $this->resultComment;
	}
/*
 * コメントを投稿したユーザーの情報取得
 */
	public function setUserInfoComment(){
/*		foreach($this->resultComment as $c){
			$userId[] = $c['userId'];
		}
		$inClause = substr(str_repeat(',?', count($userId)), 1);
	$sql = 'SELECT `userName`,`userImg` FROM `member`'
				. ' WHERE `userId` IN (:userId)';
		$setUserInfoComment = $this->db->prepare($sql);
		$setUserInfoComment->bindValue(':userId',$inClause,PDO::PARAM_INT);

		$sql ='SELECT `userName`,`userImg` FROM `member`'
					. " WHERE `userId` IN ({$inClause})";
		$setUserInfoComment = $this->db->prepare($sql);
*/
		$sql ='SELECT * FROM `member`'
				. ' INNER JOIN `comment` ON `member`.`userId` = `comment`.`userId`';
		$setUserInfoComment = $this->db->prepare($sql);
		$reslt=$setUserInfoComment->execute();
		$this->resultUserInfoComment = $setUserInfoComment->fetchAll();

	}
/*
 * コメントを投稿したユーザの情報取得結果リターン
 */
	public function getResultUserInfoComment(){
		return $this->resultUserInfoComment;
	}
/*
 *
 */
	public function checkThread(){
		$sql = 'SELECT `deleteFlag` FROM `thread` WHERE `threadNo` = :threadNo';
		$checkThread = $this->db->prepare($sql);
		$checkThread->bindValue('threadNo',$this->threadNo,PDO::PARAM_INT);
		$checkThread->execute();
		$checkThread1 = $checkThread->fetchall();
		foreach($checkThread1 as $ct){
			if($ct['deleteFlag'] == DELETED_FLAG){
				$this->error[] = '削除されたスレッドです。';
			}
		}
	}
/*
 * スレッド詳細ページで登録タグを取得
 */
	public function setThreadTag(){

		$sql = 'SELECT `tagName` FROM `tag`'
				. ' INNER JOIN `linkTagThread` on `tag`.`tagNo` = `linkTagThread`.`tagNo`'
				. ' WHERE `linkTagThread`.`threadNo` = :threadNo';
		$setThreadTag = $this->db->prepare($sql);
		$setThreadTag->bindValue(':threadNo',$this->threadNo);
		$setThreadTag->execute();
		$this->threadTag = $setThreadTag->fetchAll();
	}
	public function getThreadTag(){
		return $this->threadTag;
	}
}
