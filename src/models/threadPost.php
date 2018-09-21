<?php
/**
 * スレッド投稿
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
include PARENT_PATH;
class threadpostmodel extends parentmodel{
	private $userId;
	private $title;					//スレッドタイトル
	private $content;			//スレッドサブタイトル
	private $tmpFile;			//一時画像
	private $threadImg;		//DBに登録するスレッド画像名
	public  $log;
	public $error;

	public function __construct($data=array(),$file=array()){
		$this->title                  =(isset($data['title'])) ? $data['title'] : '';
		$this->content            =(isset($data['content'])) ? $data['content'] : '';
		$this->tag1                 =(isset($data['tag1'])) ? $data['tag1'] : '';
		$this->tag2                 =(isset($data['tag2'])) ? $data['tag2'] : '';
		$this->tag3                 =(isset($data['tag3'])) ? $data['tag3'] : '';
		$this->tag4                 =(isset($data['tag4'])) ? $data['tag4'] : '';
		$this->through            =(isset($data['through'])) ? $data['through'] : '';
		$this->dbfile                =(isset($data['file'])) ? $data['file'] : '';
		$this->tmpFile             =(isset($file['upfile']['tmp_name'])) ? $file['upfile']['tmp_name']: '';
		$this->upfile                =(isset($file['upfile'])) ? $file['upfile'] : '';
		$this->log                    =array();
		$this->error                 =array();
		parent::__construct();
	}
/*
 * 添付された画像の名前決め
 *
 * 画像名 = ランダムな8桁大小英数字+タイムスタンプ+拡張子
 */
	public function createImgName(){
		$upfile = $this->upfile;
		$tmpName = $upfile['tmp_name'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_file($finfo,$tmpName);
		$allowed_types = [
				'jpg'   => 'image/jpeg',
				'png'  => 'image/png',
				'gif'    => 'image/gif'
		];
		if(!in_array($mimeType, $allowed_types)){//第１引数が第２引数に一致するものがなければ
			$this->error[] = 'その拡張子には対応していません';
		}
		$ext = array_search($mimeType,$allowed_types);
		for($i=0; $i<26; $i++){
			$eng[]=chr(97+$i);		//小文字アルファベット
			$eng[]=chr(65+$i);		//大文字アルファベット
		}
		$english = '';
		for($n=1;$n<=8;$n++){
			$english .= $eng[rand(0,51)];	//ランダムに値を結合していく
		}
		$time = date('Y-m-d');
		$this->threadImg = $english.$time.'.'.$ext;
	}
/*
 * スレッド画像一時フォルダにアップロード
 */
	public function threadImgUpload(){
		if(is_uploaded_file($this->tmpFile)){
			if(move_uploaded_file($this->tmpFile,FILE_TMP_PATH.$this->threadImg)){
				$this->log[] = '一時アップロード完了';
			}else{
				$this->error[] = '一時アップロード失敗';
			}
		}
	}
/*
 * 一時フォルダに保存されたスレッド画像パスをDB登録するファイルパスに移動
 */
	public function renameThreadImg(){
		rename(FILE_TMP_PATH.$this->dbfile,SERVER_PATH.FILE_PATH.$this->dbfile);
	}
/**
 * 入力文字数/スペースチェック/タグチェック
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
		$tag = array($this->tag4,$this->tag1,$this->tag2,$this->tag3);
		foreach($tag as $t){
			if(mb_strlen($t) >= 10){
				$this->error[] = "タグが１０文字を超えています。";
			}
		}
		$category = array('ニュース','エンタメ','グルメ','ビジネス','雑学','おもしろ','ガールズ','カラダ');
		if(in_array($this->tag4, $category) !==true){
			$this->error[] = "無効なカテゴリです。";
		}
		if($this->title == ''){
			$this->error[] = "タイトルを記入してください。";
		}
		if($_POST['MAX_FILE_SIZE'] > 130000){
			$this->error[] = 'ファイル容量エラーです。';
		}
		$count = substr_count($_POST["title"],"\n");
		if( $count >= 2){
			$this->error[] = '改行しすぎです。2回まで';
		}
		$count1 = substr_count($_POST["content"],"\n");
		if( $count1 >= 3){
			$this->error[] = '改行しすぎです。３回まで';
		}
	}
/*
 * スレッド入力値をDBに登録
 *
 * ファイルの有無やすでに画像が登録してある場合を考慮して場合分け
 */
	public function threadInsert(){
		if($this->dbfile){
		$filepass = FILE_PATH.$this->dbfile;
		}elseif($this->through){
			$filepass = $this->through;
		}else{
			$filepass = '';
		}
		date_default_timezone_set('Asia/Tokyo');
		$date = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		$sql ='INSERT INTO `thread`(`userId`,`title`,`content`,`threadImg`,`threadDate`,`deleteFlag`)values(:userId,:title,:content,:threadImg,:threadDate,:deleteFlag)';
		$threadInsert = $this->db->prepare($sql);
		$threadInsert->bindValue(':userId',$_SESSION['userId']);
		$threadInsert->bindValue(':title',$this->title);
		$threadInsert->bindValue(':content',$this->content);
		$threadInsert->bindValue(':threadImg',$filepass);
		$threadInsert->bindValue(':threadDate',$date);
		$threadInsert->bindValue(':deleteFlag',DELETE_FLAG);
		$threadInsert->execute();
	}

/*
 * スレッドタイトル リターン
 */
	public function getTitle(){
		return $this->title;
	}
/*
 * スレッドサブタイトル リターン
 */
	public function getContent(){
		return $this->content;
	}
/*
 * スレッド画像 リターン
 */
	public function getThreadImg(){
		return $this->threadImg;
	}
/*
 * タグ被ってるかチェック
 */
	public function insertTag(){
		$threadNo = $this->db->lastInsertId();
		if($this->tag4 or $this->tag1 or $this->tag2 or $this->tag3){
			$sql = 'SELECT * FROM `tag`'
					. ' WHERE `tagName` in (:tag0,:tag1,:tag2,:tag3)';
			$checkTag = $this->db->prepare($sql);
			$checkTag->bindValue(':tag0',$this->tag4);
			$checkTag->bindValue(':tag1',$this->tag1);
			$checkTag->bindValue(':tag2',$this->tag2);
			$checkTag->bindValue(':tag3',$this->tag3);
			$checkTag->execute();
			$checkTag1 = $checkTag->fetchAll();

			$tag = array($this->tag4,$this->tag1,$this->tag2,$this->tag3);	//タグを配列に格納
			foreach($checkTag1 as $ct){ //デバッグ用 echo "被りで除去された値　⇒　";var_dump($ct['tagName']);echo "<br>";
				$sql1 = 'INSERT INTO `linkTagThread`(`threadNo`,`tagNo`)values(:threadNo,:tagNo)';
				$linkTagThread = $this->db->prepare($sql1);
				$linkTagThread->bindValue(':threadNo', $threadNo);
				$linkTagThread->bindValue(':tagNo', $ct['tagNo']);
				$linkTagThread->execute();

				if(($match = array_search($ct['tagName'],$tag)) !==false){
					unset($tag[$match]);
				}
			}// デバッグ用 echo "被り除去後の配列　⇒　";var_dump($tag);echo "<br>";
			foreach($tag as $t){
				$sqltag = 'INSERT INTO `tag`(`tagName`)values(:tagName)';
				$insertTag = $this->db->prepare($sqltag);
				$insertTag ->bindValue(':tagName', $t);
				$insertTag->execute();

				$tagNo = $this->db->lastInsertId();
				$sqlTag = 'INSERT INTO `linkTagThread`(`threadNo`,`tagNo`)values(:threadNo,:tagNo)';
				$insertLinkTagThread = $this->db->prepare($sqlTag);
				$insertLinkTagThread->bindValue(':threadNo', $threadNo);
				$insertLinkTagThread->bindValue(':tagNo', $tagNo);
				$insertLinkTagThread->execute();
				$tagNo = '';
			}
		} //もしタグがあったら終了
	}

}