<!-- 導入index.php檔案 -->
<!-- 導入logout.php檔案 -->

<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
     <a href="logout.php">登出</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>