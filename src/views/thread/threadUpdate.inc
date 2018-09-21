<html>
	<?php include THREAD_PATH.'/head.inc';?>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<header>
			<h1>編集画面</h1>
			<form method='post' action='threadUpdateCheck.php' enctype='multipart/form-data'>
				<div class='left'>
					<?php foreach($threadUpdateModel->getResult() as $r){
						if($_POST['backfile']){?>
							<img src='<?php echo TMP_PATH.$_POST['backfile']; ?>' width='100%' >
							<input type='hidden' name='upfile' value='<?php echo $_POST['backfile']; ?>'>
						<?php }elseif($_FILES['upfile']['name']){?>
							<img src='<?php echo TMP_PATH.$threadUpdateModel->getThreadImg(); ?>' width='100%' >
							<input type='hidden' name='upfile' value='<?php echo $threadUpdateModel->getThreadImg(); ?>'>
						<?php }elseif($_POST['upfile']){?>
							<img src='<?php echo TMP_PATH.$_POST['upfile'] ?>' width='100%' >
							<input type='hidden' name='upfile' value='<?php echo $_POST['upfile'] ?>'>
						<?php }elseif($r['threadImg']){	?>
							<img src='<?php echo $r['threadImg']; ?>' width='100%'>
							<input type='hidden' name='through' value='<?php echo $r['threadImg']; ?>'>
						<?php }else{ ?>
							<img src='<?php echo THREAD_NOIMG ?>' width='100%'>
						<?php }?>
						<input type='file' name='upfile' size=''>
						<input type="hidden" name="MAX_FILE_SIZE" value="130000" />
				</div>
						<font color='red' style='padding-left:22%;display:block;'>
							<?php foreach($threadUpdateModel->error as $e){echo $e.'<br>'; }?>
						</font>
						<div class='right'>
							<textarea name='title' rows='2' cols='50' required><?php if($_POST['title']){echo htmlspecialchars($_POST['title'],ENT_QUOTES, 'UTF-8');}else{ echo htmlspecialchars($r['title']);}; ?></textarea>
							<textarea name='content' rows='4' cols='50' style='display:block;margin-bottom:8%;'><?php if($_POST['content']){echo htmlspecialchars($_POST['content'],ENT_QUOTES, 'UTF-8');}else{echo htmlspecialchars($r['content'],ENT_QUOTES, 'UTF-8');} ?></textarea>
							<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo'];;?>'>
							<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/userThread.php'" class="btn btn-primary btn-lg" >投稿スレッド一覧に戻る</button>
							<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $_POST['threadNo'];?>'" class="btn btn-primary btn-lg">スレッドに戻る</button>
							<button type='submit' name='snd' class="btn btn-primary btn-lg">決定</button>
					<?php }?>
						</div>
			</form>
		</header>
	</body>
</html>