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

if (strcasecmp($captcha, $_SESSION['captch_code']) !== 0) {
    echo "驗證碼錯誤";
    exit();
}
if (!$result) {
    echo "儲存圖片失敗";
    exit();
}

$url_raw = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'])  . $picture_name;
$url = str_replace('\\', '/', $url_raw);
echo "上傳成功 \n" . "圖片路徑:" . $url;


?>


<?php
session_start();//必須處於程式頂部

$width = 100;
$height = 30;
$image = imagecreatetruecolor($width,$height);    // 生成100*30的底圖
$black = imagecolorallocate($image,0,0,0);        // 黑色
$bgcolor = imagecolorallocate($image,255,255,255);// write
imagefill($image,0,0,$bgcolor);                   // 填充背景

$captch_code = "";//用於記錄驗證碼內容

//生成4位隨機驗證碼內容
for($i=0;$i<4;$i++){
    $fontsize = 6;
    $fontcolor = imagecolorallocate($image,rand(0,100),rand(0,100),rand(0,100));//驗證碼顏色深
    $data = 'abcdefghijkmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $fontcontent = substr($data,rand(0,strlen($data)-1),1);//從$data物件中隨機獲取一個字元
    $captch_code .= $fontcontent;
    $x = ($i*100/4)+rand(5,10);
    $y = rand(5,15);//設定驗證碼位置
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
$_SESSION['captch_code'] = $captch_code;

for($i<0;$i<200;$i++){
    //增加干擾點
    $pointcolor = imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));//干擾點顏色淺
    imagesetpixel($image,rand(1,$width-1),rand(1,$height-1),$pointcolor);
}

for($i=0;$i<3;$i++){
    //增加干擾線
    $linecolor = imagecolorallocate($image,rand(100,200),rand(100,200),rand(100,200));//干擾線顏色更淺
    imageline($image,rand(1,$width-1),rand(1,$height-1),rand(1,$width-1),rand(1,$height-1),$linecolor);
}

header('Content-Type:image/png');
imagepng($image);     // 輸出影像
imagedestroy($image); // end銷燬圖片

?>