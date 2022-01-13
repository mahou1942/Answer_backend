# 題目二：解題說明

---

## 目錄
1. 答案展示
2. 程式架構設計（UML） 
3. 解題思路
4. 為什麼沒用SplSubject, SplObserver實作？
5. 總結

---
### 答案展示

2-1答
*     路徑：App\Http\Controllers\Question2\Q2_1.php
![](https://i.imgur.com/lPhI6eh.gif)


2-2答
*     路徑：App\Http\Controllers\Question2\Q2_2.php
![](https://i.imgur.com/N3FKtno.gif)

---
### 程式架構設計（UML）

2-1
![](https://i.imgur.com/OLXdTLc.png)


2-2（Product增加attach()、detach()，以及增加一個Shopee的Object）
![](https://i.imgur.com/u5kLzET.png)

```
UML說明：

Product：
    參數：
        Subscribers：所有訂閱電商平台的清單（紀錄平台物件）
        faildUpdateSubscribers：每次發佈商品時，電商平台發生錯誤紀錄清單
        news：商品更新資訊
    方法：
        publish：發佈商品資訊給電商平台
        attach：增加訂閱電商平台
        detach：減少特定訂閱電商平台
        getNews：取得商品更新資訊
    
Platform：電商平台介面
    方法：
        update：取得本次發佈的產品物件，從裡面可以取到產品的更新資訊（=news）

```

---

### 解題思路
首先針對這題，**需要先具備OOP的設計概念**（如果不具備OOP，就會使用大量的if...else or switch進行處理，但並非一個好的設計），我們想像有一個產品管理物件（類似海上燈台）的物件，同時有要跟訂閱者，例如Yahoo、露天等不同平台的物件，彼此之間要進行交互。

交互的情境就是產品管理物件去呼叫Yahoo跟它說產品發布囉！並且Yahoo收到產品管理物件的訊息後，回傳：「Yahoo已收到商品發布通知」。

於是就能設計出這樣的UML圖：
![](https://i.imgur.com/4zIfeTg.png)

Product作為產品管理物件，會去依賴Yahoo的物件，但我們平台有多個，Yahoo只是其中一個平台，於是在稍微改一下，最終會變成這樣：
![](https://i.imgur.com/OLXdTLc.png)

特別增加faildUpdateSubscribers，用於本次Publish時，假設Publish失敗可以把失敗的電商名單儲存起來，以便進行後續處理。


上面2-1解答完，接下來2-2中告訴我們需要臨時新增電商平台跟移除電商平台，此時如何在最少動到架構情況下，把這個需求處理掉呢？

實際上我們上面設計的架構是不用動的，**但我們需要有一個方法去更新Prdouct的Subscribers**。

廢話不多說，直接上答案！

![](https://i.imgur.com/u5kLzET.png)

**只要補上attach　跟　detach的方法就可以了！**


而這就是所謂的**觀察者模式（Observer Pattern)**！


---
### 為什麼沒用SplSubject, SplObserver實作？

網上很多實踐的物件是去實作SplSubject, SplObserver，在討論上述例子為什麼不用前，**先看看這兩個Object裡面賣的是什麼葫蘆。**

![](https://i.imgur.com/sjyK60C.png)

![](https://i.imgur.com/OzuZJGX.png)

**哦！原來就是語法糖的概念！**

用SplSubject 跟 SplObserver實作Observer Pattern的好處就是，只要你是PHP的工程師，看到不同系統實作這個，**那麼就能瞬間知道這邊用了Observer Pattern的架構。**

那麼壞處是什麼？**假設有一些客製化需求出現時，並且又希望子類別實作時，身為Interface的父類別可能就沒有那麼有彈性了......**

舉例來說**題目二規定的是用Publish來進行發佈，如果選擇實作SplSbuject，那麼就只能notify來提醒，或者實作時把notify留空，另外實作一隻Publish，或者直接違反題目要的意思，直接->notify。**

故此，這邊我**採用自行的設計，對於未知的需求擴展性也會更好**，當然必須得補上文檔或註解，讓人一看就知道這麼是採什麼設計，增加可讀性。

以上為個人簡單思考後的理解，若有錯誤都歡迎指正！


---
### 總結

Design Pattern的世界中沒有絕對一定要長什麼樣的設計，只是給一個模板讓RD們參考，像是Java很多源碼中的設計，其實跟一開始我們所學習的設計模式的設計都長得不太一樣一一

**重點在於，到底我們要解決什麼樣的問題，最後才是用什麼樣的手段！**

