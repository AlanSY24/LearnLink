<!-- 導入style.css檔案 -->
<!-- 導入login.php檔案 -->
<!-- 導入signup.php檔案 -->


<!DOCTYPE html>
<html>
<head>
	<title>登入</title>
	
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="login.php" method="post">
     	<h2>登入</h2>
		
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<label>帳號</label>
     	<input type="text" name="uname" placeholder="註冊信箱"><br>

     	<label>密碼</label>
     	<input type="password" name="password" placeholder="英文和數字組成"><br>

     	<button type="submit">登入</button>
			<a href="signup.php" class="ca">註冊帳戶</a>


     </form>
</body>
</html>