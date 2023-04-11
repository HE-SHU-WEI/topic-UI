# topic
## 流程圖如下


```mermaid
graph 

A[首頁<br>home.html]-->註冊臉部訊息-->進入Face資料夾-->B[記錄username<br>post.php]--> face.html呼叫javascript拍照-->C[路徑記錄在path.txt<br>圖片存在資料夾]-->remix.exe執行辨識轉成128特徵值-->根據username跟時間寫入DB


A --> 登入 --> D[進入登入頁面<br>login.php]-->進入user資料夾 --> E[根據登入的身分切換到不同頁面]

E-->F[管理者介面<br>manager.php]-->I
E-->G[老師介面<br>teacher.php]-->I
E-->H[學生介面<br>student.php]-->I

I[登出<br>logout.php]

```
##以下粗略介紹各檔案的用途

### home.html
**只要進入home.html頁面，session的username就會清除**

### logxx.php
負責登入登出

### set.php
與DB的設定檔在裡面


### Face 資料夾
post.php
登入系統
將使用者的科系年級姓名紀錄，之後用於寫入DB

face.html
呼叫JS資料夾中的webcam.js來拍照

action.php
設定拍照的檔案存取地點

remix.exe
本體是用python做的人臉辨識模型，需要做

CSV.php
將remix.exe的執行結果寫入DB



### user 資料夾
manager.php
管理者介面，可以刪除學生、補點、查詢課程
**新增學生需要在DB匯入，可單筆可多筆**

teacher.php
老師介面，可以補點、查詢課程學生名單、點名情況

student.php
學生介面，可以查詢點名情況






