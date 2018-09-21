<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/userInfo.css" media="all">
	</head>
	<body>
		<?php include COMMENT_PATH.'/navi.inc';?>
		<h1 style='text-align:center;'>ユーザー情報編集</h1>
			<form method='post' class="form-horizontal" action='userUpdateCheck.php' enctype='multipart/form-data'>
				<?php foreach($userInfoUpdateModel->getResult() as $r){ ?>
					<div class="container" style="padding-left: 17%;">
						<div class="row profile">
							<div class="profile-sidebar" style="width: 505px;">
								<div class="profile-userpic">
									<?php if($_POST['backfile']){?>
										<img src='<?php echo TMP_PATH.$_POST['backfile']; ?>' width='30%' >
										<input type='hidden' name='upfile' value='<?php echo $_POST['backfile']; ?>'>
									<?php }elseif($_FILES['upfile']['name']){?>
										<img src='<?php echo TMP_PATH.$userInfoUpdateModel->getThreadImg(); ?>' width='30%' >
										<input type='hidden' name='upfile' value='<?php echo $userInfoUpdateModel->getThreadImg(); ?>'>
									<?php }elseif($_POST['upfile']){?>
										<img src='<?php echo TMP_PATH.$_POST['upfile'] ?>' width='30%' >
										<input type='hidden' name='upfile' value='<?php echo $_POST['upfile'] ?>'>
									<?php }elseif($r['userImg']){	?>
										<img src='<?php echo $r['userImg']; ?>' width='30%'>
										<input type='hidden' name='through' value='<?php echo $r['userImg']; ?>'>
									<?php }else{ ?>
										<img src='<?php echo USER_NOIMG?>' width='30%'>
									<?php }?>
										<input type='file' name='upfile' size='' class='center-block'><br>
										<font color='red' style='display:block;text-align: center;'>
											<?php foreach($userInfoUpdateModel->error as $e){ echo $e.'<br>';}?>
										</font>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="name">名前</label>
										<div class="col-md-7">
											<input type='text' class="form-control" name='userName' required value='<?php if($_POST['userName']){echo htmlspecialchars($_POST['userName'],ENT_QUOTES, 'UTF-8');}else{ echo htmlspecialchars($r['userName']);}; ?>'><br>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="from">住まい</label>
										<div class="col-md-7">
											<input type='text' class="form-control" name='from' value='<?php if($_POST['from']){echo htmlspecialchars($_POST['from'],ENT_QUOTES, 'UTF-8');}else{echo htmlspecialchars($r['from'],ENT_QUOTES, 'UTF-8');} ?>'><br>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="comment">ひとこと</label>
										<div class="col-md-7">
											<textarea class="form-control" name="comment"  rows="3"><?php if($_POST['comment']){echo htmlspecialchars($_POST['comment'],ENT_QUOTES, 'UTF-8');}else{echo htmlspecialchars($r['comment'],ENT_QUOTES, 'UTF-8');} ?></textarea>
										</div>
									</div>
									<br>
									<input type='submit' name='snd' value='確認' class='center-block btn btn-default' >
									<button type='button' onclick="location.href='<?php echo WEB_ROOT_PATH?>/userInfo.php'" class='center-block btn btn-default'>戻る</button>
								</div>
							</div>
						</div>
				<?php }?>
			</form>
	</body>
</html>