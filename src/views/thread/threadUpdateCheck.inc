<html>
	<?php include THREAD_PATH.'/head.inc';?>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<header>
			<h1>確認画面</h1>
			<h2>以下のスレッドを編集します。</h2>
			<div class='left'>
				<?php  if($_FILES['upfile']['name']){?>
					<img src='<?php echo '/board/bord/tmpImg/'.$threadUpdateModel->getThreadImg();?>' width=90%>
				<?php }elseif($_POST['upfile']){?>
					<img src='<?php echo '/board/bord/tmpImg/'.$_POST['upfile'];?>' width='90%'>
				<?php }elseif($_POST['through']){?>
					<img src='<?php echo $_POST['through'];?>' width='90%'>
				<?php }else{?>
					<img src='<?php echo THREAD_NOIMG?>' width=90%>
				<?php }?>
			</div>
			<div class='right'>
				<h2 style='word-break: break-all'><?php echo $title = nl2br(htmlspecialchars($_POST['title'],ENT_QUOTES, 'UTF-8'));?></h2>
				<h4 style='word-break: break-all'><?php echo $content = nl2br(htmlspecialchars($_POST['content'],ENT_QUOTES, 'UTF-8'));?></h4>
				<form method='post' action='threadUpdate.php' style='display:inline;'>
					<input type='hidden' name='title' value='<?php echo htmlspecialchars($_POST['title'],ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='content' value='<?php echo htmlspecialchars($_POST['content'],ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='backfile' value='<?php if(($_FILES['upfile']['name'] !== '')){ echo $threadUpdateModel->getThreadImg();}elseif($_POST['upfile']){echo $_POST['upfile'];}else{echo '';};?>'>
					<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo']; ?>'>
					<button type='submit' name='back'  class="btn btn-primary btn-lg" >戻る</button>
				</form>
				<form method='post' action='threadUpdateExe.php' style='display:inline;'>
					<input type='hidden' name='title' value='<?php echo htmlspecialchars($_POST['title'],ENT_QUOTES, 'UTF-8');?>'>
					<input type='hidden' name='content' value='<?php echo htmlspecialchars($_POST['content'],ENT_QUOTES, 'UTF-8');?>'>
					<?php if($_FILES['upfile']['name']){ ?>
						<input type='hidden' name='file' value='<?php echo $threadUpdateModel->getThreadImg();?>'>
					<?php }elseif($_POST['upfile']){?>
						<input type='hidden' name='file' value='<?php echo $_POST['upfile'];?>'>
					<?php }elseif($_POST['through']){?>
						<input type='hidden' name='through' value='<?php echo $_POST['through'];?>'>
					<?php }?>
					<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo']; ?>'>
					<button  type='submit' name='snd' class="btn btn-primary btn-lg">更新</button>
				</form>
			</div>
		</header>
	</body>
</html>