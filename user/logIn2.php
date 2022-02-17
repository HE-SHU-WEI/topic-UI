<?php
//
//  名稱：登入頁面
//  狀態：完成
//
//
//插入連線資料庫的相關資訊
require_once('C:\xampp\htdocs\topic\conn.php');
//開啟一個會話
    session_start();
    $error_msg = "";
//如果使用者未登入，即未設定$_SESSION['user_id']時，執行以下程式碼
    if(!isset($_SESSION['user_id'])){
        if(isset($_POST['submit'])){//使用者提交登入表單時執行如下程式碼
            $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            mysqli_query($dbc,"SET NAMES utf8");
            $user_username = mysqli_real_escape_string($dbc,trim($_POST['userID']));
            $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

            if(!empty($user_username)&&!empty($user_password)){
                $query = "SELECT * FROM user WHERE account = '$user_username' AND "."passW = '$user_password'";
               
                //用使用者名稱和密碼進行查詢
                $data = mysqli_query($dbc,$query);
                    //若查到的記錄正好為一條，則設定SESSION，同時進行頁面重定向
                    if(mysqli_num_rows($data)==1){
                        $row = mysqli_fetch_array($data);
                        $_SESSION['username'] = $row['realN'];
                        $_SESSION['user_id'] = $row['id'];
                        if($row['account'][0] != 'A'){
                            $home_url = 'user/teacher.php';
                        }else {
                            $home_url = 'user/student.php';
                        }
                        header('Location: '.$home_url);
                    }else{//若查到的記錄不對，則設定錯誤資訊
                        $error_msg = 'Sorry, you must enter a valid username and password to log in.'."<br>";
                    }
            }else{
                $error_msg = 'Sorry, you must enter a valid username and password to log in.'."<br>";
            }
        }
    }else{//如果使用者已經登入，則直接跳轉到已經登入頁面
        $home_url = 'loged.php';
        header('Location: '.$home_url);

    }
?>

<html>
    <head>
        <title>登入</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/test.css" />
    </head>
    <body style = "background-color:rgb(23, 49, 83);">

        <div style="width: 100%;display: inline-block;text-align: center; ">


    <!-- $_SERVER['PHP_SELF']代表使用者提交表單時，呼叫自身php檔案 -->
            <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div style="width: 100%;display: inline-block;text-align: center;">
                <div class="mobile-box">
             <a href = 'home.html'>
                <img src = 'picture/logo2.png' class="m">
            </a>
            <h3>點名系統</h3>
            


            <!-- 如果使用者已輸過使用者名稱，則回顯使用者名稱 -->
            <!--資料庫  account的大小設為20-->
            <label>帳號</label> <span>User ID</span><br>
            <input  class="input_style" type="text" maxlength="20" id="userID" name="userID" 
            value="<?php if(!empty($user_username)) echo $user_username; ?>" /><br>
            <!--資料庫  password的大小設為10-->
            <label>密碼</label><span>Password</span><br>
            <input  class="input_style" type="password"maxlength="10" id="password" name="password"/><br>
            <!--如果使用者未登入，則顯示登入表單，讓使用者輸入id和密碼-->
            <?=$error_msg;?>
            <input type="submit" value="Log In" name="submit"/>
            </div>
            </div>
    </form>

</div>
</body>

</html>