<html>
	<?php include  TOP_PATH.'/head.inc';?>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample3">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="navbarEexample3">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo WEB_ROOT_PATH?>/top.php">TOP</a></li>
						<li><a href="<?php echo WEB_ROOT_PATH?>/threadPostForm.php">スレッド作成</a></li>
						<li ><a href="<?php echo WEB_ROOT_PATH?>/userInfo.php"><?php echo htmlspecialchars($userName->getUserName(),ENT_QUOTES, 'UTF-8'); ?></a></li>
						<li><a href="<?php echo WEB_ROOT_PATH?>/logauto.php">ログアウト</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<h1 style='text-align:center;'>タイトル</h1>
		<hr>
			<form  class='center' style="display: inline;padding-left: 18%;" method='get' action='top.php'>
				<input type='text'  style="display: inline" name='search' placeholder='ワード検索'>
				<input type='submit'  style="display: inline" name='searchSnd' value='検索'>
			<h4 style="display: inline;padding-left: 18%;" > <?php echo date("Y.m.d"); ?></h4>
		</form>
		<hr>
			<!--  <div class='content' style='padding-left: 10%'>-->
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
						<input type='text'  name='tagName' placeholder='タグ検索' style='margin-top:3%;'>
						<input type='submit' name='sndTag' value='検索'>
					</form>
				</div>
				<div class='thread' >
					<?php foreach($topModel->getResult() as $t){?>
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
			</div>
		<div class='sub'>
			<p>新着スレッド</p>
			<div class='newThread'>
				<?php foreach($topModel->setNewThread() as $new){?>
				<a href="<?php echo WEB_ROOT_PATH?>/comment.php?threadNo=<?php echo $new['threadNo'];?>" style='display:block;margin-left:10%;'>
					<span style='word-break: break-all;margin-bottom:0px;font-size:1em;font-weight:400;text-align:left;  overflow: hidden;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;'>
						<?php echo $title = nl2br(htmlspecialchars($new['title'],ENT_QUOTES, 'UTF-8'));?>
						<br>
					</span>
					<span style='word-break: break-all;font-size:0.8em;font-weight:100;text-align:left;color:#A4A4A4;  overflow: hidden;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 6;'>
					<?php echo $content = nl2br(htmlspecialchars($new['content'],ENT_QUOTES, 'UTF-8'));?>
					</span>
					<hr>
					<?php }?>
				</a>
			</div>
		</div>
		<div class='footter' >
			<ul class='example05'>
				<li><?php echo $topModel->mae; ?></li>
				<li><?php foreach($topModel->paging as $p){ ?></li>
					<li><?php echo $p; ?></li>
				<?php }?>
				<li><?php echo $topModel->getPage(); ?></li>
				<li><?php foreach($topModel->paging1 as $p1){ ?></li>
					<li><?php echo $p1; ?></li>
				<?php }?>
				<li><?php echo $topModel->tugi; ?></li>
			</ul>
		</div>
	</body>
</html>