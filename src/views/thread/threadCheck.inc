<html>
	<?php include THREAD_PATH.'/head.inc';?>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<header>
			<h1>確認画面</h1>
			<h2>以下のスレッドを投稿します。</h2>
			<div class='left'>
				<?php  if($_FILES['upfile']['name']){?>
					<img src='<?php echo TMP_PATH.$threadPostModel->getThreadImg();?>' width=90%>
				<?php }elseif($_POST['upfile']){?>
					<img src='<?php echo TMP_PATH.$_POST['upfile'];?>' width='90%'>
				<?php }else{?>
					<img src='<?php echo THREAD_NOIMG ?>' width=90%>
				<?php }?>
			</div>
			<div class='right'>
				<h2 style='word-break: break-all'><?php echo nl2br( htmlspecialchars($threadPostModel->getTitle(),ENT_QUOTES, 'UTF-8'));?></h2>
				<h4 style='word-break: break-all'><?php  echo nl2br(htmlspecialchars($threadPostModel->getContent(),ENT_QUOTES, 'UTF-8'));?></h4>
				<?php echo 'カテゴリタグ：'.htmlspecialchars($_POST['tag4']).'<br>登録タグ：'.htmlspecialchars($_POST['tag1']).'　'.htmlspecialchars($_POST['tag2']).'　'.htmlspecialchars($_POST['tag3']);?>			<!-- 追加部分！！！！！！！！ -->
				<form method='post' action='threadPostForm.php' style='display:inline;'>
					<input type='hidden' name='title' value='<?php echo htmlspecialchars($threadPostModel->getTitle(),ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='content' value='<?php echo htmlspecialchars($threadPostModel->getContent(),ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='tag4' value='<?php echo $_POST['tag4']?>'>
					<input type='hidden' name='tag1' value='<?php echo $_POST['tag1']?>'>
					<input type='hidden' name='tag2' value='<?php echo $_POST['tag2']?>'>
					<input type='hidden' name='tag3' value='<?php echo $_POST['tag3']?>'>
					<input type='hidden' name='backfile' value='<?php if(($_FILES['upfile']['name'] !== '')){ echo $threadPostModel->getThreadImg();}elseif($_POST['upfile']){echo $_POST['upfile'];}else{echo '';};?>'>
					<button type='submit' name='back' class="btn btn-primary btn-lg">戻る</button>
				</form>
				<form method='post' action='threadPostInsert.php' style='display:inline;'>
					<input type='hidden' name='title' value='<?php echo htmlspecialchars($threadPostModel->getTitle(),ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='content' value='<?php echo htmlspecialchars($threadPostModel->getContent(),ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='tag4' value='<?php echo $_POST['tag4']?>'>
					<input type='hidden' name='tag1' value='<?php echo $_POST['tag1']?>'>
					<input type='hidden' name='tag2' value='<?php echo $_POST['tag2']?>'>
					<input type='hidden' name='tag3' value='<?php echo $_POST['tag3']?>'>
					<input type='hidden' name='file' value='<?php if($_FILES['upfile']['name']){echo $threadPostModel->getThreadImg();}else{ echo $_POST['upfile'];}?>'><!--  -->
					<button type='submit' name='snd' class="btn btn-primary btn-lg">投稿</button>
				</form>
			</div>
		</header>
	</body>
</html>