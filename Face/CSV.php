<?php
session_start(); 
require_once('..\set.php');
$id = $_SESSION['id'];
$class = $_SESSION['class'];
$csv = $_POST['csv'];

$conn -> query("UPDATE $class SET `CSV`= $csv WHERE `id`= $id");

//-------
echo $_SESSION['id'] ;
echo  $_SESSION['class'] ;

?>