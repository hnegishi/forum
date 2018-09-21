<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/userInfo.css" media="all">
	</head>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<div class="container" style="padding-left: 17%;">
			<div class="row profile">
				<div class="profile-sidebar" style="width: 505px; height:35%;">
					<h1 style='text-align:center;'>更新完了</h1><br>
					<button type='button' class='center-block btn-default btn-lg' onclick="location.href='<?php echo WEB_ROOT_PATH?>/userInfo.php'">MyPage</button><br>
					<button type='button' class='center-block btn-default btn-lg' onclick="<?php echo WEB_ROOT_PATH?>/location.href='top.php'">TOP</button>
				</div>
			</div>
		</div>
	</body>
</html>