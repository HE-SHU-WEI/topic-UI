<?php
//
//  名稱：連結db
//  狀態：待更改
//
//

// //資料庫的位置
// define('DB_HOST', 'localhost');
// //使用者名稱
// define('DB_USER', 'root');
// //口令
// define('DB_PASSWORD', '');
// //資料庫名
// define('DB_NAME','teacher') ;

// define('con_year' , 110);

//---------------------------
$server_name = 'localhost';
$username = 'root';
$password = '';
$db_name = 'teacher';

$conn = new PDO("mysql:host=$server_name;dbname=$db_name", $username, $password
        ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));

//連線完要加上下面這兩行，編碼跟時區比較不會有問題
$conn->query('SET time_zone = "+8:00"'); // 設定台灣時間

$conni = new PDO("mysql:host=$server_name;dbname=$db_name", $username, $password
        ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
?>
