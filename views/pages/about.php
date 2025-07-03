<?php $pageTitle = 'Tentang Kami'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="text-center mb-4">Tentang Kami</h1>
                    <p class="text-muted text-center mb-5">
                        Sistem Manajemen Peminjaman Produk Elektronik dan Ruangan UNU Yogyakarta
                    </p>

                    <!-- Institution Overview -->
                    <section class="mb-5">
                        <div class="text-center mb-4">
                            <img src="<?= BASE_URL ?>/assets/images/logo-unu.png" 
                                 alt="UNU Yogyakarta" 
                                 class="img-fluid mb-3"
                                 style="max-height: 120px;">
                            <h4>Universitas Nahdlatul Ulama Yogyakarta</h4>
                        </div>
                        <p class="text-center">
                            UNU Yogyakarta berkomitmen untuk memberikan pelayanan terbaik dalam mendukung 
                            kegiatan akademik dan organisasi mahasiswa melalui sistem manajemen peminjaman 
                            yang modern dan efisien.
                        </p>
                    </section>

                    <!-- Vision & Mission -->
                    <section class="mb-5">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="vision-card">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <h5>Visi</h5>
                                    <p>
                                        Menjadi pusat layanan peminjaman fasilitas yang modern, 
                                        efisien, dan terpercaya untuk mendukung kegiatan akademik 
                                        dan organisasi di UNU Yogyakarta.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="vision-card">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <h5>Misi</h5>
                                    <ul class="mission-list">
                                        <li>Menyediakan layanan peminjaman yang mudah dan cepat</li>
                                        <li>Memastikan ketersediaan dan kualitas fasilitas</li>
                                        <li>Mendukung kegiatan akademik dan organisasi</li>
                                        <li>Meningkatkan efisiensi pengelolaan aset</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Features -->
                    <section class="mb-5">
                        <h4 class="text-center mb-4">Fitur Utama</h4>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-laptop"></i>
                                    </div>
                                    <h6>Peminjaman Produk</h6>
                                    <p>
                                        Peminjaman berbagai peralatan elektronik untuk mendukung 
                                        kegiatan akademik.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                    <h6>Booking Ruangan</h6>
                                    <p>
                                        Reservasi ruangan untuk kegiatan perkuliahan dan 
                                        organisasi.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="icon-wrapper">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h6>Real-time Tracking</h6>
                                    <p>
                                        Pantau status peminjaman dan ketersediaan secara 
                                        real-time.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Statistics -->
                    <section class="mb-5">
                        <div class="stats-section">
                            <div class="row text-center">
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="stats-item">
                                        <h3><?= $totalProducts ?? 0 ?></h3>
                                        <p>Produk</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="stats-item">
                                        <h3><?= $totalRooms ?? 0 ?></h3>
                                        <p>Ruangan</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="stats-item">
                                        <h3><?= $totalUsers ?? 0 ?></h3>
                                        <p>Pengguna</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="stats-item">
                                        <h3><?= $totalBookings ?? 0 ?></h3>
                                        <p>Peminjaman</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Team -->
                    <section class="mb-5">
                        <h4 class="text-center mb-4">Tim Kami</h4>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="team-card">
                                    <img src="<?= BASE_URL ?>/assets/images/team/admin.jpg" 
                                         alt="Admin"
                                         class="team-img">
                                    <h6>Tim Administrasi</h6>
                                    <p>Pengelolaan peminjaman dan persetujuan</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="team-card">
                                    <img src="<?= BASE_URL ?>/assets/images/team/technical.jpg" 
                                         alt="Technical"
                                         class="team-img">
                                    <h6>Tim Teknis</h6>
                                    <p>Pemeliharaan dan dukungan teknis</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="team-card">
                                    <img src="<?= BASE_URL ?>/assets/images/team/support.jpg" 
                                         alt="Support"
                                         class="team-img">
                                    <h6>Tim Support</h6>
                                    <p>Bantuan dan layanan pengguna</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Contact -->
                    <section class="text-center">
                        <h4 class="mb-4">Hubungi Kami</h4>
                        <p class="mb-4">
                            Punya pertanyaan atau masukan? Jangan ragu untuk menghubungi kami.
                        </p>
                        <a href="<?= BASE_URL ?>/contact" class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i> Kirim Pesan
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .vision-card {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .vision-card:hover {
        transform: translateY(-5px);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        background: #e3f2fd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .icon-wrapper i {
        font-size: 1.5rem;
        color: #3498db;
    }

    .mission-list {
        list-style: none;
        padding-left: 0;
    }

    .mission-list li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .mission-list li:before {
        content: '•';
        color: #3498db;
        position: absolute;
        left: 0;
    }

    .feature-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: 100%;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .stats-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 10px;
        margin: 2rem 0;
    }

    .stats-item h3 {
        color: #3498db;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stats-item p {
        color: #7f8c8d;
        margin: 0;
    }

    .team-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-align: center;
        height: 100%;
        transition: transform 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .team-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 1rem;
        object-fit: cover;
    }

    .btn-primary {
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
