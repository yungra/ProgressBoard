## Gitのワークフロー
- 基本的にdevelopで開発を進めていく。
- デプロイ時、mainにマージする
- 新規機能開発の時にローカルのdevelopを最新にしてからfeatureブランチを切って開発を進める
  - featureブランチの規則はfeature/issue番号
- バグの修正の時はdevelopからhotfixブランチを切って開発を進める
  - hotfixブランチの規則はhotfix/issue番号

## ダウンロード方法

git clone https://github.com/yungra/ProgressBoard.git

## インストール方法
- cd ProgressBoard
- composer install

.env.example をコピーして .envファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください。

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=progressboard
- DB_USERNAME=sail
- DB_PASSWORD=password

~/.zshrc
に
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
を追記して、sailのエイリアスを作成します。

その後に

sail up

でSailを起動して

sail artisan migrate:fresh --seed

と実行してください。（データベーステーブルとダミーデータが追加されればOK）
