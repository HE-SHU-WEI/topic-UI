<?php
    session_start();
    //
//  名稱：首頁
//  狀態：css尚未開工
//
//
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?=$_SESSION['welocme'];?>
    <input type="button" value="登出"  onclick="location.href='logOut.php'">
    <input type="button" value="登入"  onclick="location.href='logIn.php'">
</body>
</html>