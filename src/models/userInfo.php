<?php
/**
 * 自分が投稿したスレッド表示用
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
include PARENT_PATH;
class userinfomodel extends parentmodel{
	private $result;
	private $page;		//ページング
	private $count;		//ヒット件数
	public $paging;
	public $log;
	public $mae;			//ページング「前」
	public $tugi;			//ページング「次」

	public function __construct($data){
		$this->page       = (isset($data['page'])) ? $data['page'] :1;
		$this->log          = array();
		parent::__construct()
;	}
/*
 * ユーザー情報取得
 */
	public function setUserInfo(){
		$sql = 'SELECT `userName`,`userImg`,`from`,`comment`'
				. ' FROM `member`'
				. ' WHERE `userId` = :userId';
		$setUserInfo = $this->db->prepare($sql);
		$setUserInfo->bindValue(':userId',$_SESSION['userId'],PDO::PARAM_INT);
		$setUserInfo->execute();
		$this->result = $setUserInfo->fetchall();
	}
/*
 * ユーザー情報リターン
 */
	public function getResult(){
		return $this->result;
	}
/*
 * ユーザー名取得
 *
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
 * ユーザー名リターン
 */
	public function getUserName(){
		return $this->userName['userName'];
	}
/*
 * ゲット値チェック
 */
	public function checkGetValue(){
		if(!preg_match("/^[0-9]+$/",$this->page )){
			$this->page = 1;
		}
	}
/*
 * 総ページ数カウント
 */
	public function allThreadCount(){
		$sql = 'SELECT * FROM `thread`'
				. ' WHERE userId = :userId AND `deleteFlag` =:deleteFlag';
		$setThread = $this->db->prepare($sql);
		$setThread->bindValue(':userId',$_SESSION['userId'],PDO::PARAM_INT);
		$setThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setThread->execute();
		$this->count = $setThread->rowCount();
		if($this->count == 0){
			$this->log[] = 'まだ投稿されていません。。';
		}
	}
/*
 * 自分が投稿したスレッド情報取得
 */
	public function setUserThread(){
		if($this->page == 1){
			$start = 0;
		}else{
			$start = ($this->page * MAX_VIEW - MAX_VIEW);
		}
		$sql = 'SELECT `title`,`threadImg`,`threadNo` FROM `thread`'
				. ' WHERE `userId` = :userId AND `deleteFlag` =:deleteFlag'
				. ' ORDER BY `commentDate`,`threadDate`DESC'
				. ' LIMIT :s,:e';
		$setUserThread= $this->db->prepare($sql);
		$setUserThread->bindValue(':userId',$_SESSION['userId'],PDO::PARAM_INT);
		$setUserThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setUserThread->bindValue(':s',$start,PDO::PARAM_INT);
		$setUserThread->bindValue(':e',MAX_VIEW,PDO::PARAM_INT);
		$setUserThread->execute();
		$this->result = $setUserThread->fetchall();
	}
/*
 * ページング機能
 */
	public function paging(){
		$allPage = ceil($this->count/MAX_VIEW);
		$prev = $this->page-1;
		$next = $this->page+1;
		for($i=1;$i<=$prev;$i++){
			$this->paging[] = '<a href="?page='.$i.'">'.$i.'</a>';
		}
		for($k=$next;$k<=$allPage;$k++){
			$this->paging []=  '<a href="?page='.$k.'">'.$k.'</a>';
		}
		if($this->page !=1 and $this->page !=0){
			$this->mae = '<a href="?page='.$prev.'">前へ</a>';
		}
		if($this->page < $allPage){
			$this->tugi = '<a href="?page='.$next.'">次へ</a>';
		}
	}
/*
 * GET値チェック
 */
	public function checkGetPage(){
		$allPage = ceil($this->count/MAX_VIEW);
		if($this->page < 1 or $this->page > $allPage){
			$this->page = 1;
		}elseif(is_int(!$this->page)){
			$this->page = 1;
		}
	}

}
