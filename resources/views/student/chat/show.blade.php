<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ProgressBoard</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/Pages/Chat/index.jsx'])
    @routes
</head>

<body>
    <div id="index" {{-- data-props="{{ json_encode(['data' => $data]) }}" --}}></div>
</body>

</html>
