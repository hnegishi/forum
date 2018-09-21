<?php
/***************************/
/** 最終更新日:2017/07/11 **/
/**************************/

/********************/
/** root/modelsパス **/
/******************/
define('SERVER_PATH','/var/www/html');
define('ROOT_PATH','/var/www/html/board/bord');
define(WEB_ROOT_PATH,'/board/bord');
define('MODELS_PATH','/var/www/html/board/bord/models');


/*********************/
/** SESSIONチェック **/
/******************/
define('SESSION_PATH','/var/www/html/board/bord/sessionCheck.inc');


/****************/
/** model継承用 **/
/***************/
define('PARENT_PATH','models/parent.php');
define('THREADPOST_PATH','models/threadPost.php');


/***********/
/** VIEW **/
/*********/
define('COMMENT_PATH','/var/www/html/board/bord/views/comment');
define('REG_PATH','/var/www/html/board/bord/views/reg');
define('THREAD_PATH','/var/www/html/board/bord/views/thread');
define('TOP_PATH','/var/www/html/board/bord/views/top');
define('USER_PATH','/var/www/html/board/bord/views/user');
define('LOGIN_PATH','/var/www/html/board/bord/views/login');
define('ERROR_PATH','/var/www/html/board/bord/views/error');


/***********************/
/** modelで使う定数たち **/
/*********************/
define('DELETE_FLAG',0);		//アクティブ(thread/comment)
define('DELETED_FLAG',1);		//ノンアクティブ(thread/comment)
define('MAX_VIEW',10);			//1ページに表示するthreadの数(top)


/****************/
/** 画像保存パス/NO_IMGパス **/
/***************/
define('FILE_TMP_PATH','/var/www/html/board/bord/tmpImg/');	//画像一時アップロードパス
define('TMP_PATH','/board/bord/tmpImg/');		//画像を一時保存する場所
define('FILE_PATH','/board/bord/threadImg/');		//画像をDB登録パス
define('NAI','/board/bord/userImg/nai.jpg');			//そんなものはない
define('THREAD_NOIMG','/board/bord/threadImg/noimg.jpg');	//スレッドNO_IMG画像パス
define('USER_NOIMG','/board/bord/userImg/userIcon.jpg');	//ユーザーNO_IMG画像パス
