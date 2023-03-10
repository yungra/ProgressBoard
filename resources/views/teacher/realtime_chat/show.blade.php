<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ProgressBoard</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/index.jsx'])
    @routes
</head>

<body>
    <div id="index" data-props="{{ json_encode(['chat_room' => $chat_room, 'is_student' => 0]) }}"></div>
</body>

</html>
