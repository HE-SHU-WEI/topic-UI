<?php
session_start(); 
require_once('..\set.php');
    $name     = '';
    $password = '';
    $account  = '';

    if($_POST){
    /*接收前面傳來的post*/ 
    $name     = $_POST['realN'];
    $password = $_POST['PW'];
    $account  = $_POST['acc'];
    $class    = $_POST['major'] . $_POST['grade'] . '年級';
    $_SESSION['class'] = $class;
    //把系班級拼起來
    }

if(!empty($class)&&!empty($name)&&!empty($account)&&!empty($password))
{
    try {
        $stmt = $conn ->query("SELECT * FROM $class WHERE name = '$name' AND id ='$account' AND passW ='$password'");//從 SQL中找有沒有這個人
        //table名稱為輸入的班級

        // $stmt->execute( [  $_POST['acc'] ] );
        $result = $stmt->fetchAll();
        if ( count($result) ==0 )
            $txt =  "帳號或密碼有誤！請再試一次";
        elseif (count($result) < 0 )
            $txt =  "請輸入名稱、帳號、密碼";
        else{
            $_SESSION['welocme']  =  "歡迎加入，請點選登入";
            $_SESSION['username'] =  $_POST['realN'] ;
            echo $_SESSION['username'];
            $url = 'face.html';
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



<!-- -------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/post.css" />
    <title>註冊臉部訊息</title>
</head>
<body>
    <a href="../home.html" >
        <img src="../picture/BigLogo.png" class="logo" style="margin-left: 45%;"  /> 
    </a>

    <div style="width: 100%;display: inline-block;text-align: center;">
        <div class="mobile-box">
            <h3>登入以註冊臉部訊息</h3>
            <form method="post" action="" >
                <label >科系</label><span>Major</span><br>
                <input class="input_style" type="text" minlength="1" maxlength="20" name="major"><br>
                <label >年級</label><span>Grade</span><br>
                <select name="grade">
                    <option value="一">1</option>
                    <option value="二">2</option>
                    <option value="三">3</option>
                    <option value="四">4</option>
                    <option value="五">5</option>
                    <option value="六">6</option>
                    <option value="七">7</option>
                </select>
                <br>

                <label >名字 </label><span>Name</span><br>
                <input class="input_style" type="text" minlength="1" maxlength="20" name="realN"><!--真實realN命名--><br>
                <!--資料庫  account的大小設為20-->

                <label >帳號 </label><span>User ID</span><br>
                <span style="font-weight: bold;color: #52aef4;">
                        開頭請輸入大寫</span><br>
                <input class="input_style" type="text" placeholder="請輸入學號/職工編號"  onkeyup="value=value.replace(/[^\w@.]|_/ig,'')"  minlength="1" maxlength="20" name="acc"><!--acc帳號--><br>
                <!--資料庫  password的大小設為10-->
                
                <label >密碼 </label><span>Password</span><br>
                <input class="input_style" type="password" minlength="1" maxlength="10"name="PW" ><!--PW密碼--><br>
                <?php echo $txt;?>
                <br>
                <input type="submit" value="提交">
            </form>
        </div>
    </div>
    
</body>
</html>