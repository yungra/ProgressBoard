## Gitのワークフロー
- 基本的にdevelopで開発を進めていく。
- デプロイ時、mainにマージする
- 新規機能開発の時にローカルのdevelopを最新にしてからfeatureブランチを切って開発を進める
  - featureブランチの規則はfeature/issue番号
- バグの修正の時はdevelopからhotfixブランチを切って開発を進める
  - hotfixブランチの規則はhotfix/issue番号
