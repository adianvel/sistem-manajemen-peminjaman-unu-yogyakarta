<?php $pageTitle = 'Beranda'; ?>

<!-- Hero Section -->
<section class="hero bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Manajemen Peminjaman Produk Elektronik</h1>
                <p class="lead mb-4">
                    Sistem peminjaman alat elektronik dan booking ruangan untuk kegiatan akademik dan organisasi di UNU Yogyakarta.
                </p>
                <?php if (!isset($_SESSION['user'])): ?>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="<?= BASE_URL ?>/landing/login" class="btn btn-light btn-lg px-4 me-md-2">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                        <a href="<?= BASE_URL ?>/landing/register" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-user-plus"></i> Daftar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="<?= BASE_URL ?>/assets/images/hero-image.svg" alt="Hero Image" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features py-5">
    <div class="container">
        <h2 class="text-center mb-5">Fitur Utama</h2>
        <div class="row g-4">
            <!-- Peminjaman Alat -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-laptop fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Peminjaman Alat Elektronik</h5>
                        <p class="card-text">
                            Pinjam berbagai alat elektronik untuk mendukung kegiatan akademik dan organisasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Booking Ruangan -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-door-open fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Booking Ruangan</h5>
                        <p class="card-text">
                            Reservasi ruangan untuk kegiatan perkuliahan, rapat, atau acara organisasi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tracking Status -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-chart-line fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Tracking Status</h5>
                        <p class="card-text">
                            Pantau status peminjaman dan booking secara real-time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Cara Kerja</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="step text-center">
                    <div class="step-number mb-3">1</div>
                    <h5>Daftar Akun</h5>
                    <p>Buat akun baru dengan mengisi form pendaftaran</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step text-center">
                    <div class="step-number mb-3">2</div>
                    <h5>Pilih Item</h5>
                    <p>Pilih alat elektronik atau ruangan yang ingin dipinjam</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step text-center">
                    <div class="step-number mb-3">3</div>
                    <h5>Ajukan Peminjaman</h5>
                    <p>Isi form peminjaman dengan detail kegiatan</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step text-center">
                    <div class="step-number mb-3">4</div>
                    <h5>Konfirmasi</h5>
                    <p>Tunggu konfirmasi dan ambil item yang dipinjam</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Available Items Section -->
<section class="available-items py-5">
    <div class="container">
        <h2 class="text-center mb-5">Item Tersedia</h2>
        
        <!-- Products -->
        <h4 class="mb-4">Alat Elektronik</h4>
        <div class="row g-4 mb-5">
            <?php if (isset($availableProducts) && !empty($availableProducts)): ?>
                <?php foreach ($availableProducts as $product): ?>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="<?= BASE_URL ?>/assets/images/products/<?= htmlspecialchars($product['image']) ?>" 
                                 class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                                <p class="text-muted">
                                    <small>Tersedia: <?= htmlspecialchars($product['quantity']) ?> unit</small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p class="text-center text-muted">Tidak ada alat elektronik yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Rooms -->
        <h4 class="mb-4">Ruangan</h4>
        <div class="row g-4">
            <?php if (isset($availableRooms) && !empty($availableRooms)): ?>
                <?php foreach ($availableRooms as $room): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="<?= BASE_URL ?>/assets/images/rooms/<?= htmlspecialchars($room['image']) ?>" 
                                 class="card-img-top" alt="<?= htmlspecialchars($room['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($room['description']) ?></p>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-users"></i> Kapasitas: <?= htmlspecialchars($room['capacity']) ?> orang</li>
                                    <li><i class="fas fa-tools"></i> Fasilitas: <?= htmlspecialchars($room['facilities']) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p class="text-center text-muted">Tidak ada ruangan yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="statistics py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-primary"><?= $totalProducts ?? 0 ?></h3>
                    <p class="lead">Alat Elektronik</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-primary"><?= $totalRooms ?? 0 ?></h3>
                    <p class="lead">Ruangan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <h3 class="display-4 fw-bold text-primary"><?= $totalBookings ?? 0 ?></h3>
                    <p class="lead">Peminjaman Selesai</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS for Landing Page -->
<style>
    .hero {
        background: linear-gradient(135deg, #3498db, #2c3e50);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .step-number {
        width: 40px;
        height: 40px;
        background-color: #3498db;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: bold;
        margin: 0 auto;
    }

    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stat-item {
        padding: 2rem;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
