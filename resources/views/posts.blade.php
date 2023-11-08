<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Posts</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100  antialiased">
<div class="md:container md:mx-auto">
<div id="app"></div>
</div>
@vite('resources/js/app.js')
</body>
</html>
