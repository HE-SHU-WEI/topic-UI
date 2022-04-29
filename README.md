# topic
基本上是以home.html為出發點
```mermaid
graph 
A[home.html]-->B[註冊臉部訊息] --> C[進入Face資料夾]-->D[post.php <br> session username紀錄]--> E[face.html拍照<br>根據username跟時間來記錄]-->F[路徑記錄在path.txt<br>圖片存在資料夾]
A --> 登入
```
**只要進入home.html頁面，session的username就會清除**
