<html>
	<?php include THREAD_PATH.'/head2.inc';?>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<div class="container" style="padding-left: 17%;">
			<div class="row profile">
				<div class="profile-sidebar" style="width: 505px; height:35%;">
					<h1 style='text-align:center;'>編集完了</h1>
					<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/userInfo.php'" class='center-block btn-default btn-lg'>MyPage</button>
					<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/top.php'" class='center-block btn-default btn-lg'>TOP</button>
					<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $_GET['threadNo']?>'" class='center-block btn-default btn-lg'>投稿内容確認</button><br>
				</div>
			</div>
		</div>
	</body>
</html>