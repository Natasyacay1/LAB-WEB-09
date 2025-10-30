<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $data = [
            'title' => 'Explore Polewali Mandar',
            'subtitle' => 'Discover The Hidden Gem',
            'description' => 'Jelajahi keindahan alam yang memukau, kuliner autentik, dan budaya khas Mandar yang akan memberikan pengalaman tak terlupakan dalam setiap petualangan Anda.'
        ];

        return view('home', $data);
    }
    public function destinasi()
    {
        $data = [
            'title' => 'Destinasi Wisata Polewali Mandar',
            'subtitle' => 'Temukan Keindahan Tersembunyi Polewali Mandar',
            'destinasi' => [
                [
                    'nama' => 'Pantai Dato',
                    'gambar' => 'pantaidato.jpg',
                    'lokasi' => 'Majene',
                    'deskripsi' => 'Pantai eksotis dengan pasir putih dan batu karang yang indah. Tempat perfect untuk menikmati sunset dan berfoto dengan pemandangan laut yang memukau.',
                    'jam_operasional' => '24 Jam',
                    'kategori' => 'Pantai',
                    'tag' => 'Populer'
                ],
                [
                    'nama' => 'Air Terjun Sambabo',
                    'gambar' => 'airterjun.jpg',
                    'lokasi' => 'Tapango',
                    'deskripsi' => 'Air terjun yang memukau dengan ketinggian 30 meter, dikelilingi hutan hijau yang asri. Perfect untuk trekking dan menikmati alam.',
                    'jam_operasional' => '07.00-17.00',
                    'kategori' => 'Alam',
                    'tag' => 'Alam'
                ],
                [
                    'nama' => 'Pulau Karampuang',
                    'gambar' => 'pulaukarampuang.jpg',
                    'lokasi' => 'Laut Mandar',
                    'deskripsi' => 'Pulau kecil nan eksotis dengan pantai pasir putih dan air laut biru jernih. Surga tersembunyi untuk snorkeling dan diving.',
                    'jam_operasional' => '24 Jam',
                    'kategori' => 'Pulau',
                    'tag' => 'Eksotis'
                ],
                [
                    'nama' => 'Pantai Mandar',
                    'gambar' => 'pantaimandar.jpg',
                    'lokasi' => 'Polewali',
                    'deskripsi' => 'Pantai dengan ombak yang tenang, cocok untuk berenang dan bersantai. Dikelilingi pepohonan yang rindang dan udara sejuk.',
                    'jam_operasional' => '06.00-18.00',
                    'kategori' => 'Pantai',
                    'tag' => 'Tenang'
                ],
                [
                    'nama' => 'Taman Laut Dewata',
                    'gambar' => 'tamanlautdewata.jpg',
                    'lokasi' => 'Perairan Mandar',
                    'deskripsi' => 'Spot snorkeling dan diving dengan terumbu karang yang masih alami dan ikan-ikan warna-warni. Keindahan bawah laut yang memesona.',
                    'jam_operasional' => '08.00-16.00',
                    'kategori' => 'Laut',
                    'tag' => 'Snorkeling'
                ],
                [
                    'nama' => 'Bukit Puncak Indah',
                    'gambar' => 'puncakindahdewata.jpg',
                    'lokasi' => 'Wonomulyo',
                    'deskripsi' => 'Spot terbaik untuk menikmati panorama Polewali Mandar dari ketinggian. Tempat perfect untuk melihat sunrise dan sunset.',
                    'jam_operasional' => '24 Jam',
                    'kategori' => 'Bukit',
                    'tag' => 'Panorama'
                ]
            ]
        ];

        return view('destinasi', $data);
    }
    public function kuliner()
    {
        $data = [
            'title' => 'Kuliner Khas Polewali Mandar',
            'subtitle' => 'Jelajahi Cita Rasa Autentik Khas Mandar',
            'kuliner' => [
                [
                    'nama' => 'Jepa',
                    'gambar' => 'jepa.jpeg',
                    'deskripsi' => 'Makanan khas Mandar dari singkong yang diolah dengan cara tradisional. Biasanya disajikan dengan ikan bakar atau sayuran.',
                    'harga' => 'Rp 15.000 - 30.000',
                    'kategori' => 'Makanan',
                    'tag' => 'Tradisional',
                    'rating' => 4.5
                ],
                [
                    'nama' => 'Peca Ikan Bandeng',
                    'gambar' => 'ikanpecca.jpg',
                    'deskripsi' => 'Ikan bandeng yang dimasak dengan bumbu kuning khas Mandar. Rasanya gurih dan segar, cocok dengan nasi hangat.',
                    'harga' => 'Rp 25.000 - 40.000',
                    'kategori' => 'Seafood',
                    'tag' => 'Seafood',
                    'rating' => 5
                ],
                [
                    'nama' => 'Sanggara Balanda',
                    'gambar' => 'sanggarabalanda.jpg',
                    'deskripsi' => 'Makanan tradisional dari jagung dengan cita rasa khas. Biasanya disajikan saat acara adat dan perayaan penting.',
                    'harga' => 'Rp 15.000 - 25.000',
                    'kategori' => 'Tradisional',
                    'tag' => 'Unik',
                    'rating' => 5
                ],
                [
                    'nama' => 'Baupeapi',
                    'gambar' => 'baupeapi.jpg',
                    'deskripsi' => 'Ikan laut segar yang dimasak dengan bumbu asam pedas khas Mandar. Sangat segar dan cocok untuk pecinta seafood.',
                    'harga' => 'Rp 30.000 - 50.000',
                    'kategori' => 'Seafood',
                    'tag' => 'Pedas',
                    'rating' => 4.5
                ],
                [
                    'nama' => 'Sarabba',
                    'gambar' => 'sarabba.jpg',
                    'deskripsi' => 'Minuman tradisional khas Mandar dari jahe, gula merah, dan santan. Sangat cocok dinikmati saat cuaca dingin.',
                    'harga' => 'Rp 8.000 - 15.000',
                    'kategori' => 'Minuman',
                    'tag' => 'Hangat',
                    'rating' => 5
                ],
                [
                    'nama' => 'Kue Tori',
                    'gambar' => 'kuetori.jpg',
                    'deskripsi' => 'Kue tradisional dari beras ketan dengan rasa manis gurih. Sering disajikan dalam acara adat dan sebagai oleh-oleh.',
                    'harga' => 'Rp 20.000 - 35.000',
                    'kategori' => 'Snack',
                    'tag' => 'Manis',
                    'rating' => 4.5
                ]
            ]
        ];

        return view('kuliner', $data);
    }
    public function galeri()
    {
        $data = [
            'title' => 'Galeri Polewali Mandar',
            'subtitle' => 'Momen Indah yang Mengabadikan Pesona Bumi Mandar',
            'galeri' => [
                [
                    'gambar' => 'pemandangan1.jpg',
                    'judul' => 'Sunset Pantai',
                    'deskripsi' => 'Momen indah sunset di Pantai Dato dengan pemandangan laut yang memukau'
                ],
                [
                    'gambar' => 'tarianmandar.jpg',
                    'judul' => 'Tari Tradisional',
                    'deskripsi' => 'Kekayaan budaya Mandar dalam tarian tradisional'
                ],
                [
                    'gambar' => 'sayyangpattuduu.jpeg',
                    'judul' => 'Sayyang Pattudu',
                    'deskripsi' => 'Sayyang Pattudu adalah kuda yang menari mengikuti irama musik tradisional Mandar'
                ],
                [
                    'gambar' => 'rumahadatmandar.jpg',
                    'judul' => 'Rumah Adat Mandar',
                    'deskripsi' => 'Rumah Adat Mandar dengan arsitektur khas yang unik'
                ],
                [
                    'gambar' => 'lopisandeq.jpeg',
                    'judul' => 'Lopi Sandeq',
                    'deskripsi' => 'Perahu tradisional Mandar yang melaju cepat di atas ombak'
                ],
                [
                    'gambar' => 'lipasabbe.jpg',
                    'judul' => 'Lipa Sabbe - Sarung Sabbe',
                    'deskripsi' => 'Sarung tradisional Mandar dengan motif khas yang melambangkan identitas budaya'
                ],
                [
                    'gambar' => 'bajuadat.jpg',
                    'judul' => 'Baju Adat Mandar',
                    'deskripsi' => 'Pakaian tradisional Mandar yang dikenakan pada acara adat dan perayaan penting'
                ],
                [
                    'gambar' => 'gulamandar.jpeg',
                    'judul' => 'Gula Aren Khas Mandar',
                    'deskripsi' => 'Gula aren tradisional yang diolah secara alami dari nira pohon enau'
                ],
                [
                    'gambar' => 'pa,rabbana.jpg',
                    'judul' => 'Parabbana',
                    'deskripsi' => 'Pemain dengan gendang rabbana dipadu dengan sayyang pattudu'
                ]
            ]
        ];

        return view('galeri', $data);
    }
    public function kontak()
    {
        $data = [
            'title' => 'Hubungi Kami',
            'subtitle' => 'Kami Siap Membantu Perjalanan Wisata Anda',
            'kontak' => [
                'alamat' => 'Jl. Poros Majene - Polewali, Polewali Mandar, Sulawesi Barat',
                'telepon' => ['+62 812 3456 7890', '+62 813 4567 8901'],
                'email' => ['info@explorepolman.com', 'tour@explorepolman.com'],
                'jam_operasional' => 'Senin - Minggu: 08.00 - 17.00 WITA'
            ]
        ];

        return view('kontak', $data);
    }
}