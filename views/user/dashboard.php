<?php $pageTitle = 'Dashboard'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL ?>/user">
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
                        <a class="nav-link" href="<?= BASE_URL ?>/user/bookings">
                            <i class="fas fa-calendar-check me-2"></i> Peminjaman Saya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/user/profile">
                            <i class="fas fa-user-cog me-2"></i> Profil
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Welcome Section -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Selamat Datang, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.location.href='<?= BASE_URL ?>/user/bookings/new'">
                        <i class="fas fa-plus me-1"></i> Peminjaman Baru
                    </button>
                </div>
            </div>

            <!-- Active Bookings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Peminjaman Aktif</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($userBookings)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userBookings as $booking): ?>
                                        <tr>
                                            <td>#<?= $booking['id'] ?></td>
                                            <td>
                                                <?php if ($booking['product_id']): ?>
                                                    <span class="badge bg-primary">Produk</span>
                                                    <?= htmlspecialchars($booking['product_name']) ?>
                                                <?php else: ?>
                                                    <span class="badge bg-success">Ruangan</span>
                                                    <?= htmlspecialchars($booking['room_name']) ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d/m/Y H:i', strtotime($booking['start_date'])) ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($booking['end_date'])) ?></td>
                                            <td>
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
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/user/bookings/view/<?= $booking['id'] ?>" 
                                                   class="btn btn-sm btn-info text-white">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if ($booking['status'] === 'pending'): ?>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="cancelBooking(<?= $booking['id'] ?>)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted my-3">Anda belum memiliki peminjaman aktif.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Available Items -->
            <div class="row g-4">
                <!-- Available Products -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Produk Tersedia</h5>
                                <a href="<?= BASE_URL ?>/user/products" class="btn btn-sm btn-primary">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($availableProducts)): ?>
                                <div class="row g-3">
                                    <?php foreach (array_slice($availableProducts, 0, 4) as $product): ?>
                                        <div class="col-md-6">
                                            <div class="card h-100">
                                                <img src="<?= BASE_URL ?>/assets/images/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                                                     class="card-img-top" 
                                                     alt="<?= htmlspecialchars($product['name']) ?>">
                                                <div class="card-body">
                                                    <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>
                                                    <p class="card-text small text-muted mb-2">
                                                        Stok: <?= $product['quantity'] ?>
                                                    </p>
                                                    <a href="<?= BASE_URL ?>/user/book-product/<?= $product['id'] ?>" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        Pinjam
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-muted my-3">Tidak ada produk yang tersedia saat ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Available Rooms -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Ruangan Tersedia</h5>
                                <a href="<?= BASE_URL ?>/user/rooms" class="btn btn-sm btn-primary">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($availableRooms)): ?>
                                <div class="row g-3">
                                    <?php foreach (array_slice($availableRooms, 0, 4) as $room): ?>
                                        <div class="col-md-6">
                                            <div class="card h-100">
                                                <img src="<?= BASE_URL ?>/assets/images/rooms/<?= $room['image'] ?? 'default.jpg' ?>" 
                                                     class="card-img-top" 
                                                     alt="<?= htmlspecialchars($room['name']) ?>">
                                                <div class="card-body">
                                                    <h6 class="card-title"><?= htmlspecialchars($room['name']) ?></h6>
                                                    <p class="card-text small text-muted mb-2">
                                                        Kapasitas: <?= $room['capacity'] ?> orang
                                                    </p>
                                                    <a href="<?= BASE_URL ?>/user/book-room/<?= $room['id'] ?>" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        Booking
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-muted my-3">Tidak ada ruangan yang tersedia saat ini.</p>
                            <?php endif; ?>
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

    .card {
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 150px;
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            position: static;
            padding-top: 0;
        }
    }
</style>

<!-- Custom Scripts -->
<script>
    // Cancel booking
    function cancelBooking(id) {
        if (confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')) {
            window.location.href = `<?= BASE_URL ?>/user/bookings/cancel/${id}`;
        }
    }

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
