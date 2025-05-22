<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/2.png" type="image/png" sizes="16x16">
    @vite('resources/css/app.css')
    <title>Attendance</title>
</head>
<body class="bg-gray-200">

    @php
        use Filament\Facades\Filament;
        $user = Filament::auth()->user();
    @endphp
    

</body>