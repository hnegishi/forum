<html>
	<?php include  TOP_PATH.'/head.inc';?>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample3">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="navbarEexample3">
					<form method='get' class="navbar-form navbar-left" role="search" action='top.php'>
						<div class="form-group">
							<input type='text' name='search' placeholder='ワード検索' value='<?php if($_GET['search'] !=='' ){echo htmlspecialchars($_GET['search']); } ?>'>
						</div>
						<button type="submit" name='searchSnd' class="btn btn-default" value='検索'>検索</button>
					</form>
					<a class="navbar-brand " href="top.php" >タイトル</a>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo WEB_ROOT_PATH?>/top.php">TOP</a></li>
						<li><a href="<?php echo WEB_ROOT_PATH?>/threadPostForm.php">スレッド作成</a></li>
						<li ><a href="<?php echo WEB_ROOT_PATH?>/userInfo.php"><?php echo htmlspecialchars($userName->getUserName(),ENT_QUOTES, 'UTF-8'); ?></a></li>
						<li><a href="<?php echo WEB_ROOT_PATH?>/logauto.php">ログアウト</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<hr>
		<div style='text-align:center;'>
			<?php if($_GET['search'] !==''){?>
				<h2>検索ワード：<?php echo htmlspecialchars($_GET['search']);?></h2>
				<h3>ヒット件数：<?php echo $topModel->getCount(); ?></h3>
			<?php }else{echo '<font color=red>※検索ワードを入力しましょう。<br></font>';}?>
		</div>
		<hr>
		<div class='content' style='padding-left: 20%'>
			<div class='thread' >
				<?php
				if($_GET['search'] !==''){
					foreach($topModel->getResult() as $t){?>
						<div class='title' style='margin-top: 3%;'>
							<a href="<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $t['threadNo'];?>" style='text-decoration: none;color:#000000:'>
								<?php 	if($t['threadImg'] == ''){	?>
									<img src='<?php echo THREAD_NOIMG ?>' width='30%' style='float:left;'>
								<?php }else{
									echo "<img src='{$t['threadImg']}' width='30%' style='float:left'>";
								} ?>
								<div class='desc' style='word-break: break-all;'> <?php echo $title = nl2br(htmlspecialchars($t['title'],ENT_QUOTES, 'UTF-8')).'<br>';?></div>
							</a>
							<div style='clear:both;'></div>
						</div>
						<hr>
					<?php } ?>
			</div>
		</div>
		<div class='footter'>
			<ul class='example05'>
				<li><?php echo $topModel->mae; ?></li>
				<li><?php foreach($topModel->paging as $p){ ?></li>
					<li><?php echo $p; ?></li>
				<?php } ?>
				<li><?php echo $topModel->tugi; ?></li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>