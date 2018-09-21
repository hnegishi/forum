<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/comment.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/chat.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/scroll.css" media="all">
		<link rel="stylesheet" type="text/css" href="./resource/lightbox.css" media="screen,tv" />
		<script type="text/javascript" charset="UTF-8" src="./resource/lightbox_plus.js"></script>
		<script type="text/javascript" src="js/scroll.js"></script>
	</head>
	<body>
<!-- ナビ -->
		<?php include COMMENT_PATH.'/navi.inc';?>
<!-- header -->
		<header>
			<?php foreach($commentModel->getResultThread() as $t){ ?>
				<div class='img'>
					<?php 	if($t['threadImg'] == ''){	?>
						<img src='<?php echo THREAD_NOIMG?>' width='180px'>
					<?php }else{
						echo "<img src='{$t['threadImg']}' width='180px'>";
					} ?>
				</div>

				<div class='title' style='padding-left:28%;word-break: break-all;'>
					<?php 	echo $title = nl2br(htmlspecialchars($t['title'],ENT_QUOTES, 'UTF-8')); ?>
						<br>
						<div class='content' style='font-size:12px;'>
							<?php echo $content = nl2br(htmlspecialchars($t['content'],ENT_QUOTES, 'UTF-8')); ?>
							<br>
							<br>
							<span style='font-size:12px;'><?php echo $t['threadDate']?>
								<?php echo "　　登録タグ：";?>
								<?php foreach($commentModel->getThreadTag() as $tt){ ?>
								<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo $tt['tagName'];?>' ><?php echo htmlspecialchars($tt['tagName'])." ";}?></a>
							</span>
							<div style='margin-top:1%;;'>
								<?php foreach($commentModel->getResultUserInfo() as $u){
									echo '投稿者：';
									if($u['userImg'] == ''){	?>
										<img src='<?php echo USER_NOIMG?>' width='5%'>
									<?php }else{
										echo "<img src='{$u['userImg']}' width='5%'>";
									}
									echo htmlspecialchars($u['userName']);
								}?>
								<?php  if($t['userId'] == $_SESSION['userId']){	?>
									<form method='post' action='threadUpdate.php' style='display:inline;' >
										<input type='hidden' name='threadNo' value='<?php echo $commentModel->getThreadNo();?>'>
										<button type='submit' name='snd' class="btn btn-default">編集</button>
									</form>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php }?>
		</header>
		<br><hr>

		<!-- comment欄 -->
		<div id="chat-frame">
			<?php foreach($commentModel->getResultcomment() as $c){ ?>
				<?php if($c['userId'] == $_SESSION['userId']){?>
					<p class='chat-talk mytalk'>
				<?php }else{?>
					<p class="chat-talk">
				<?php }?>
					<span class="talk-icon">
						<?php if($c['userImg'] == '' || $c['userImg'] == NULL){?>
							<img src='<?php echo USER_NOIMG?>' width='80px'>
						<?php }else{
							echo "<img src='{$c['userImg']}' width='80px'>";
						} ?>
						<span style='display:block;'>
							<?php echo htmlspecialchars($c['userName'],ENT_QUOTES, 'UTF-8'); ?>
						</span>
					</span>
				 <span class="talk-content" style='margin-left:100px; margin-right:100px; word-break: break-all;'>
					<?php echo "<span style='font-size:10px;'>".$c['CommentDate'].'</span>';
					if($c['commentImg'] !=''){  ?>
						<a href="<?php echo $c['commentImg'];?>" rel="lightbox"><img src='<?php echo $c['commentImg'] ?>' width='15%'></a>
					<?php }
					if($c['commentImg']){ echo "<br>";}
					echo $text = nl2br(htmlspecialchars($c['text'],ENT_QUOTES, 'UTF-8')); ?>
				</span>
				<?php if($c['userId'] == $_SESSION['userId']){?>
					<form method='post' action='commentDelete.php' style='float:right;display:inline;margin-right:3%'>
						<input type='hidden' name='commentNo' value='<?php echo $c['commentNo']; ?>'>
						<input type='hidden' name='threadNo' value='<?php echo $commentModel->getThreadNo();?>'>
						<input type='submit' name='snd' value='削除' class="btn btn-default btn-xs">
					</form>
				<?php } ?>
				<div style='clear:both;'></div>
				</p>
			<?php }?>
		<br><hr>
		<form method='post' action='CommentCheck.php' enctype='multipart/form-data'>
			<input type='file' name='upfile' size='' ><br>
			<font color='red' style=''>
				<?php foreach($commentCheckModel->error as $e){echo $e.'<br>';}?>
			</font>
			<textarea name='text' rows='3' cols='100' required><?php if($_POST['text']){ echo htmlspecialchars($_POST['text'],ENT_QUOTES, 'UTF-8');}?></textarea>
			<input type='hidden' name='threadNo' value='<?php echo $commentModel->getThreadNo();?>'>
			<input type="hidden" name="MAX_FILE_SIZE" value="130000" />
			<input type='hidden' name='userName' value='<?php foreach($commentModel->getResultUserInfo() as $n){echo $n['userName'];}?>'>
			<input type='submit' name='snd' value='送信' class=' btn btn-default btn-lg' style='margin-left:80%'>
		</form>
		</div>
		<p id="page-top"><a href="#wrap">PAGE ⇧</a></p>
	</body>
</html>