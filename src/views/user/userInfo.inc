<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/userInfo.css" media="all">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample3">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="navbarEexample3">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo WEB_ROOT_PATH?>/top.php">TOP</a></li>
						<li><a href="<?php echo WEB_ROOT_PATH?>/threadPostForm.php">スレッド作成</a></li>
						<li><a href="<?php echo WEB_ROOT_PATH?>/logauto.php">ログアウト</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<h1 style="text-align: center;word-break: break-all;"><a href='top.php'>タイトル</a></h1>
		<?php foreach($userInfoModel->getResult() as $r){?>
			<div class="container" style="padding-left: 17%;">
				<div class="row profile">
					<div class="profile-sidebar" style="width: 505px;">
						<div class="profile-userpic">
							<?php if($r['userImg'] !== NULL and $r['userImg'] !=="" ){
								echo "<img src='{$r['userImg']}' width='30%'>";
							}else{ ?>
								<img src='<?php echo USER_NOIMG?>' width='30%'>
							<?php }?>
						</div>
						<?php echo "<h3 style='text-align:center;'>".htmlspecialchars($r['userName'],ENT_QUOTES, 'UTF-8').'</h3>';;?>
						<p style="text-align:center;word-break: break-all;">
							<?php echo 'ユーザー情報<br>';
							echo htmlspecialchars($r['from']).'<br>';
							echo htmlspecialchars($r['comment']);
							} ?>
						</p>
						<div class="profile-usermenu">
							<ul class="nav">
								<li>
									<a href="<?php echo WEB_ROOT_PATH?>/userThread.php">
										<i class="glyphicon glyphicon-home"></i>
										投稿したスレッド一覧
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_ROOT_PATH?>/userUpdate.php">
										<i class="glyphicon glyphicon-user"></i>
										プロフィール編集
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_ROOT_PATH?>/naidesu.php" >
										<i class="glyphicon glyphicon-ok"></i>
										アカウント情報変更
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_ROOT_PATH?>/naidesu.php">
										<i class="glyphicon glyphicon-flag"></i>
										Help
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	</body>
</html>