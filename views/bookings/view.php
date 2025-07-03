<?php $pageTitle = 'Detail Peminjaman'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <!-- Admin Sidebar -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/admin">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/admin/products">
                                <i class="fas fa-laptop me-2"></i> Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/admin/rooms">
                                <i class="fas fa-door-open me-2"></i> Ruangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= BASE_URL ?>/admin/bookings">
                                <i class="fas fa-calendar-check me-2"></i> Peminjaman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/admin/users">
                                <i class="fas fa-users me-2"></i> Pengguna
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- User Sidebar -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/user">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/user/products">
                                <i class="fas fa-laptop me-2"></i> Produk Elektronik
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/user/rooms">
                                <i class="fas fa-door-open me-2"></i> Ruangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= BASE_URL ?>/user/bookings">
                                <i class="fas fa-calendar-check me-2"></i> Peminjaman Saya
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Detail Peminjaman #<?= $booking['id'] ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="<?= $_SESSION['user']['role'] === 'admin' ? '/admin/bookings' : '/user/bookings' ?>" 
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">Informasi Peminjaman</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl>
                                        <dt>Status</dt>
                                        <dd>
                                            <?php
                                                $statusClass = [
                                                    'pending' => 'warning',
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    'completed' => 'info'
                                                ];
                                                $statusText = [
                                                    'pending' => 'Menunggu',
                                                    'approved' => 'Disetujui',
                                                    'rejected' => 'Ditolak',
                                                    'completed' => 'Selesai'
                                                ];
                                            ?>
                                            <span class="badge bg-<?= $statusClass[$booking['status']] ?>">
                                                <?= $statusText[$booking['status']] ?>
                                            </span>
                                        </dd>

                                        <dt>Tanggal Pengajuan</dt>
                                        <dd><?= date('d/m/Y H:i', strtotime($booking['created_at'])) ?></dd>

                                        <dt>Tanggal Mulai</dt>
                                        <dd><?= date('d/m/Y H:i', strtotime($booking['start_date'])) ?></dd>

                                        <dt>Tanggal Selesai</dt>
                                        <dd><?= date('d/m/Y H:i', strtotime($booking['end_date'])) ?></dd>

                                        <dt>Durasi</dt>
                                        <dd>
                                            <?php
                                                $start = new DateTime($booking['start_date']);
                                                $end = new DateTime($booking['end_date']);
                                                $interval = $start->diff($end);
                                                echo $interval->format('%d hari %h jam %i menit');
                                            ?>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl>
                                        <dt>Peminjam</dt>
                                        <dd><?= htmlspecialchars($booking['user_name']) ?></dd>

                                        <dt>Email</dt>
                                        <dd><?= htmlspecialchars($booking['user_email']) ?></dd>

                                        <dt>Tujuan Peminjaman</dt>
                                        <dd><?= htmlspecialchars($booking['purpose']) ?></dd>

                                        <?php if ($booking['notes']): ?>
                                            <dt>Catatan</dt>
                                            <dd><?= htmlspecialchars($booking['notes']) ?></dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item Details -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">
                                <?= $booking['product_id'] ? 'Detail Produk' : 'Detail Ruangan' ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if ($booking['product_id']): ?>
                                <!-- Product Details -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= BASE_URL ?>/assets/images/products/<?= $booking['product_image'] ?? 'default.jpg' ?>" 
                                             alt="<?= htmlspecialchars($booking['product_name']) ?>"
                                             class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-8">
                                        <h5><?= htmlspecialchars($booking['product_name']) ?></h5>
                                        <p class="text-muted"><?= htmlspecialchars($booking['product_description']) ?></p>
                                        <dl class="row">
                                            <dt class="col-sm-4">Kategori</dt>
                                            <dd class="col-sm-8"><?= htmlspecialchars($booking['product_category']) ?></dd>
                                            
                                            <dt class="col-sm-4">Status</dt>
                                            <dd class="col-sm-8">
                                                <span class="badge bg-<?= $booking['product_status'] === 'available' ? 'success' : 'warning' ?>">
                                                    <?= $booking['product_status'] === 'available' ? 'Tersedia' : 'Maintenance' ?>
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- Room Details -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= BASE_URL ?>/assets/images/rooms/<?= $booking['room_image'] ?? 'default.jpg' ?>" 
                                             alt="<?= htmlspecialchars($booking['room_name']) ?>"
                                             class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-8">
                                        <h5><?= htmlspecialchars($booking['room_name']) ?></h5>
                                        <p class="text-muted"><?= htmlspecialchars($booking['room_description']) ?></p>
                                        <dl class="row">
                                            <dt class="col-sm-4">Kapasitas</dt>
                                            <dd class="col-sm-8"><?= $booking['room_capacity'] ?> orang</dd>
                                            
                                            <dt class="col-sm-4">Fasilitas</dt>
                                            <dd class="col-sm-8"><?= htmlspecialchars($booking['room_facilities']) ?></dd>
                                            
                                            <dt class="col-sm-4">Status</dt>
                                            <dd class="col-sm-8">
                                                <span class="badge bg-<?= $booking['room_status'] === 'available' ? 'success' : 'warning' ?>">
                                                    <?= $booking['room_status'] === 'available' ? 'Tersedia' : 'Maintenance' ?>
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Actions Sidebar -->
                <div class="col-md-4">
                    <!-- Status Actions -->
                    <?php if ($_SESSION['user']['role'] === 'admin' && $booking['status'] === 'pending'): ?>
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="card-title mb-0">Tindakan</h5>
                            </div>
                            <div class="card-body">
                                <form action="<?= BASE_URL ?>/admin/bookings/update-status/<?= $booking['id'] ?>" method="POST">
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Catatan (opsional)</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" 
                                                name="status" 
                                                value="approved" 
                                                class="btn btn-success">
                                            <i class="fas fa-check me-1"></i> Setujui Peminjaman
                                        </button>
                                        <button type="submit" 
                                                name="status" 
                                                value="rejected" 
                                                class="btn btn-danger">
                                            <i class="fas fa-times me-1"></i> Tolak Peminjaman
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Timeline -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">Riwayat Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <?php foreach ($booking['history'] as $history): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-<?= $statusClass[$history['status']] ?>"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0"><?= $statusText[$history['status']] ?></h6>
                                            <small class="text-muted">
                                                <?= date('d/m/Y H:i', strtotime($history['created_at'])) ?>
                                            </small>
                                            <?php if ($history['notes']): ?>
                                                <p class="mt-2 mb-0"><?= htmlspecialchars($history['notes']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #3498db;
    }

    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0.75rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .timeline-marker {
        position: absolute;
        left: -1.5rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
    }

    .timeline-content {
        padding-left: 1rem;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            position: static;
            padding-top: 0;
        }
    }
</style>
