# Source Code Guide | 鹿村烤吧管理系統

> **2023 年大學資料庫系統團隊專題 — 原始 PHP 程式碼說明**
>
> 本資料夾保存當年開發的程式碼，供作品展示與學習參考。以下功能描述依據原始檔案進行靜態檢查，**不代表已在目前的環境重新部署或測試成功**。

## 1. 技術與執行方式

- **後端：** PHP（混合使用 `MySQLi` 和 `PDO` 存取資料庫）
- **資料庫：** MySQL；資料庫名稱在原始碼中為 `鹿村烤吧管理系統`
- **前端：** HTML、CSS、Bootstrap；部分頁面透過 CDN 載入 JavaScript 套件
- **執行架構：** 瀏覽器 → 支援 PHP 的本機網頁伺服器（例如 Apache）→ MySQL
- **程式入口：** `index.php`

`localhost` 表示 PHP 程式連向執行環境的本機 MySQL，並不是 GitHub 網址。本專案包含當年使用的本機開發設定，並非正式部署範本。

## 2. 原始碼檔案與功能對照

| 類別 | 檔案 | 程式碼實際用途 |
| --- | --- | --- |
| 系統入口 | `index.php` | 顯示首頁，提供原料、商品、訂單、財務四個管理入口 |
| 共用資料庫連線 | `link.php` | 透過 MySQLi 建立 MySQL 連線，供部分頁面 `include` 使用 |
| 原料管理 | `material.php` | 原料管理選單，連到進貨與原料盤點 |
| 原料管理 | `purchase.php` | 查詢原料清單，依輸入的進貨量增加 `原料數量` |
| 原料管理 | `m_count.php` | 顯示目前原料庫存，將指定原料數量更新為盤點後輸入值 |
| 商品管理 | `product.php` | 商品管理選單，連到加工與商品盤點 |
| 商品管理 | `process.php` | 增加已加工的產品數量，依 `原料加工` 表記錄的用量扣減原料庫存 |
| 商品管理 | `p_count.php` | 顯示商品庫存，將指定產品數量更新為盤點後輸入值 |
| 訂單管理 | `order.php` | 訂單管理選單，連到點餐與結帳 |
| 訂單管理 | `desknum.php` | 顯示桌號下拉選單，將選定桌號提交給建立訂單頁面 |
| 訂單管理 | `order_id.php` | 建立訂單編號與訂單紀錄，將訂單資訊存入 Session，接著轉到點餐頁 |
| 訂單管理 | `orderfood.php` | 顯示商品清單；新增點餐紀錄、調整產品庫存並更新訂單總價 |
| 訂單管理 | `pay.php` | 列出當日訂單、訂單金額、時間、狀態，以及檢視明細和結帳入口 |
| 訂單管理 | `detail.php` | 依訂單編號查詢點餐品項、數量，並查詢產品單價 |
| 訂單管理 | `changestate.php` | 將指定訂單狀態更新為「已結帳」，再導回結帳頁 |
| 財務管理 | `finance.php` | 財務管理選單，連到營業額統計 |
| 財務管理 | `money.php` | 統計當日已結帳訂單的數量與總金額 |
| 前端樣式 | `css/` | 原始 CSS 樣式檔；部分 PHP 頁面另使用 Bootstrap CDN |
| 開發設定 | `.vscode/launch.json` | 原專案留存的 VS Code 除錯設定；非系統主要功能 |

## 3. 四大模組與操作流程

### 3.1 原料管理（Ingredient Management）

```text
index.php
  └── material.php
      ├── purchase.php   進貨：原料現有量 + 進貨量
      └── m_count.php    盤點：將原料量改為實際盤點值
```

`purchase.php` 和 `m_count.php` 都會讀取 `原料` 資料表，使用 PDO Prepared Statements 更新指定的 `原料編號`。

### 3.2 商品管理（Product Management）

```text
index.php
  └── product.php
      ├── process.php    加工：增加產品庫存、扣減所需原料
      └── p_count.php    盤點：將產品庫存改為實際盤點值
```

