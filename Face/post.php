<!--post.php接收來自post.html的資訊
名字 name="realN"
帳號 name="acc"，資料庫  account的大小設為20                
密碼 name="PW" ，資料庫  password的大小設為10
--> 

<?php
require_once('C:\xampp\htdocs\topic\conn.php');

    /*接收前面傳來的post*/ 
    $name =   $_POST['realN'];
    $password = $_POST['PW'];
    $account = $_POST['acc'];
    

if(!empty($name)&&!empty($account)&&!empty($password))
{
    session_start();

    try {
        $stmt = $conn ->prepare("SELECT * FROM `user` WHERE realN = '$name' AND account ='$account'  AND passW ='$password' ; ");
        $stmt->execute( [  $_POST['acc'] ] );
        $result = $stmt->fetchAll();
        if ( count($result) ==0 )
            $txt =  "帳號或密碼有誤！請再試一次";
        elseif (count($result) < 0 )
            $txt =  "請輸入名稱、帳號、密碼";
        else{
            /**不知道插入啥  所以打?*/ 
            //$stmt = $conn ->prepare("INSERT INTO user (passW,realN,account) VALUES (? , ? , ?);");
            //$stmt->execute(  [$_POST['PW'] , $_POST['realN']  , $_POST['acc'] ]);
            //$id =$conn->lastInsertId() ;
            //echo $id;
            $_SESSION['welocme']=  "歡迎加入，請點選登入";
            $_SESSION['username'] = $_POST['realN'] ;
            $url = 'face_record/record.html';
            sleep(3);
            header('Location: '.$url);
        }
    } catch(PDOException $e ) {
        $txt =  "資料庫連結失敗! 錯誤訊息為 " . $e->getMessage();
    }
}
else {
    $txt = "註冊須輸入名稱帳號以及密碼";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/m.css" />
    <title>註冊臉部訊息</title>
</head>
<body>
    <a href="home.html" >
        <img src="picture/logo.png" class="logo" style="margin-left: 45%;"  /> 
    </a>

    <div style="width: 100%;display: inline-block;text-align: center;">
        <div class="mobile-box">
            <h3>註冊臉部訊息</h3>
            <form method="post" action="post.php" >
                <label >名字 </label><span>Name</span><br>
                <input class="input_style" type="text" minlength="1" maxlength="20" name="realN"><!--真實realN命名--><br>
                <!--資料庫  account的大小設為20-->
                <label >帳號 </label><span>User ID</span><br>
                <span style="font-weight: bold;color: #52aef4;">
                    <i><img src="picture/information.png" class="information_icon"></i> 
                        開頭請輸入大寫</span><br>
                <input class="input_style" type="text" placeholder="請輸入學號/職工編號"  onkeyup="value=value.replace(/[^\w@.]|_/ig,'')"  minlength="1" maxlength="20" name="acc"><!--acc帳號--><br>
                <!--資料庫  password的大小設為10-->
                <label >密碼 </label><span>Password</span><br>
                <input class="input_style" type="password" minlength="1" maxlength="10"name="PW" ><!--PW密碼--><br>
                <?=$txt;?>
                <br>
                <input type="submit" value="提交">
            </form>
        </div>
    </div>
    
</body>
</html>