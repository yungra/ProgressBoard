## ProgressBoard

学習塾の講師が担当する生徒の授業内容をまとめ、一元管理するためのアプリです。  
授業の内容を指導報告書としてまとめることを主な目的として、生徒や講師の管理や、チャット機能、アンケート機能なども実装しています。  

<img width="1266" alt="スクリーンショット 2023-01-26 9 12 56" src="https://user-images.githubusercontent.com/110993223/214723296-cf910d57-1d9d-4142-af73-2e2ae0b8b7e0.png">


## URL
https://www.progressboard.net/

## ログイン情報
### 生徒ログイン  
Email:student1@test.com  
Password:password123  

### 講師ログイン
Email:teacher1@test.com  
Password:password123  

管理者ログイン:  
Email:admin@test.com  
Password:password123  

## 使用技術
- PHP 8.1.13  
- Laravel 9.40.1  
Laravel Sailを使うことによる、環境構築の容易性。  
- Composer 2.5.1  
- Vite 4.0.4  
- npm 9.2.0  
- Node.js 18.12.1  
- React 18.2.0  
最も流行っているフロントエンドフレームワークであり、Vue.jsよりもできる幅が広く、その分難しいと聞き、これを習得することによってよりフロントエンドの力がつくと思ったから
- Chakura UI 2.4.9  
- React Icons 4.7.1  
- tailwindcss 3.2.4  
- AWS(Lightsail)
GCPと並び、デプロイのデファクトスタンダードだから。

## 機能一覧
- ログイン機能  
- 指導報告書のCRUD機能  
- 生徒情報一覧（担当講師のハイライト）  
- 講師情報一覧（担当制とのハイライト）  
- ペジネーション機能  
- 生徒、講師のチャット機能
- マイページ編集機能  
- アイコン画像設定機能
- 生徒、講師へのお知らせ機能  
- アンケート機能  
- 宿題機能  

## Gitのワークフロー
- 基本的にdevelopで開発を進めていく。
- デプロイ時、mainにマージする
- 新規機能開発の時にローカルのdevelopを最新にしてからfeatureブランチを切って開発を進める
  - featureブランチの規則はfeature/issue番号
- バグの修正の時はdevelopからhotfixブランチを切って開発を進める
  - hotfixブランチの規則はhotfix/issue番号

## インストール方法

```
git clone https://github.com/yungra/ProgressBoard.git
cd ProgressBoard
composer install
```

.env.example をコピーして .envファイルを作成
```
cp .env.example .env
```


## sailのエイリアスを登録

~/.zshrcに下記を追記
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```


## sailを起動
```
sail up
```

## アプリケーションキーの生成
```
sail artisan key:generate
```


## データベースのマイグレーション
```
sail artisan migrate
sail artisan migrate:fresh --seed
```


## フロントエンドのビルド
```
sail npm install
sail npm run dev
```

これで

http://localhost

にアクセスして、表示確認してください。
