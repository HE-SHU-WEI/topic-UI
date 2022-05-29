<?php



require_once('..\set.php');

$text = $conn->prepare("SELECT `CSV` FROM `資通三年級` WHERE `id`='A108510347'");
$text ->execute();
$result = $text ->fetchAll();

foreach ($result as $row){
        // 讓表格用foreach輸出內容
        echo  '<tr>'.'<td>'.$row['CSV'].'</td>'
                
                    .'</tr>';}
                    
                    
?>