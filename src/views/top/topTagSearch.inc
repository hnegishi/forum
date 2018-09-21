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
							<input type='text' name='search' placeholder='ワード検索'>
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
			<?php if($_GET['tagName'] !==''){?>
				<h2>検索タグ：<?php if($_POST['tagName']){echo htmlspecialchars($_POST['tagName']);}elseif($_GET['tagName']){echo htmlspecialchars($_GET['tagName']);}?></h2>
				<h3>ヒット件数：<?php echo $topModel->tagCount; ?></h3>
			<?php }else{echo '<font color=red>※タグを入力しましょう。<br></font>';}?>
		</div>
		<hr>
		<div class='tagSearch' style='margin-left:18%;margin-top: 3%;'>
			<span style='background-color:#E6E6E6;display:block;margin-bottom:5%;'>
				お手軽タグ検索
			</span>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "ニュース";?>' style='margin:3%;'>ニュース</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "エンタメ";?>' style='margin:3%;'>エンタメ</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "グルメ";?>' style='margin:3%;'>グルメ</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "カラダ";?>' style='margin:3%;'>カラダ</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "ビジネス";?>' style='margin:3%;'>ビジネス</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "雑学";?>' style='margin:3%;'>雑学</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "おもしろ";?>' style='margin:3%;'>おもしろ</a><br>
			<a href='<?php echo WEB_ROOT_PATH?>/top.php?tagName=<?php echo "ガールズ";?>' style='margin:3%;'>ガールズ</a><br>
			<form method='get' >
				<input type='text'  name='tagName' placeholder='タグ検索' style='margin-top:3%;' value='<?php if($_GET['tagName'] !==''){echo $_GET['tagName']; }?>'>
				　<input type='submit' name='sndTag' value='検索'>
			</form>
		</div>
		<div class='thread' >
				<?php foreach($topModel->getSearchResult() as $t){?>
					<div class='title' style='padding-left:15%;'>
						<a href="<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $t['threadNo'];?>" style='text-decoration: none;color:#000000:'>
							<?php if($t['threadImg'] == ''){	?>
								<img src='<?php echo THREAD_NOIMG ?>' width='18%' style='float:left;'>
							<?php }else{
								echo "<img src='{$t['threadImg']}' width='18%' style='float:left'>";
							}?>
							<div class='desc' style='word-break: break-all;'>
								<?php echo $title = nl2br(htmlspecialchars($t['title'],ENT_QUOTES, 'UTF-8')).'<br>';?>
							</div>
						</a>
						<div style='clear:both;'></div>
					</div>
					<hr><br>
				<?php }?>
			</div>

		<div class='footter' >
			<ul class='example05'>
				<li><?php echo $topModel->mae; ?></li>
				<li><?php foreach($topModel->paging as $p){ ?></li>
					<li><?php echo $p; ?></li>
				<?php }?>
				<li><?php echo $topModel->tugi; ?></li>
			</ul>
		</div>
	</body>
</html>