<?php
$server_name = 'localhost';
$username = 'root';
$password = '';
$db_name = 'teacher';

$conn = new PDO("mysql:host=$server_name;dbname=$db_name", $username, $password
        ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));

//連線完要加上下面這兩行，編碼跟時區比較不會有問題
$conn->query('SET time_zone = "+8:00"'); // 設定台灣時間


        
$conni = new mysqli($server_name, $username, $password, $db_name);
//設定連線的字元集為 UTF8 編碼
mysqli_set_charset($conni, "utf8");



$path = 'C:/Users/User/Desktop/face/';//註冊照片儲存地點
?>
