<?php
/**
 * ログイン判定
 *
 * @copyright hnegishi
 *	@version 2017/07/06
 *@author hnegishi
 */
require PARENT_PATH;
class loginmodel extends parentmodel{
	protected $loginId;
	protected $pass;
	public $error;

	public function __construct($data=array()){
		$this->loginId = (isset($data['loginId'])) ? $data['loginId'] :'';
		$this->pass     = (isset($data['pass'])) ? $data['pass'] : '';
		$this->error    = array();
		parent::__construct();
	}
/*
 * ログイン判定＆処理
 */
	public function loginCheck(){
		if(isset($_POST['snd'])){
			$sql = 'SELECT `pass` FROM `member`'
					. ' WHERE `loginId` = :loginId';
			$setLoginId = $this->db->prepare($sql);
			$setLoginId->bindValue(':loginId',$this->loginId,PDO::PARAM_STR);
			$setLoginId->execute();
			$pass = $setLoginId->fetch();
			if(password_verify($this->pass, $pass['pass'])){
				$_SESSION['loginId'] = $this->loginId;
				$_SESSION['pass']       = $this->pass;
				$sql1 = 'SELECT userId FROM member'
							. ' WHERE `loginId` = :loginId and `pass` = :pass';
				$setUserId = $this->db->prepare($sql1);
				$setUserId->bindValue(':loginId',$this->loginId,PDO::PARAM_STR);
				$setUserId->bindValue(':pass',$this->pass,PDO::PARAM_STR);
				$setUserId->execute();
				$userId = $setUserId->fetch();
				$_SESSION['userId'] = $userId['userId'];
			}else{
				$this->error[] = 'IDまたはパスワードが正しくありません。';
			}
		}
	}
}