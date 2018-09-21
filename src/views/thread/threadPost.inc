<html>
	<?php include THREAD_PATH.'/head.inc';?>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
	<header>
		<h1>スレッド投稿</h1>
			<div class='left'>
				<?php if($_POST['backfile']){?>
					<img src='<?php echo TMP_PATH.$_POST['backfile'];?>' width='90%'>
				<?php }elseif($_FILES['upfile']['name']){?>
					<img src='<?php echo TMP_PATH.$threadPostModel->getThreadImg();?>' width='90%'>
				<?php }elseif($_POST['upfile']){ ?>
					<img src='<?php echo TMP_PATH.$_POST['upfile'];?>' width='90%'>
				<?php }elseif($_POST['backfile'] == ''){?>
					<img src='<?php echo THREAD_NOIMG ?>' width='90%'>
				<?php }?>
				<form method='post' action='threadPostCheck.php' enctype='multipart/form-data' style='display:inline;'>
					<input type='file' name='upfile' size=''>
					<input type="hidden" name="MAX_FILE_SIZE" value="130000" />
			</div>
					<font color='red' style='padding-left:22%;display:block;'>
						<?php foreach($threadPostModel->error as $e){ echo $e.'<br>'; }?>
					</font>
					<div class='right'>
						<textarea name='title' rows='2' cols='50' required placeholder='タイトル'><?php echo htmlspecialchars($threadPostModel->getTitle(),ENT_QUOTES, 'UTF-8');?></textarea><br>
						<textarea name='content' rows='4' cols='50' placeholder='サブタイトル' style='display:block;'><?php echo htmlspecialchars($threadPostModel->getContent(),ENT_QUOTES, 'UTF-8');?></textarea>
						<select name="tag4" required>
							<option value="">カテゴリタグ</option>
							<option value="ニュース" <?php if($_POST['tag4'] == 'ニュース'){echo 'selected';}?>>ニュース</option>
							<option value="エンタメ" <?php if($_POST['tag4'] == 'エンタメ'){echo 'selected';}?>>エンタメ</option>
							<option value="グルメ" <?php if($_POST['tag4'] == 'グルメ'){echo 'selected';}?>>グルメ</option>
							<option value="カラダ" <?php if($_POST['tag4'] == 'カラダ'){echo 'selected';}?>>カラダ</option>
							<option value="ビジネス" <?php if($_POST['tag4'] == 'ビジネス'){echo 'selected';}?>>ビジネス</option>
							<option value="雑学" <?php if($_POST['tag4'] == '雑学'){echo 'selected';}?>>雑学</option>
							<option value="おもしろ" <?php if($_POST['tag4'] == 'おもしろ'){echo 'selected';}?>>おもしろ</option>
							<option value="ガールズ" <?php if($_POST['tag4'] == 'ガールズ'){echo 'selected';}?>>ガールズ</option>
						</select>
						<br>
						<input type='text' name='tag1' placeholder='タグ1' value='<?php echo $_POST['tag1']?>'>
						<input type='text' name='tag2' placeholder='タグ2' value='<?php echo $_POST['tag2']?>'>
						<input type='text' name='tag3' placeholder='タグ3' value='<?php echo $_POST['tag3']?>'>
						<?php if(isset($_POST['back'])){?>
							<input type='hidden' name='upfile' value='<?php echo $_POST['backfile']; ?>'>
						<?php }elseif(isset($_FILES['upfile']['name'])){ ?>
							<input type='hidden' name='upfile' value='<?php if($threadPostModel->getThreadImg()){echo $threadPostModel->getThreadImg(); }elseif($_POST['upfile']){echo $_POST['upfile'];} ?>'>
						<?php }elseif(isset($_POST['upfile'])){ ?>
							<input type='hidden' name='upfile' value='<?php echo $_POST['upfile']; ?>'>
						<?php }?>
						<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/top.php'" class="btn btn-primary btn-lg" style="margin-left: 18%;">TOPに戻る</button>
						<button type='submit' name='snd' class="btn btn-primary btn-lg" >投稿する</button>
					</div>
				</form>
		</header>
	</body>
</html>