<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="images/2.png" type="image/png" sizes="16x16">
        @vite('resources/css/app.css')
        <title>{{ $title ?? 'SMKPATRIOTNUSANTARA' }}</title>
    </head>
    <body class="bg-gray-200">
        {{ $slot }}
    </body>
</html>