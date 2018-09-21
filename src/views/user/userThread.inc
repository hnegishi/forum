<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/top1.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/pagging.css" media="all">
		<style type="text/css">
			a:link { color:#000000; text-decoration:none }
			a:visited { color:#000000; text-decoration:none }
			a:hover { color:#000000; text-decoration:none }
			a:active { color:#000000; text-decoration:none }
		</style>
	</head>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<h1 class='text-center'>投稿したスレッド一覧</h1><hr>
		<div class='content' style='padding-left: 10%'>
			<div class='thread' >
				<?php if(!$userInfoModel->getResult()){
					echo "まだ何も投稿されていません。";
				}
				foreach($userInfoModel->getResult() as $t){ ?>
					<div class='title'>
						<a href="<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $t['threadNo'];?>" style='text-decoration: none;color:#000000:'>
							<?php if($t['threadImg'] == ''){	?>
								<img src='<?php echo THREAD_NOIMG?>' width='18%' style='float:left;'>
							<?php }else{
								echo "<img src='{$t['threadImg']}' width='18%' style='float:left'>";
							}?>
							<div class='desc' style='word-break: break-all;'>
								<?php echo htmlspecialchars($t['title'],ENT_QUOTES, 'UTF-8').'<br>';?>
							</div>
						</a>
						<div style='clear:both;'></div>
					</div>
					<div style='padding-left:20%'>
					<form method='post' action='threadUpdate.php' style='display:inline;'>
						<input type='hidden' name='threadNo' value='<?php echo $t['threadNo']?>'>
						<button type="submit" name='snd' class="btn btn-success">編集</button>
					</form>
					<form method='post' action='threadDelete.php' style='display:inline;'>
						<input type='hidden' name='threadNo' value='<?php echo  $t['threadNo']?>'>
						<button type="submit" class="btn btn-danger">削除</button>
					</form>
					</div>
					<div style='clear:both;'></div><br><hr>
				<?php } ?>
			</div>
		</div>
		<div class='footter'>
			<ul class='example05'>
				<li><?php	echo $userInfoModel->mae; ?></li>
				<li><?php foreach($userInfoModel->paging as $p){ ?></li>
				<li><?php echo $p; ?></li>
				<?php }?>
				<li><?php echo $userInfoModel->tugi; ?></li>
			</ul>
		</div>
	</body>
</html>