<html>
	<?php include THREAD_PATH.'/head.inc';?>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<header>
			<h1>確認画面</h1>
			<h2>以下のスレッドを削除します。</h2>
			<?php foreach($threadDeleteModel->getResult() as $r){ ?>
				<div class='left'>
					<?php if($r['threadImg'] == ''){	?>
						<img src='<?php echo THREAD_NOIMG ?>' width='90%'>
					<?php }else{
						echo "<img src='{$r['threadImg']}' width='90%'>";
					} ?>
				</div>
			<div class='right'>
				<h2 style='word-break: break-all'><?php echo htmlspecialchars($r['title'],ENT_QUOTES, 'UTF-8');?></h2>
				<h4 style='word-break: break-all'><?php echo htmlspecialchars($r['content'],ENT_QUOTES, 'UTF-8');?></h4>
			<?php }?>
				<form method='post' action='threadDeleteExe.php' style='display:inline;'>
					<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo'] ?>'>
					<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/userThread.php'" class="btn btn-primary btn-lg">戻る</button>
					<button type='submit' name='snd' class="btn btn-primary btn-lg">削除</button>
				</form>
			</div>
		</header>
	</body>
</html>