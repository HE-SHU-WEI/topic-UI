<?php
session_start(); 
require_once('..\set.php');
$id = $_SESSION['id'];
$class = $_SESSION['class'];
$csv = $_POST['csv'];

$sql ="UPDATE `$class` SET `CSV`= '$csv' WHERE `id`= '$id'";//寫入SQL
$prepare =  $conn -> prepare($sql);
$prepare->execute();//執行

if ($prepare->execute()) {
    echo 'Update succeeded';
    echo '<br>3秒後跳轉到主畫面';
    header('refresh:3; url= ../home.html');
 
 } else {
    echo 'Update failed!';
    echo '<br>3秒後跳轉到上一頁';
    header('refresh:3; url= face.html');
 }



?>