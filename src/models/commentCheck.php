<?php
/**
 * コメントチェック
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 *スレッド投稿を継承
 */
require THREADPOST_PATH;
class commentcheckmodel extends threadpostmodel{
	public $date;
	public $error;

	public function __construct($data=array(),$file=array()){
		$this->threadNo         =(isset($data['threadNo'])) ? $data['threadNo'] : '';
		$this->file                  =(isset($data['file'])) ? $data['file'] : '';
		$this->text                =(isset($data['text'])) ? $data['text'] : '';
		parent::__construct($data,$file);
	}
/*
 * 一時フォルダに保存した画像をDB登録用フォルダに移動
 */
	public function renameCommentImg(){
		rename(FILE_TMP_PATH.$this->file,SERVER_PATH.FILE_PATH.$this->file);
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
 *
 */
	public function checkThreadNo(){
		$sql = 'SELECT * from `thread`'
				. 'WHERE `threadNo` = :threadNo and `deleteFlag` = :deleteFlag';
		$checkThreadNo = $this->db->prepare($sql);
		$checkThreadNo->bindValue(':threadNo',$this->threadNo);
		$checkThreadNo->bindValue(':deleteFlag',DELETE_FLAG);
		$checkThreadNo->execute();
		$checkThreadNo1 = $checkThreadNo->fetchAll();
		if($checkThreadNo1 == NULL){
			$this->error = '存在しないスレッドです。';
		}
	}
/*
 * コメント投稿処理
 *
 * もし画像を投稿しなければ空の値が入るように。
 */
	public function commentInsert(){
		if($this->file !==''){
			$filepass = FILE_PATH.$this->file;
		}else{
			$filepass = '';
		}
		date_default_timezone_set('Asia/Tokyo');
		$this->date = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		$sql ='INSERT INTO `comment`(`threadNo`,`userId`,`commentImg`,`text`,`commentDate`,`deleteFlag`)values(:threadNo,:userId,:commentImg,:text,:commentDate,:deleteFlag)';
		$commentInsert = $this->db->prepare($sql);
		$commentInsert->bindValue(':threadNo',$this->threadNo);
		$commentInsert->bindValue(':userId',$_SESSION['userId']);
		$commentInsert->bindValue(':commentImg',$filepass);
		$commentInsert->bindValue(':text',$this->text);
		$commentInsert->bindValue(':commentDate',$this->date);
		$commentInsert->bindValue(':deleteFlag',DELETE_FLAG);
		$commentInsert->execute();
	}
/*
 * コメントが投稿された時間をスレッドにアップデート
 *
 * TOPに表示されるスレッド一覧で新しくコメントされたスレッドが一番上に来るように
 */
	public function ThreadDateUpdate(){
		$sql = 'UPDATE `thread`'
				. ' SET `commentDate`=:commentDate'
				. ' WHERE `threadNo` = :threadNo';
		$threadDateUpdate = $this->db->prepare($sql);
		$threadDateUpdate->bindValue(':commentDate',$this->date);
		$threadDateUpdate->bindValue(':threadNo',$this->threadNo,PDO::PARAM_INT);
		$threadDateUpdate->execute();
	}
/*
 * コメントチェッカー
 */
	public function strLimit(){
		if(mb_strlen($this->text) && !mb_strlen(trim(mb_convert_kana($this->text, "s", 'UTF-8')))){
			$this->error[] = 'スペースのみのコメントはできません。';
		}
		if($this->text == ''){
			$this->error[] = 'コメントを入力してください。';
 		}
 		if(mb_strlen($this->text) >= 300){
 			$this->error[] = 'コメントは３００文字までです。';
 		}
 		if($_POST['MAX_FILE_SIZE'] > 130000){
 			$this->error[] = 'ファイル容量エラーです。';
 		}
 		$count = substr_count($_POST["text"],"\n");
 		if( $count >= 10){
 			$this->error[] = '改行しすぎです。';
 		}
	}

}