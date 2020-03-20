Laravel 版的留言版，可留言、評論、回覆評論，按讚、收回讚

    
  
 
 ####  1. git clone
 
        git clone https://github.com/Shiva1010/sboard2
      

        
#### 2. 設定 .env

    專案資料夾下
    cp .env.example .env
    
    打開 .env 修改下列設定，符合自己的DB
    
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=使用的DB
    DB_USERNAME=資料庫的使用者名稱
    DB_PASSWORD=資料庫的使用者密碼


    
 #### 3. 終端機（ Terminal ），下指令建立 5 張 table 
 
 建立五張 table（users、boards 、msgs、remsgs）到 Mysql 的 DB (資料庫) 裡
    
        
        php artisan migrate
        
       
       
#### 3. 使用者註冊、登入

位置：index.php

![](https://i.imgur.com/vVNBsyJ.png)



#### 4. 留言板，留言撰寫方式


採用 foreach 方式，迴圈到第三層，呈現留言下的回覆結果，使用 table 內的 boarads_id 及 msg_id 辨識要回覆的文章。

填寫留言方式、返回首頁、登出
![](https://i.imgur.com/lchHd0T.png)

留言顯示方式
![](https://i.imgur.com/XmFxbJ7.png)


#### 5. 按讚，收回讚，查看讚者

按讚，收回讚，查看讚者

![](https://i.imgur.com/EEdJl6f.png)

查看目前讚者有誰

![](https://i.imgur.com/hIDJVk2.png)





