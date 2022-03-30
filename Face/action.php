<?php
session_start(); //必須處於程式頂部
// $_SESSION['username'] = '何書瑋';
echo $_SESSION['username'];
// 儲存的圖片檔名
$path = $_SESSION['username'] ;
$picture_name = 'C:/xampp/htdocs/topic/Face/'. $path . "_" . time() . '.jpg';
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


//C:\Users\User\Desktop\text\data\data_faces_from_camera\person_1_liu\

// $url_raw = 'C:\Users\User\Pictures\Saved Pictures' ;
// $url = str_replace('\\', '/', $url_raw);
// echo "上傳成功 \n" . "圖片路徑:" . $url;
echo "上傳成功 \n" . "圖片路徑:";