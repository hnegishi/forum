<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/comment.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/chat.css" media="all">
		<script type="text/javascript" src="js/chat.js"></script>
	</head>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>

<div id="chat-frame" style='height:37%;'>
	<h1 style='text-align:center;'>確認ページ</h1>
	<h2 style='text-align:center;'>以下のコメントを削除します。</h2>
	<!-- div content -->
		<p class="chat-talk mytalk">
		<span class="talk-content" style='margin-left:100px'>
		<?php foreach($commentDeleteModel->getResultComment() as $c){?>
			<?php echo $c['CommentDate'].'<br>'?>
			<?php if($c['commentImg'] !==''){?>
				<img src='<?php echo $c['commentImg']?>' width='15%'>
			<?php }?>
			<?php echo htmlspecialchars($c['text'],ENT_QUOTES, 'UTF-8');?>
		</span><br>
			<form method='post' action='comment.php' style='display:inline;'>
				<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo'];?>'>
				<button type='submit' name='back' class=' btn btn-default btn-lg' style="margin-left: 38%;margin-right:3%;">戻る</button>
			</form>
			<form method='post' action='commentDeleteExe.php' style='display:inline;'>
				<input type='hidden' name='commentNo' value='<?php echo $c['commentNo'];?>'>
				<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo'];?>'>
				<button type='submit' name='snd' class=' btn btn-default btn-lg' >削除</button>
			</form>
		<?php }?>
			</p></div>
	</body>
</html>