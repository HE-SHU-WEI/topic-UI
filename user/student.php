<?php
//
//  名稱：學生頁面
//  狀態：部份功能
//
//
require_once('C:\xampp\htdocs\topic\conn.php');

session_start();

try {
    if(isset($_SESSION['username'])){
        $n = $_SESSION['username'];
        $y = $_POST['year'];
        $txt =  '你好，'.$_SESSION['username']. '同學<br>';
        $logout =  '<a href="/test/logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        
        $translate = $conn ->prepare("SELECT * , CASE season
                 WHEN 0 THEN '上學期'  
                 else '下學期' 
            END 
            FROM $n
            ORDER BY student_name;");
            $translate ->execute();
            $result = $translate ->fetchAll();

    }else{
        echo '<a href="/test/logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        }
    }catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
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
<style>
table{
    border: 4px solid red;
            padding: 8px;
            padding-bottom: 10px;
            margin: 20px;
            border-collapse:collapse;
}
</style>

<form action="" method="POST">
    <!-- <?=$str;?> -->
    <div>
    <a href ="/test/user_interface/user_interface.html" style="height = 0%">
            <img src = '/test/picture/new.png', class="person_icon" ></a>
    <div style = "margin-bottom:5%;width 10% ;float:left;">
        <?=$txt;?>
        <?=$logout;?>
    </div>
    </div>
    <!-- ------------------------------------選學年 -->
    <div style="width: 100%;display: inline-block;text-align: center;">
        <div class="user-index">選擇學年
        <select name="year" onchange="submit();">
            <?php
                //  $tmp;
                 echo  '<option selected=selected >'. $_POST['year'].'</option>';
                foreach ($result as $row){
                    // $tmp = $row["year"];
                    if ($classname!=$row["year"]){
                        echo '<option name="meal" value="',$row["year"],'"> ',$row["year"],'</option>';
                    };
                        // }$year = $tmp;
                    
                }
            ?>
            </select>
        </div>
        <!-- ---------------------------------- 選要查的-->
        <div style="width: 100%;display: inline-block;text-align: center;">
        <div class="user-index">選擇要查詢的課程
        <select name="class_name" onchange="submit();">
            <?php
                //  $tmp;
                 echo  '<option selected=selected >'. $_POST['class_name'].'</option>';
                 
                    foreach ($result as $row){
                        // $tmp = $row["class_name"];
                        if($row['year']==$_POST['year']){
                                echo '<option name="meal" value="',$row["class_name"],'"> ',$row["class_name"],'</option>';
                            // $classname = $tmp
                            ;}
                        
                    }
            ?>
            </select>
        </div>
        <!-- ------------------------------------------- -->
    </div>
<div style="margin-left: 40%;">
    <table   rules="all"; >
        <tr><th>學年</th><th>課程名稱</th> <th>學期</th></tr>
            <?php
            foreach ($result as $row){
                if ($row['year'] == $_POST['year']){
                    // 讓表格用foreach輸出內容
                    echo  '<tr>'.'<td>'.$row['year'].'</td>'
                                .'<td><a href = "#search?order='.$row['class_name'].'">'.$row['class_name'].'</a></td>'
                                .'<td>'.$row['season'].'</td>'.'</tr>';}}
                                
                                ?>
                                
            
        
    </table>
    
</div>




<!-- 按下查詢課程後 -->

<div id='search'>
    <?php
    $search= $conn ->query("SELECT * FROM `".'點名_'.$_POST['class_name']."` where name='".$_SESSION['username']."'");
        $resultsearch = $search ->fetchAll();

    $table = "<table border=1 id='search'><tr><td>學生ID</td><td>學生姓名</td><td>出席</td><td>心情</td><td>時間</td></tr>"; 
            foreach($resultsearch as $v)
            {
                $table .= "<tr><td>".$v['id']."</td><td>".$v['name']."</td><td>".$v['attend']."</td><td>".$v['mood']."</td><td>".$v['time']."</td></tr>";
            }
            $table .= "</table>";
            echo $table;
    ?>
</div>


</body>
</html>