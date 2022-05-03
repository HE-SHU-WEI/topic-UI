<?php
session_start(); //必須處於程式頂部
// 儲存的圖片檔名
$path = 'C:/Users/User/Desktop/face/';
$name = $_SESSION['username'] ;
$now = date('YmdHis');
// $picture_name = $path . $name . "_" . $now . '.jpg';

if (!file_exists($path . $name)) //檢查Username資料夾是否存在於指定path
{
    $picture_name = $path . $name . "/" . $now . '.jpg';
    mkdir($path . $name, 0777, true);
    // 儲存圖片
    $result   = move_uploaded_file($_FILES['webcam']['tmp_name'], $picture_name);

}

// 儲存圖片
// $result   = move_uploaded_file($_FILES['webcam']['tmp_name'], $picture_name);
// move_uploaded_file(要移動的文件,文件新位置)
//$_FILES['webcam']是在webcam.js定義的檔案名稱
//$_FILES["file"]["tmp_name"]：上傳檔案後的暫存資料夾位置。
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