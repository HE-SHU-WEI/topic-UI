<?php
session_start(); //必須處於程式頂部
// 儲存的圖片檔名
$path = $_SESSION['username'] ;
$now = date('YmdHis');
$picture_name = 'C:/Users/User/Desktop/face/'. $path . "_" . $now . '.jpg';

// 儲存圖片
$result       = move_uploaded_file($_FILES['webcam']['tmp_name'], $picture_name);
// move_uploaded_file(要移動的文件,文件新位置)
// $_FILES['webcam'] = C:\xampp\tmp
// 新位置要用一個$包起來

echo $_FILES['webcam']['tmp_name'];

if (!$result) {
    echo "儲存圖片失敗";
    exit();
}
echo "上傳成功 \n" . "圖片路徑: " . $picture_name;


 
//打开一个文件，给文件追加内容
 
//追加(append)方式打开path.txt文件，"a"表示文件不在会自动创建
$fp = fopen('C:/Users/User/Desktop/path.txt','a');  
 
//给文件写入内容
fwrite($fp,$picture_name."\n");
 
//关闭文件
fclose($fp);
 
?>