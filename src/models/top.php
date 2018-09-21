<?php
/**
 * TOPページに表示させるデータ諸々取得
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
include PARENT_PATH;
class topmodel extends parentmodel{

	private $result;
	private $page;						//ページング
	private $searchWord;				//検索ワード
	private $count;						//検索結果件数
	private $cnt;
	private $search;
	public $paging;
	public $paging1;
	public $tagCount;
	public $mae;							//ページング「前」
	public $tugi;							//ページング「次」
	public $log;
	private $allPage;
	private $searchResult;

	public function __construct($data=array(),$got=array()){
		$this->page         = (isset($got['page'])) ? $got['page'] :1;
		$this->search      =(isset($data['search'])) ? $data['search'] : $got['search'];
		$this->tagName  =(isset($got['tagName'])) ? $got['tagName'] : '';
		$this->sndTag     =(isset($got['sndTag'])) ? $got['sndTag'] : '';
		$this->log           = array();
		parent::__construct();
	}
/*
 * GET値チェック
 */
	public function checkGetValue(){
		if(!preg_match("/^[0-9]+$/",$this->page )){
		$this->page = 1;
		}
	}
/*
 * 総スレッド数取得
 *
 * 検索ワードがある場合も対応
 */
	public function allThreadCount(){
		if(isset($this->search)){
			$wd      = $this->search;
			$search = " AND `title` LIKE :wd ";
			$search_word = str_replace(array('\\', '%', '_'),
					array('\\\\', '\%', '\_'), $wd);
		}
		$sql = 'SELECT * FROM `thread` WHERE `deleteFlag` = :deleteFlag' .$search;
		$setThread = $this->db->prepare($sql);
		if(isset($this->search)){
			$setThread->bindValue(':wd','%'.$search_word.'%',PDO::PARAM_STR);
		}
		$setThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setThread->execute();
		$this->count = $setThread->rowCount();
		if($this->count == 0){
			$this->log[] = '検索結果がありません。';
		}
	}
/*
 * 総ページ数リターン
 */
	public function getCount(){
		return $this->count;
	}
/*
 * スレッド情報取得
 *
 * 検索ワードがある場合にも対応
 * コメントされた時間が新しい順に格納する。
 */
	public function threadList(){
		if(isset($this->search)){
			$wd       = $this->search;
			$search = " AND `title` LIKE :wd ";
			$search_word = str_replace(array('\\', '%', '_'),
					array('\\\\', '\%', '\_'), $wd);
		}
		if($this->page == 1){
			$start = 0;
		}else{
			$start = ($this->page * MAX_VIEW - MAX_VIEW);
		}
		$sql = 'SELECT `title`,`threadImg`,`threadNo` FROM `thread`'
				. ' WHERE `deleteFlag` = :deleteFlag'
				. $search
				. ' ORDER BY `commentDate`DESC , `threadDate` DESC'
				. ' LIMIT :s,:e';
		$setThread = $this->db->prepare($sql);
		if(isset($this->search)){
			$setThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
			$setThread->bindValue(':wd','%'.$search_word.'%',PDO::PARAM_STR);
			$setThread->bindValue(':s',$start,PDO::PARAM_INT);
			$setThread->bindValue(':e',MAX_VIEW,PDO::PARAM_INT);
			$setThread->execute();
			$this->result = $setThread->fetchall();
			$this->cnt = $setThread->rowCount();
		}else{
			$setThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
			$setThread->bindValue(':s',$start,PDO::PARAM_INT);
			$setThread->bindValue(':e',MAX_VIEW,PDO::PARAM_INT);
			$setThread->execute();
			$this->result = $setThread->fetchall();
		}
	}
/*
 * スレッド取得情報リターン
 */
	public function getResult(){
		return $this->result;
	}
/*
 *
 */
	public function setNewThread(){
		$sql =  'SELECT `title`,`content`,`threadNo` FROM `thread`'
					. ' WHERE `deleteFlag` = :deleteFlag'
					. ' ORDER BY  `threadDate` DESC'
					. ' LIMIT :s,:e';
		$setNewThread = $this->db->prepare($sql);
		$this->userName = $setNewThread->fetch();
		$setNewThread->bindValue(':deleteFlag',DELETE_FLAG,PDO::PARAM_INT);
		$setNewThread->bindValue(':s',0,PDO::PARAM_INT);
		$setNewThread->bindValue(':e',5,PDO::PARAM_INT);
		$setNewThread->execute();
		$newThread = $setNewThread->fetchall();
		return $newThread;
	}
/*
 * ページング機能
 *
 * @param int $allPage = (総ページ数/１ページに表示する件数)の切り上げ
 */
	public function paging(){
		if($this->tagName or $this->sndTag){
			$allPage = ceil($this->tagCount/MAX_VIEW);
		}else{
			$allPage = ceil($this->count/MAX_VIEW);
		}
		$prev = $this->page-1;
		$next = $this->page+1;
		if(isset($this->search)){
			$search = $this->search;
		}
		if(isset($this->tagName)){
			$search = $this->tagName;
		}
		for($i=1;$i<=$prev;$i++){
			if($this->search or $this->tagName){
				$this->paging[] = '<a href="?search='.$search.'&page='.$i.'">'.$i.'</a>';
			}else{
				$this->paging[] = '<a href="?page='.$i.'">'.$i.'</a>';
			}
		}
		for($k=$next;$k<=$allPage;$k++){
			if($this->search or $this->tagName){
				$this->paging1[] = '<a href="?search='.$search.'&page='.$k.'">'.$k.'</a>';
			}else{
				$this->paging1[]=  '<a href="?page='.$k.'">'.$k.'</a>';
			}
		}
		if($this->page !=1 and $this->page !=0){
			if($this->search){
				$this->mae = '<a href="?search='.$search.'&page='.$prev.'">前へ</a>';
			}else{
				$this->mae = '<a href="?page='.$prev.'">前へ</a>';
			}
		}
		if($this->page < $allPage){
			if($this->search or $this->tagName){
				$this->tugi = '<a href="?search='.$search.'&page='.$next.'">次へ</a>';
			}else{
				$this->tugi = '<a href="?page='.$next.'">次へ</a>';
			}
		}
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
/*
 * GET['page']リターン
 */
	public function getPage(){
		return $this->page;
	}
/*
 * タグの値を受け取ったらスレッド情報表示。
 */
	public function searchTag(){
		$sql ='SELECT * FROM `thread`'
				. ' INNER JOIN `linkTagThread` on `thread`.`threadNo` = `linkTagThread`.`threadNo`'
				. ' WHERE `linkTagThread`.`tagNo` = (SELECT `tagNo` FROM `tag` WHERE `tagName` = :tagName )';
		$searchTag = $this->db->prepare($sql);
		$searchTag->bindValue(':tagName',$this->tagName);
		$searchTag->execute();
		$this->tagCount =$searchTag->rowCount();
		$this->searchResult = $searchTag->fetchAll();
	}
/*
 * 検索結果リターン
 */
	public function getSearchResult(){
		return $this->searchResult;
	}
}