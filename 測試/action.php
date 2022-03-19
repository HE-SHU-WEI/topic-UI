<?php
session_start(); //必須處於程式頂部
// 驗證碼
$captcha      = trim($_GET['captcha']);
// 圖片字首
$pre          = trim($_GET['pre']);
// 儲存的圖片路徑
$picture_name = 'picture/' . $pre . "_" . time() . '.jpg';
// 儲存圖片
$result       = move_uploaded_file($_FILES['webcam']['tmp_name'], $picture_name);

if (!$result) {
    echo "儲存圖片失敗";
    exit();
}

$url_raw = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])  . $picture_name;
$url = str_replace('\\', '/', $url_raw);
echo "上傳成功 \n" . "圖片路徑:" . $url;


?>