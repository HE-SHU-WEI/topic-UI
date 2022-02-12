<?php
//
//  名稱：已登入頁面
//  狀態：css尚未開工
//
//
//使用會話記憶體儲的變數值之前必須先開啟會話
session_start();
header("Content-Type content=text/html; charset=utf-8");
//使用一個會話變數檢查登入狀態
try {
    if(isset($_SESSION['username'])){
        echo '你好'.$_SESSION['username'];
        echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        header("Location:user/");
    }else{
        echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        }
    }catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

/**在已登入頁面中，可以利用使用者的session如$_SESSION['username']、
* $_SESSION['user_id']對資料庫進行查詢，可以做好多好多事情*/
?>