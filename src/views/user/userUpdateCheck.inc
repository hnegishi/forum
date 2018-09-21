<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/userInfo.css" media="all">
	</head>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<h1 style='text-align:center;'>確認画面</h1>
		<h2 style='text-align:center;'>以下の内容で更新します。</h2>
		<div class="container" style="padding-left: 17%;">
			<div class="row profile">
				<div class="profile-sidebar" style="width: 60%;">
					<div class="profile-userpic">
						<?php  if($_FILES['upfile']['name']){?>
							<img src='<?php echo TMP_PATH.$userInfoUpdateModel->getThreadImg();?>' width=15%>
						<?php }elseif($_POST['upfile']){?>
							<img src='<?php echo TMP_PATH.$_POST['upfile'];?>' width='15%'>
						<?php }elseif($_POST['through']){?>
							<img src='<?php echo $_POST['through'];?>' width='15%'>
						<?php }else{?>
							<img src='<?php echo USER_NOIMG ?>' width=15%>
						<?php }?>
						<h2 style='text-align:center;word-break: break-all;'>名前：<?php echo htmlspecialchars($_POST['userName'],ENT_QUOTES, 'UTF-8');?></h2>
						<h3 style='text-align:center;word-break: break-all;'>住まい：<?php echo htmlspecialchars($_POST['from'],ENT_QUOTES, 'UTF-8');?></h3>
						<h3 style='text-align:center;word-break: break-all;'>ひとこと：<?php echo htmlspecialchars($_POST['comment'],ENT_QUOTES, 'UTF-8');?></h3>
						<form method='post' action='userUpdateExe.php'>
							<input type='hidden' name='userName' value='<?php echo htmlspecialchars($_POST['userName'],ENT_QUOTES, 'UTF-8'); ?>' >
							<input type='hidden' name='from' value='<?php echo htmlspecialchars($_POST['from'],ENT_QUOTES, 'UTF-8'); ?>' >
							<input type='hidden' name='comment' value='<?php echo htmlspecialchars($_POST['comment'],ENT_QUOTES, 'UTF-8'); ?>' >
							<?php if($_FILES['upfile']['name']){ ?>
								<input type='hidden' name='file' value='<?php echo $userInfoUpdateModel->getThreadImg();?>'>
							<?php }elseif($_POST['upfile']){?>
								<input type='hidden' name='file' value='<?php echo $_POST['upfile'];?>'>
							<?php }elseif($_POST['through']){?>
								<input type='hidden' name='through' value='<?php echo $_POST['through'];?>'>
							<?php }?>
							<input type='hidden' name='threadNo' value='<?php echo $_POST['threadNo']; ?>'>
							<input type='submit' name='snd' value='更新' class='center-block btn btn-default'>
						</form>
						<form method='post' action='userUpdate.php'>
							<input type='hidden' name='userName' value='<?php echo htmlspecialchars($_POST['userName'],ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='from' value='<?php echo htmlspecialchars($_POST['from'],ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='comment' value='<?php echo htmlspecialchars($_POST['comment'],ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='backfile' value='<?php if(($_FILES['upfile']['name'] !== '')){ echo $userInfoUpdateModel->getThreadImg();}elseif($_POST['upfile']){echo $_POST['upfile'];}else{echo '';};?>'>
							<input type='submit' name='back' value='戻る' class='center-block btn btn-default'>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>