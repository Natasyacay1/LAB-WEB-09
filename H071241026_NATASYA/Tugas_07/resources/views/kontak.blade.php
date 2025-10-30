@extends('layouts.master')

@section('content')
<section class="kontak-page fade-in">
    <h1 class="kontak-title"><i class="fas fa-envelope"></i>{{ $title }}</h1>
    <p class="kontak-subtitle">{{ $subtitle }}</p>

    <div class="kontak-container">
        <div class="kontak-info">
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h3>Alamat Kantor</h3>
                    <p>{{ $kontak['alamat'] }}</p>
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-phone"></i>
                <div>
                    <h3>Telepon/WhatsApp</h3>
                    @foreach($kontak['telepon'] as $telp)
                    <p>{{ $telp }}</p>
                    @endforeach
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h3>Email</h3>
                    @foreach($kontak['email'] as $email)
                    <p>{{ $email }}</p>
                    @endforeach
                </div>
            </div>
            <div class="info-item">
                <i class="fas fa-clock"></i>
                <div>
                    <h3>Jam Operasional</h3>
                    <p>{{ $kontak['jam_operasional'] }}</p>
                    <p>Layanan darurat 24 jam tersedia</p>
                </div>
            </div>
        </div>

        <div class="kontak-form">
            <h3><i class="fas fa-paper-plane"></i> Form Pertanyaan</h3>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="tel" placeholder="Nomor Telepon">
                </div>
                <div class="form-group">
                    <select required>
                        <option value="">Pilih Subjek</option>
                        <option value="wisata">Informasi Wisata</option>
                        <option value="tour">Pemesanan Tour</option>
                        <option value="hotel">Rekomendasi Hotel</option>
                        <option value="kuliner">Tour Kuliner</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea placeholder="Pesan Anda" rows="5" required></textarea>
                </div>
                <button type="submit"><i class="fas fa-paper-plane"></i> Kirim Pesan</button>
            </form>
        </div>
    </div>

    <div class="kontak-social">
        <h3>Ikuti Kami</h3>
        <div class="social-icons">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</section>
@endsection