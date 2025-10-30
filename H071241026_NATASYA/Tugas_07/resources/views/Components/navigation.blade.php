<nav>
    <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>Home
    </a>
    <a href="/destinasi" class="{{ Request::is('destinasi') ? 'active' : '' }}">
        <i class="fas fa-map-marked-alt"></i>Destinasi
    </a>
    <a href="/kuliner" class="{{ Request::is('kuliner') ? 'active' : '' }}">
        <i class="fas fa-utensils"></i>Kuliner
    </a>
    <a href="/galeri" class="{{ Request::is('galeri') ? 'active' : '' }}">
        <i class="fas fa-images"></i>Galeri
    </a>
    <a href="/kontak" class="{{ Request::is('kontak') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i>Kontak
    </a>
</nav>