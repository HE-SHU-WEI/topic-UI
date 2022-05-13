<?php
session_start(); 
require_once('..\set.php');
$id = $_SESSION['id'];
$class = $_SESSION['class'];
$csv = $_POST['csv'];

$sql ="UPDATE `$class` SET `CSV`= '$csv' WHERE `id`= '$id'";//寫入SQL
$prepare =  $conn -> prepare($sql);
$prepare->execute();//執行



?>