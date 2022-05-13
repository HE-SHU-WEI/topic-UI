<?php
//使用會話記憶體儲的變數值之前必須先開啟會話
session_start();
header("Content-Type content=text/html; charset=utf-8");
//使用一個會話變數檢查登入狀態
try {
    if(isset($_SESSION['username'])){
        $n = $_SESSION['username'];
        $txt =  '你好，'.$_SESSION['username']. '同學<br>';
        $logout =  '<a href="/test/logOut.php"> Log Out('.$_SESSION['username'].')</a>';

        $conn = new PDO("mysql:host=localhost;dbname=php_class", "root", "lawrence664"
        ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));   
        $stmt = $conn ->prepare("SELECT name,id,time
                                                                    FROM 點名_資料庫程式設計 
                                                                    WHERE name = (SELECT realN FROM user WHERE realN = '$n')");
        $stmt ->execute();
        $result = $stmt ->fetchAll();
        $str = "";
        foreach ($result as $row){
            $str = $str .  "<li>name:".$row["name"] ."時間".$row["time"]."</li>";
        }

    }else{
        echo '<a href="/test/logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        }
    }catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

/**在已登入頁面中，可以利用使用者的session如$_SESSION['username']、
* $_SESSION['user_id']對資料庫進行查詢，可以做好多好多事情*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/test/css/main.css" />
    <title>學生系統</title>
</head>
<body >

    <div>
    <a href ="/test/user_interface/user_interface.html" style="height : 0%;">
            <img src = '/test/picture/new.png', class="person_icon" ></a>
    <div style = "margin-bottom:5%;width: 10% ;float:left;">
        <?=$txt;?>
    </div>
    </div>
    <?=$logout;?>
    <div style="width: 100%;display: inline-block;text-align: center;">
        <div class="user-index">
            <!-- <?=$str;?> -->
            
        </div>
    </div>
    
</body>
</html>