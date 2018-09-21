<html>
	<head>
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<link rel="stylesheet" type="text/css" href="css/login.css" media="all">
		<?php include COMMENT_PATH.'/bootstrap.inc';?>
		<script type="text/javascript" src="js/login.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="pen-title">
					<h1>タイトル</h1>
				</div>
				<div class="container">
					<div class='card'></div>
  					<div class="card">
						<h1 class="title">Login</h1>
						<form method='post' >
							<div class="input-container">
								<font color='red'>
									<?php foreach($loginModel->error as $e){echo $e;}?>
								</font>
							</div>
							<div class="input-container">
								<input type='text' name='loginId'  value='<?php echo htmlspecialchars($_POST['loginId'],ENT_QUOTES, 'UTF-8')?>'>
								<label for="text">ログインID</label>
								<div class="bar"></div>
							</div>
							<div class="input-container">
								<input type='password' name='pass'>
								<label for="Password">パスワード</label>
								<div class="bar"></div>
							</div>
							<div class="button-container">
								<button type='submit' name='snd'><span>ログイン</span></button>
							</div>
						</form>
						<p style='text-align:center;'>会員登録がお済でない方は<a href='<?php echo WEB_ROOT_PATH?>/regForm.php'>こちら。</a></p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>