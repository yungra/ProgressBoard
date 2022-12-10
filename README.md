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
