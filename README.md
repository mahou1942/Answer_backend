# 題目解答

該項目僅為回答考題使用！


### 技術：
```
    後端：Laravel8 + Php8（題目一、二、三皆有使用）
    前端：Vue3 + Vite（僅題目三用到）
```


### 環境安裝

後端
```
Composer require

Php artisan serve

running on port 8000

```

前端
```
npm install

npm run dev

or

yarn

yarn run dev

running on port 8080

```


以上答案皆完成 Unit Test or Feature Test，下圖為Test的Coverage（詳細可至Reports中查看）

![](https://i.imgur.com/gjOBb2m.png)



唯一沒有覆蓋到的是這一段程式碼，因為這邊只是簡單寫一下失敗的概念，但因題目沒有要實現失敗，故就沒有寫update裡面回傳False的事件，所以無法測試到這塊。

![](https://i.imgur.com/EJZnLDt.png)


---

測試程式碼細節實踐（詳細可至Test查閱）
![](https://i.imgur.com/XeJKVvA.png)

![](https://i.imgur.com/SDDgfQI.png)
