<?php
session_start(); 
require_once('..\set.php');
$_SESSION['class'] = $class;
$_SESSION['username'] = $name;

$csv = $conn -> query("UPDATE $class SET `name`= $name,`id`='[value-2]',`major`='[value-3]',`grade`='[value-4]',`CSV`='[value-5]',`account`='[value-6]',`passW`='[value-7]' WHERE 1");

?>