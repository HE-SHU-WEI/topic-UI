<?php

require_once('..\set.php');
session_start();

// $_SESSION['username'] = '楊瑞賓';


# 設定時區
date_default_timezone_set('Asia/Taipei');

# 取得日期與時間（新時區）
$now = date('Y/m/d H:i:s');
//補點名用

try {
    if(isset($_SESSION['username'])){
        $n = $_SESSION['username'];
        if(empty($_POST['year']))$_POST['year']= 110;
        $y = $_POST['year'];
        
        $txt =  '你好，'.$_SESSION['username']. '管理者<br>';
        $logout =  '<a href="../logOut.php"> Log Out('.$_SESSION['username'].')</a>';
        
        $translate = $conn ->prepare("SELECT * FROM `$n`");
            $translate ->execute();
            $result = $translate ->fetchAll();

    }else{
        echo '<a href="../logOut.php"> Log Out('.$_SESSION['username'].')</a>';
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
    <title>管理員系統</title>
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
    <a href ="/test/user_interface/user_interface.html" style="height:0%;">
            <img src = '/test/picture/new.png', class="person_icon" ></a>
    <div style = "margin-bottom:5%;width:10%;float:left;">
        <?=$txt;?>
        <?=$logout;?>
    </div>
    </div>
    <!-- ------------------------------------選學年 -->
    <div style="width: 100%;display: inline-block;text-align: center;">
        <div class="user-index">選擇學年
        <select name="year" onchange="submit();">
            <?php
                
                 echo  '<option selected=selected >'. $_POST['year'].'</option>';
                foreach ($result as $row){
                    
                    if ($classname!=$row["year"]){
                        echo '<option name="meal" value="',$row["year"],'"> ',$row["year"],'</option>';
                    };
                    
                    
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
                 if(!empty($_POST['class_name']))$_SESSION['class_name'] = $_POST['class_name'];
                 
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
                                .'</tr>';}}
                                
                                ?>
                                
            
        
    </table>


    <br>
    <form method='POST' action=''>
    <input type='text' name='check_id' placeholder='請輸入學號'/>
    <input type='text' name='check_week' placeholder='請輸入週數'/>
    <button type='submit'>補點</button>
    </form>

    <br>
    <form method='POST' action=''>
    <input type='text' name='delete_id' placeholder='請輸入學號'/>
    <button type='submit'>刪除學生</button>
    </form>
</div>


<?php

$classname = $_SESSION['class_name'];

if(!empty($_POST['check_id']))
{
    $check_id = $_POST['check_id'];

    if(empty($_POST['check_week']))$_POST['check_week'] = 1 ;
    $check_week = $_POST['check_week'];

    

    $check = $conn ->query("
                            UPDATE `$classname` SET `attend$check_week` ='$now' WHERE `id`='$check_id'
                            ");
    $check -> execute();
}


//-----------------------------------------------------------------

if(!empty($_POST['delete_id']))
{
    $delete_id = $_POST['delete_id'];
    
    $delete = $conn ->query("
                            DELETE FROM `$classname` WHERE `id`='$delete_id'
                            ");
    $delete -> execute();
}

?>



<!-- 按下查詢課程後 -->

<div id='search'>
    <?php
    if(!empty($_POST['class_name']))//判斷是否有查詢classname
    {   
        
        $classname = $_POST['class_name'];
        //if attendN 是null 則顯示缺席
        $search= $conn ->query("SELECT * ,
        IFNULL(attend1 ,'缺席') as attend1,
        IFNULL(attend2 ,'缺席') as attend2,
        IFNULL(attend3 ,'缺席') as attend3,
        IFNULL(attend4 ,'缺席') as attend4,
        IFNULL(attend5 ,'缺席') as attend5,
        IFNULL(attend6 ,'缺席') as attend6,
        IFNULL(attend7 ,'缺席') as attend7,
        IFNULL(attend8 ,'缺席') as attend8,
        IFNULL(attend9 ,'缺席') as attend9,
        IFNULL(attend10,'缺席') as attend10,
        IFNULL(attend11,'缺席') as attend11,
        IFNULL(attend12,'缺席') as attend12,
        IFNULL(attend13,'缺席') as attend13,
        IFNULL(attend14,'缺席') as attend14,
        IFNULL(attend15,'缺席') as attend15,
        IFNULL(attend16,'缺席') as attend16,
        IFNULL(attend17,'缺席') as attend17,
        IFNULL(attend18,'缺席') as attend18

        FROM `$classname`
        ");

        


        $search -> execute();
        $resultsearch = $search ->fetchAll();

    $table = "<table border=1 id='search'>
                <tr>
                <td>name    </td>
                <td>id      </td>
                <td>major   </td>
                <td>grade   </td>
                <td>attend1 </td>
                <td>attend2 </td>
                <td>attend3 </td>
                <td>attend4 </td>
                <td>attend5 </td>
                <td>attend6 </td>
                <td>attend7 </td>
                <td>attend8 </td>
                <td>attend9 </td>
                <td>attend10</td>
                <td>attend11</td>
                <td>attend12</td>
                <td>attend13</td>
                <td>attend14</td>
                <td>attend15</td>
                <td>attend16</td>
                <td>attend17</td>
                <td>attend18</td>
                </tr>"; 
            foreach($resultsearch as $v)
            {
                $table .= "<tr>
                <td>".$v['name']."</td>
                <td>".$v['id']."</td>
                <td>".$v['major']."</td>
                <td>".$v['grade']."</td>
                <td>".$v['attend1']."</td>
                <td>".$v['attend2']."</td>
                <td>".$v['attend3']."</td>
                <td>".$v['attend4']."</td>
                <td>".$v['attend5']."</td>
                <td>".$v['attend6']."</td>
                <td>".$v['attend7']."</td>
                <td>".$v['attend8']."</td>
                <td>".$v['attend9']."</td>
                <td>".$v['attend10']."</td>
                <td>".$v['attend11']."</td>
                <td>".$v['attend12']."</td>
                <td>".$v['attend13']."</td>
                <td>".$v['attend14']."</td>
                <td>".$v['attend15']."</td>
                <td>".$v['attend16']."</td>
                <td>".$v['attend17']."</td>
                <td>".$v['attend18']."</td>
                </tr>";
            }
            $table .= "</table>";
            echo $table;

            
    }
    
    ?>
</div>


</body>
</html>