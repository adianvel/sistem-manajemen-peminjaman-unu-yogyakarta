<?php $pageTitle = 'Syarat & Ketentuan'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="text-center mb-4">Syarat & Ketentuan</h1>
                    <p class="text-muted text-center mb-5">
                        Terakhir diperbarui: <?= date('d F Y') ?>
                    </p>

                    <!-- Introduction -->
                    <section class="mb-5">
                        <h5>1. Pendahuluan</h5>
                        <p>
                            Selamat datang di Sistem Manajemen Peminjaman Produk Elektronik dan Ruangan UNU Yogyakarta. 
                            Dengan menggunakan layanan ini, Anda menyetujui untuk terikat oleh syarat dan ketentuan berikut.
                        </p>
                    </section>

                    <!-- Eligibility -->
                    <section class="mb-5">
                        <h5>2. Kelayakan Pengguna</h5>
                        <p>Untuk menggunakan layanan ini, Anda harus:</p>
                        <ul>
                            <li>Merupakan mahasiswa aktif, dosen, atau staf UNU Yogyakarta</li>
                            <li>Memiliki kartu identitas yang valid</li>
                            <li>Berusia minimal 17 tahun</li>
                            <li>Memiliki akun yang terdaftar di sistem</li>
                        </ul>
                    </section>

                    <!-- Booking Rules -->
                    <section class="mb-5">
                        <h5>3. Aturan Peminjaman</h5>
                        <h6 class="mt-4">3.1. Produk Elektronik</h6>
                        <ul>
                            <li>Maksimal durasi peminjaman adalah 7 hari</li>
                            <li>Peminjam bertanggung jawab atas kondisi produk</li>
                            <li>Kerusakan atau kehilangan akan dikenakan biaya penggantian</li>
                            <li>Peminjaman harus dikembalikan tepat waktu</li>
                            <li>Keterlambatan akan dikenakan sanksi administratif</li>
                        </ul>

                        <h6 class="mt-4">3.2. Ruangan</h6>
                        <ul>
                            <li>Booking ruangan maksimal 4 jam per sesi</li>
                            <li>Maksimal 3 hari sebelum tanggal penggunaan</li>
                            <li>Penggunaan di luar jam operasional harus dengan izin khusus</li>
                            <li>Ruangan harus dikembalikan dalam kondisi bersih</li>
                            <li>Dilarang menggunakan ruangan untuk kegiatan non-akademik tanpa izin</li>
                        </ul>
                    </section>

                    <!-- User Responsibilities -->
                    <section class="mb-5">
                        <h5>4. Tanggung Jawab Pengguna</h5>
                        <p>Pengguna bertanggung jawab untuk:</p>
                        <ul>
                            <li>Memberikan informasi yang akurat saat registrasi</li>
                            <li>Menjaga kerahasiaan akun dan password</li>
                            <li>Menggunakan fasilitas sesuai peruntukkannya</li>
                            <li>Melaporkan kerusakan atau kehilangan segera</li>
                            <li>Mematuhi peraturan kampus yang berlaku</li>
                        </ul>
                    </section>

                    <!-- Booking Process -->
                    <section class="mb-5">
                        <h5>5. Proses Peminjaman</h5>
                        <ol>
                            <li>Pengguna mengajukan permintaan peminjaman melalui sistem</li>
                            <li>Admin akan memverifikasi permintaan dalam 1x24 jam</li>
                            <li>Jika disetujui, pengguna dapat mengambil produk/menggunakan ruangan</li>
                            <li>Pengembalian harus sesuai jadwal yang ditentukan</li>
                            <li>Evaluasi kondisi akan dilakukan saat pengembalian</li>
                        </ol>
                    </section>

                    <!-- Sanctions -->
                    <section class="mb-5">
                        <h5>6. Sanksi</h5>
                        <p>Pelanggaran terhadap ketentuan dapat dikenakan sanksi berupa:</p>
                        <ul>
                            <li>Peringatan tertulis</li>
                            <li>Pembekuan hak peminjaman sementara</li>
                            <li>Pencabutan hak peminjaman</li>
                            <li>Denda sesuai ketentuan yang berlaku</li>
                            <li>Sanksi akademik sesuai kebijakan kampus</li>
                        </ul>
                    </section>

                    <!-- Privacy -->
                    <section class="mb-5">
                        <h5>7. Privasi dan Data</h5>
                        <p>
                            Kami menghargai privasi Anda. Data yang dikumpulkan hanya digunakan untuk:
                        </p>
                        <ul>
                            <li>Verifikasi identitas</li>
                            <li>Proses peminjaman</li>
                            <li>Komunikasi terkait layanan</li>
                            <li>Peningkatan kualitas layanan</li>
                            <li>Keperluan administratif kampus</li>
                        </ul>
                    </section>

                    <!-- Changes to Terms -->
                    <section class="mb-5">
                        <h5>8. Perubahan Ketentuan</h5>
                        <p>
                            UNU Yogyakarta berhak mengubah syarat dan ketentuan ini sewaktu-waktu. 
                            Perubahan akan diumumkan melalui sistem dan email terdaftar.
                        </p>
                    </section>

                    <!-- Contact -->
                    <section class="mb-5">
                        <h5>9. Kontak</h5>
                        <p>
                            Untuk pertanyaan atau keluhan terkait layanan, silakan hubungi:
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-envelope me-2"></i> support@unu-jogja.ac.id</li>
                            <li><i class="fas fa-phone me-2"></i> (0274) 123456</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i> Gedung Administrasi Lt. 1</li>
                        </ul>
                    </section>

                    <!-- Agreement -->
                    <section class="text-center mt-5">
                        <p class="text-muted">
                            Dengan menggunakan layanan ini, Anda menyatakan telah membaca, 
                            memahami, dan menyetujui seluruh syarat dan ketentuan di atas.
                        </p>
                        <?php if (isset($_GET['from']) && $_GET['from'] === 'register'): ?>
                            <a href="<?= BASE_URL ?>/register" class="btn btn-primary">
                                <i class="fas fa-check me-1"></i> Saya Setuju & Lanjutkan Pendaftaran
                            </a>
                        <?php else: ?>
                            <a href="<?= BASE_URL ?>" class="btn btn-secondary">
                                <i class="fas fa-home me-1"></i> Kembali ke Beranda
                            </a>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    section h5 {
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    section h6 {
        color: #34495e;
        margin-bottom: 1rem;
    }

    section p, section li {
        color: #555;
        line-height: 1.6;
    }

    section ul, section ol {
        margin-bottom: 1rem;
    }

    section ul li, section ol li {
        margin-bottom: 0.5rem;
    }

    .card {
        border-radius: 15px;
    }

    .btn {
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }
</style>