`process.php` 會查詢 `原料加工` 中每種產品所需的原料及 `消耗原料數量`，再依加工數量更新 `原料` 與 `產品` 資料表。這是原始系統中跨資料表更新的主要流程之一。

### 3.3 訂單管理（Order Management）

```text
index.php
  └── order.php
      ├── desknum.php
      │   └── order_id.php  建立訂單，儲存 Session 資訊
      │       └── orderfood.php  新增品項、扣減產品庫存、累加總價
      └── pay.php
          ├── detail.php       查看訂單品項與數量
          └── changestate.php  更新為「已結帳」
```

- `order_id.php` 使用 PHP Session 暫存訂單編號、桌號、狀態與金額，並向 `訂單` 表新增紀錄。
- `orderfood.php` 將品項及數量寫入 `點餐` 表、更新 `產品` 庫存，並將計算後的金額寫回 `訂單` 表。
- `changestate.php` 負責更新訂單狀態；它不是線上金流付款功能。

### 3.4 財務管理（Sales Summary）

```text
index.php
  └── finance.php
      └── money.php  當日已結帳訂單數與營業額
```

`money.php` 使用 `SUM(總價格)` 和 `COUNT(*)` 統計指定日期範圍內狀態為「已結帳」的訂單。

## 4. 程式使用的主要資料表

| 資料表 | 作用 | 原始碼中使用的代表欄位 |
| --- | --- | --- |
| `原料` | 原物料庫存 | `原料編號`、`原料名稱`、`原料數量`、`原料單位` |
| `產品` | 商品資料與庫存 | `產品名稱`、`產品價格`、`產品數量` |
| `原料加工` | 原料與產品之間的用料關係 | `原料編號`、`產品名稱`、`消耗原料數量` |
| `訂單` | 訂單狀態、時間、桌號與總價 | `訂單編號`、`桌號`、`訂單狀態`、`訂單時間`、`總價格` |
| `點餐` | 每張訂單的商品明細 | `訂單編號`、`品項名稱`、`品項數量` |

這是依程式查詢整理的資料表概覽；完整 ER Model 與欄位型態請參考專案報告。**目前原始碼壓縮檔未包含可直接匯入的 `.sql` 資料庫備份。**

## 5. 原始版本與使用限制

本專案保留大學專題時的程式風格，**不應直接部署到公開網路或用於實際營業**。

- 原始碼含有 `localhost`、MySQL `root` 與空密碼等當年的本機測試設定；實際部署時必須改用獨立、低權限的資料庫帳號，且不可公開真實憑證。
- 部分頁面採用 SQL 字串串接（例如 `detail.php`、`changestate.php`、`order_id.php`），需要重新檢查輸入驗證、Prepared Statements、存取控制與 CSRF 防護。
- 部分資料庫操作使用 PDO，另一些使用 MySQLi；尚未進行統一重構。
- `process.php` 和 `orderfood.php` 會進行多步驟資料表更新；原始碼未見完整交易控制與失敗復原機制，可能發生資料不一致問題。
- `order_id.php`、`orderfood.php` 使用 PHP Session；若要重新運行需確認 Session 與舊版 PHP 相容性。
- 原始資料庫匯出檔未隨此程式提供，所以單靠這個 `src/` 資料夾無法完整重現原系統。

**本 README 是對歷史程式碼的說明，不代表上述問題已經修復。**

## 6. 從哪裡開始閱讀？

想快速理解專案，建議依照以下順序閱讀：

1. `index.php`：理解四大模組的首頁入口。
2. `material.php` → `purchase.php`：看原料進貨及庫存數量更新。
3. `product.php` → `process.php`：看加工時如何連動原料與產品庫存。
4. `order.php` → `desknum.php` → `order_id.php` → `orderfood.php`：看建立訂單及點餐資料流。
5. `pay.php` → `detail.php` / `changestate.php`：看訂單明細與結帳狀態。
6. `finance.php` → `money.php`：看每日營業額統計。

若想了解設計動機、ER Model 和系統畫面，請回到專案根目錄的 `README.md` 與 `docs/`。
