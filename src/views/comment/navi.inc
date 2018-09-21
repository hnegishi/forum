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