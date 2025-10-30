<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Polewali Mandar</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @if (Request::is('/'))
    <div class="bg-image"></div>
    @endif

    <div class="overlay">
        <header>
            <h2 class="logo">Explore Polman</h2>
            <x-navigation />
        </header>

        <main class="content">
            @yield('content')
        </main>

        <footer>
            &copy; {{ date('Y') }} Explore Polewali Mandar — All Rights Reserved.
        </footer>
    </div>
    <script>
        const elements = document.querySelectorAll('.fade-in');
        const appearOnScroll = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.1
        });
        elements.forEach(el => {
            appearOnScroll.observe(el);
        });
    </script>
</body>
</html>