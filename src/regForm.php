<?php
require_once __DIR__. '/config/const.inc';	//定数ファイル
require_once MODELS_PATH.'/reg.php';

$regmodel = new regmodel($_POST);	//確認画面にて戻るボタンが押されたときに必要
include REG_PATH.'/regForm.inc';