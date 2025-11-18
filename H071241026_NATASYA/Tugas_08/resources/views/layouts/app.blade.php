<!DOCTYPE html>
<html>
<head>
    <title>Fish It Roblox</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="navbar">
        <a href="{{ route('fishes.index') }}">🐟 Fish It Roblox</a>
    </div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>