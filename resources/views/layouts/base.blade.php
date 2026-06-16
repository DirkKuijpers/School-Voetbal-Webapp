<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schoolvoetbal</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    @auth
        <x-navbar-logged />
    @else
        <x-navbar-not-logged />
    @endauth

    <main class="container">
        {{ $slot }}
    </main>

</body>
</html>
