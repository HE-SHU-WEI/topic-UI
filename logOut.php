<?php
//
//  名稱：登出頁面
//  狀態：css尚未開工
//
//
//即使是登出時，也必須首先開始會話才能訪問會話變數
session_start();
//使用二個會話變數檢查登入狀態  是登入or未登入
//未登入
if(!isset($_SESSION['user_id'])){
    echo "須先登入才能登出";
    //要清除會話變數，將$_SESSION超級全域性變數設定為一個空陣列
    $_SESSION = array();
    //location首部使瀏覽器重定向到另一個頁面
    header('Refresh: 3 ,url = home.html');
}
//登入
if(isset($_SESSION['user_id'])){
    echo "頁面將於3秒後自動跳轉";

//要清除會話變數，將$_SESSION超級全域性變數設定為一個空陣列
$_SESSION = array();
//如果存在一個會話cookie，通過將到期時間設定為之前1個小時從而將其刪除
if(isset($_COOKIE[session_name()])){
setcookie(session_name(),'',time()-3600);
}
//使用內建session_destroy()函式呼叫撤銷會話
session_destroy();

//location首部使瀏覽器重定向到另一個頁面
header('Refresh: 3 ,url = home.html');
}

?>

