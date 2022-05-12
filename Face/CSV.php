<?php
session_start(); 
require_once('..\set.php');
// $id = $_SESSION['id'];
// $class = $_SESSION['class'];
$csv = $_POST['csv'];

$sql ="UPDATE `資通三年級` SET `CSV`= '$csv' WHERE `name`= '劉瑋隆'";
$prepare =  $conn -> prepare($sql);
$prepare->execute();
// mysqli_query($conni,"UPDATE `資通三年級` SET `CSV`= $csv WHERE `id`= 'A108510347'");
// $result->fetchAll();



//-------
echo $_SESSION['id'] ;
echo  $_SESSION['class'] ;
echo $csv;
?>