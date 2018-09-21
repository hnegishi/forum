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
						<h1 class="title">以下の内容で登録します。</h1>
						<div class="input-container">
							なまえ：<font size=5%><?php echo htmlspecialchars($regmodel->getName(),ENT_QUOTES, 'UTF-8');?></font>
							<div class="bar"></div>
						</div>
						<div class="input-container">
							ログインID：<font size=5%><?php echo htmlspecialchars($regmodel->getLoginId(),ENT_QUOTES, 'UTF-8');?></font>
							<div class="bar"></div>
						</div>
						<form method='post' action='regInsert.php'>
							<input type='hidden' name='name' value='<?php echo htmlspecialchars($regmodel->getName(),ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='loginId' value='<?php echo htmlspecialchars($regmodel->getLoginId(),ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='pass' value='<?php echo $_POST['pass']?>'>
							<div class="button-container">
							<button type='submit' name='snd'><span>送信</span></button>
							</div>
						</form>
						<form method='post' action='regForm.php'>
							<input type='hidden' name='name' value='<?php echo htmlspecialchars($regmodel->getName(),ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='loginId' value='<?php echo htmlspecialchars($regmodel->getLoginId(),ENT_QUOTES, 'UTF-8');?>'>
							<input type='hidden' name='pass' value='<?php echo $_POST['pass']?>'>
							<div class="button-container">
								<button type='submit' name='back'><span>戻る</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>