<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatシステム</title>

    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
    <div class="app">
        <header>
            <h1>Let's Talk!</h1>
            <input type="text" name="username" id="username" placeholder="名前を入れてください…" />
        </header>

        <div id="messages"></div>

        <form id="message_form">
            <input type="text" name="message" id="message_input" placeholder="入力してください…" />
            <button type="submit" id="message_send">送信</button>
        </form>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
