<!-- 連接資料庫learnlink檔案 -->
<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "learnlink";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "連接失敗!";
}
