<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/comment.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/chat.css" media="all">
		<script type="text/javascript" src="js/chat.js"></script>
	</head>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>

	<div id="chat-frame" style='height:auto;'>
		<h1 style='text-align:center;'>確認画面</h1>
		<p style='text-align:center;'>以下の内容で送信します。</p><br>
		<p class="chat-talk mytalk">
		<span class="talk-content" style='margin-left:100px;word-break: break-all;'>
			<?php  if($_FILES['upfile']['name']){?>
				<img src='<?php echo TMP_PATH.$commentCheckModel->getThreadImg();?>' width=15%>
			<?php }elseif($_POST['upfile']){?>
				<img src='<?php echo TMP_PATH.$_POST['upfile'];?>' width='15%'>
			<?php } ?>
			<?php echo $text = nl2br(htmlspecialchars($_POST['text'],ENT_QUOTES, 'UTF-8')); ?>
		</span><br>
		<form method='post' action='comment.php' style='display:inline;' >
			<input type='hidden' name='text' value='<?php echo htmlspecialchars($_POST['text'],ENT_QUOTES, 'UTF-8')?>'>
			<input type='hidden' name='backfile' value='<?php if(($_FILES['upfile']['name'] !== '')){ echo $commentCheckModel->getThreadImg();}elseif($_POST['upfile']){echo $_POST['upfile'];}else{echo '';};?>'>
			<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo'];?>'>
			<input type='submit' name='snd' value='戻る' class=' btn btn-default btn-lg' style="margin-left: 38%;margin-right:3%;">
		</form>
		<form method='post' action='commentPostExe.php' style='display:inline;'>
			<input type='hidden' name='text' value='<?php echo htmlspecialchars($_POST['text'],ENT_QUOTES, 'UTF-8')?>'>
			<input type='hidden' name='file' value='<?php echo $commentCheckModel->getThreadImg();?>'>
			<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo'];?>'>
			<input type='hidden' name='userName' value='<?php echo htmlspecialchars($_POST['userName'],ENT_QUOTES, 'UTF-8')?>'>
			<input type='submit' name='snd' value='送信' class=' btn btn-default btn-lg' >
		</form>
		</p>
		</div>
	</body>
</html>