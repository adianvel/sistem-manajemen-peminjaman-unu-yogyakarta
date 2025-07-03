<?php $pageTitle = 'Bantuan & FAQ'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="text-center mb-4">Bantuan & FAQ</h1>
                    <p class="text-muted text-center mb-5">
                        Temukan jawaban untuk pertanyaan umum dan panduan penggunaan sistem
                    </p>

                    <!-- Quick Links -->
                    <div class="quick-links mb-5">
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <a href="#account" class="quick-link-card">
                                    <i class="fas fa-user-circle"></i>
                                    <span>Akun</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#booking" class="quick-link-card">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Peminjaman</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#products" class="quick-link-card">
                                    <i class="fas fa-laptop"></i>
                                    <span>Produk</span>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#rooms" class="quick-link-card">
                                    <i class="fas fa-door-open"></i>
                                    <span>Ruangan</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Search FAQ -->
                    <div class="search-faq mb-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control border-start-0" 
                                   id="searchFAQ" 
                                   placeholder="Cari pertanyaan..."
                                   onkeyup="filterFAQ()">
                        </div>
                    </div>

                    <!-- Account FAQ -->
                    <section id="account" class="mb-5">
                        <h5>Akun & Registrasi</h5>
                        <div class="accordion" id="accountAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account1">
                                        Bagaimana cara mendaftar akun baru?
                                    </button>
                                </h2>
                                <div id="account1" class="accordion-collapse collapse" data-bs-parent="#accountAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Klik tombol "Daftar" di halaman utama</li>
                                            <li>Isi formulir dengan data yang valid</li>
                                            <li>Gunakan email institusi (@unu-jogja.ac.id)</li>
                                            <li>Baca dan setujui syarat & ketentuan</li>
                                            <li>Klik tombol "Daftar" untuk menyelesaikan</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account2">
                                        Bagaimana jika lupa password?
                                    </button>
                                </h2>
                                <div id="account2" class="accordion-collapse collapse" data-bs-parent="#accountAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Klik "Lupa Password" di halaman login</li>
                                            <li>Masukkan email terdaftar</li>
                                            <li>Cek email untuk link reset password</li>
                                            <li>Ikuti instruksi di email</li>
                                            <li>Buat password baru</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account3">
                                        Bagaimana cara mengubah profil?
                                    </button>
                                </h2>
                                <div id="account3" class="accordion-collapse collapse" data-bs-parent="#accountAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Login ke akun Anda</li>
                                            <li>Klik menu "Profil"</li>
                                            <li>Klik tombol "Edit Profil"</li>
                                            <li>Ubah informasi yang diinginkan</li>
                                            <li>Simpan perubahan</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Booking FAQ -->
                    <section id="booking" class="mb-5">
                        <h5>Peminjaman</h5>
                        <div class="accordion" id="bookingAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#booking1">
                                        Bagaimana cara mengajukan peminjaman?
                                    </button>
                                </h2>
                                <div id="booking1" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Login ke akun Anda</li>
                                            <li>Pilih produk/ruangan yang tersedia</li>
                                            <li>Klik tombol "Pinjam"/"Booking"</li>
                                            <li>Isi form peminjaman</li>
                                            <li>Tunggu persetujuan admin</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#booking2">
                                        Berapa lama proses persetujuan?
                                    </button>
                                </h2>
                                <div id="booking2" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Proses persetujuan biasanya memakan waktu maksimal 1x24 jam pada hari kerja. 
                                            Anda akan menerima notifikasi email saat peminjaman disetujui atau ditolak.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#booking3">
                                        Bagaimana cara membatalkan peminjaman?
                                    </button>
                                </h2>
                                <div id="booking3" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Buka menu "Peminjaman Saya"</li>
                                            <li>Cari peminjaman yang ingin dibatalkan</li>
                                            <li>Klik tombol "Batalkan"</li>
                                            <li>Konfirmasi pembatalan</li>
                                            <li>Pembatalan hanya bisa dilakukan sebelum peminjaman disetujui</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Products FAQ -->
                    <section id="products" class="mb-5">
                        <h5>Produk Elektronik</h5>
                        <div class="accordion" id="productsAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#products1">
                                        Apa saja produk yang tersedia?
                                    </button>
                                </h2>
                                <div id="products1" class="accordion-collapse collapse" data-bs-parent="#productsAccordion">
                                    <div class="accordion-body">
                                        <p>Produk yang tersedia meliputi:</p>
                                        <ul>
                                            <li>Microphone dan peralatan audio</li>
                                            <li>Proyektor dan layar</li>
                                            <li>Kamera dan peralatan video</li>
                                            <li>Laptop dan komputer</li>
                                            <li>Peralatan presentasi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#products2">
                                        Berapa lama maksimal peminjaman?
                                    </button>
                                </h2>
                                <div id="products2" class="accordion-collapse collapse" data-bs-parent="#productsAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Maksimal peminjaman produk adalah 7 hari. Untuk perpanjangan, 
                                            harus mengajukan permintaan minimal 1 hari sebelum tanggal pengembalian.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#products3">
                                        Bagaimana jika terjadi kerusakan?
                                    </button>
                                </h2>
                                <div id="products3" class="accordion-collapse collapse" data-bs-parent="#productsAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Segera laporkan kerusakan ke admin</li>
                                            <li>Isi form laporan kerusakan</li>
                                            <li>Lampirkan foto kerusakan</li>
                                            <li>Tunggu assessment dari teknisi</li>
                                            <li>Ikuti prosedur penggantian jika diperlukan</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Rooms FAQ -->
                    <section id="rooms" class="mb-5">
                        <h5>Ruangan</h5>
                        <div class="accordion" id="roomsAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rooms1">
                                        Apa saja ruangan yang bisa dibooking?
                                    </button>
                                </h2>
                                <div id="rooms1" class="accordion-collapse collapse" data-bs-parent="#roomsAccordion">
                                    <div class="accordion-body">
                                        <p>Ruangan yang tersedia meliputi:</p>
                                        <ul>
                                            <li>Ruang kelas</li>
                                            <li>Ruang rapat</li>
                                            <li>Aula</li>
                                            <li>Laboratorium</li>
                                            <li>Ruang multimedia</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rooms2">
                                        Berapa lama maksimal booking ruangan?
                                    </button>
                                </h2>
                                <div id="rooms2" class="accordion-collapse collapse" data-bs-parent="#roomsAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Maksimal booking ruangan adalah 4 jam per sesi. Untuk penggunaan 
                                            lebih lama, diperlukan persetujuan khusus dari pihak administrasi.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rooms3">
                                        Apa yang harus dilakukan setelah menggunakan ruangan?
                                    </button>
                                </h2>
                                <div id="rooms3" class="accordion-collapse collapse" data-bs-parent="#roomsAccordion">
                                    <div class="accordion-body">
                                        <ol>
                                            <li>Pastikan ruangan bersih</li>
                                            <li>Matikan semua peralatan elektronik</li>
                                            <li>Kembalikan furniture ke posisi semula</li>
                                            <li>Kunci ruangan</li>
                                            <li>Laporkan selesai penggunaan di sistem</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Contact Support -->
                    <section class="text-center mt-5">
                        <h5 class="mb-4">Masih Butuh Bantuan?</h5>
                        <p class="text-muted mb-4">
                            Jika Anda tidak menemukan jawaban yang dicari, silakan hubungi tim support kami:
                        </p>
                        <div class="row justify-content-center g-3">
                            <div class="col-md-4">
                                <div class="support-card">
                                    <i class="fas fa-envelope"></i>
                                    <h6>Email</h6>
                                    <p>support@unu-jogja.ac.id</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="support-card">
                                    <i class="fas fa-phone"></i>
                                    <h6>Telepon</h6>
                                    <p>(0274) 123456</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="support-card">
                                    <i class="fas fa-comments"></i>
                                    <h6>Live Chat</h6>
                                    <button class="btn btn-sm btn-primary" onclick="openLiveChat()">
                                        Mulai Chat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .quick-link-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
    }

    .quick-link-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        color: #3498db;
    }

    .quick-link-card i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #3498db;
    }

    .accordion-item {
        background: #fff;
        border-radius: 10px !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .accordion-button {
        border-radius: 10px !important;
        box-shadow: none !important;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #3498db;
    }

    .support-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .support-card i {
        font-size: 2rem;
        color: #3498db;
        margin-bottom: 1rem;
    }

    .support-card h6 {
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .support-card p {
        margin-bottom: 0;
        color: #7f8c8d;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }
</style>

<!-- Custom Scripts -->
<script>
    // Filter FAQ based on search input
    function filterFAQ() {
        const input = document.getElementById('searchFAQ');
        const filter = input.value.toLowerCase();
        const buttons = document.getElementsByClassName('accordion-button');

        for (let button of buttons) {
            const text = button.textContent.toLowerCase();
            const item = button.closest('.accordion-item');
            
            if (text.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        }
    }

    // Smooth scroll to sections
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Open live chat (placeholder function)
    function openLiveChat() {
        alert('Fitur live chat akan segera tersedia!');
    }
</script>
