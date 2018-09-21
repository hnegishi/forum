<html>
<?php include REG_PATH.'/head.inc';?>
	<body>
		<div class="container">
			<div class="row">
				<div class="pen-title">
					<h1>タイトル</h1>
				</div>
				<div class="container">
					<div class="card"></div>
					<div class="card">
						<h1 class="title">会員登録</h1>
						<form method='post' action='regCheck.php'>
							<div class="input-container">
	 							<font color='red'>
									<?php foreach($regmodel->error as $e){echo $e.'<br>';}?>
								</font>
							</div>
							<div class="input-container">
								<input type='text' name='name' placeholder='' value='<?php echo htmlspecialchars($regmodel->getName(),ENT_QUOTES, 'UTF-8');?>'>
								<label for="Username">なまえ</label>
							<div class="bar"></div>
							</div>
							<div class="input-container">
								<input type='text' name='loginId' value='<?php echo htmlspecialchars($regmodel->getLoginId(),ENT_QUOTES, 'UTF-8');?>'>
								<label for="Password">ログインID</label>
								<div class="bar"></div>
							</div>
							<div class="input-container">
								<input type='password' name='pass' value=''>
								<label for="Password">パスワード</label>
								<div class="bar"></div>
							</div>
							<div class="button-container">
								<button type='submit' name='snd'><span>登録</span></button>
							 </div>
						</form>
						<div style='text-align:center;'><a href='<?php echo WEB_ROOT_PATH?>/login.php' >ログインフォームに戻る</a></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>