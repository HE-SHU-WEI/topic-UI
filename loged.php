<?php
//使用會話記憶體儲的變數值之前必須先開啟會話
session_start();
header("Content-Type content=text/html; charset=utf-8");
//使用一個會話變數檢查登入狀態
try {
    if(isset($_SESSION['username'])){
        echo '你好'.$_SESSION['username'];
        echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        header("Location:user/student.php");
    }else{
        echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        }
    }catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


?>