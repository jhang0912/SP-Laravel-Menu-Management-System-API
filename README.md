<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About 「Menu Management System API」
本專案以提供餐廳管理菜單為目標，管理員可利用此系統進行菜單的相關編輯，包含預覽、新增、修改、刪除菜單種類及旗下品項，達到可以即時根據資料庫變更菜單內容。

## 快速入門
|方法|網址|功能說明|是否需登入才可操作|
|--|--|--|--|
|POST|manager|註冊管理員|NO
|POST|manager/signIn|管理員登入|NO
|POST|manager/signOut|管理員登出|YES
|GET|menu|瀏覽菜單|YES|
|POST|menu/store|新增菜單|YES
|POST|menu/update|編輯菜單|YES
|POST|menu/destory|刪除菜單|YES

## 使用說明
- 請求格式必須為 JSON 格式
- 進行與菜單相關的操作時必須先登入會員取得「登入Token」並將其放入Header -> Authoriztion：Bearer 進行身分驗證

### 註冊管理員
|欄位|欄位說明|是否必填|備註|
|--|--|--|--|
|account|帳號|YES|需為 Email 格式|
|password|密碼|YES|長度8~16 / 必須最少包含一個大寫字母、一個小寫字母、一個數字|
|name|姓名|YES||

### 管理員登入
|欄位|欄位說明|是否必填|備註|
|--|--|--|--|
|account|帳號|YES||
|password|密碼|YES||

### 管理員登出
|欄位|欄位說明|是否必填|備註|
|--|--|--|--|
|Header -> Authoriztion：Bearer|登入Token|YES|

### 新增菜單
|欄位|欄位說明|是否必填|備註|
|--|--|--|--|
|name|菜單種類|YES|EX：漢堡|
|toggle|是否上架|YES|只能為0(下架)或1(上架)的數字|
|menuItems|旗下品項|YES|陣列格式|
menuItmes 說明：
|欄位|欄位說明|是否必填|備註|
|name|菜單品項|YES|EX：火腿漢堡|
|price|價錢|YES|必須為正整數|
|toggle|是否上架|YES|只能為0(下架)或1(上架)的數字|

### 編輯菜單
- 此功能會比對資料庫中 itemID 存在而請求中不存在的 itemID ，將不存在的菜單品項刪除

|欄位|欄位說明|是否必填|備註|
|--|--|--|--|
|categoryID|菜單種類ID|YES||
|name|菜單種類|YES|EX：漢堡|
|toggle|是否上架|YES|只能為0(下架)或1(上架)的數字|
|menuItems|旗下品項|YES|陣列格式|
menuItmes 說明：
|欄位|欄位說明|是否必填|備註|
|itemID|菜單品項ID|NO|若有則代表編輯舊有項目，無則代表新增新項目|
|name|菜單品項|YES|EX：火腿漢堡|
|price|價錢|YES|必須為正整數|
|toggle|是否上架|YES|只能為0(下架)或1(上架)的數字|

### 刪除菜單
|欄位|欄位說明|是否必填|備註|
|--|--|--|--|
|categoryID|菜單種類ID|YES||

## 資料庫規劃
<img src="https://i.imgur.com/KTEUs9J.jpg" width="1000">








