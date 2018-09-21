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
					<h1 style='text-align:center;'>削除完了</h1>
					<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $_GET['threadNo'] ?>'" class='center-block btn-default btn-lg'>スレッドに戻る</button>
					<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/top.php'" class='center-block btn-default btn-lg'>TOP</button>
				</div>
			</div>
		</div>
	</body>
</html>