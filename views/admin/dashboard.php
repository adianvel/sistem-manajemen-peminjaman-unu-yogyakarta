<?php $pageTitle = 'Dashboard Admin'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL ?>/admin">
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
                        <a class="nav-link" href="<?= BASE_URL ?>/admin/bookings">
                            <i class="fas fa-calendar-check me-2"></i> Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/admin/users">
                            <i class="fas fa-users me-2"></i> Pengguna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/admin/reports">
                            <i class="fas fa-chart-bar me-2"></i> Laporan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportToExcel()">
                            <i class="fas fa-file-excel me-1"></i> Export
                        </button>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#settingsModal">
                        <i class="fas fa-cog me-1"></i> Settings
                    </button>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Products -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="stats-icon bg-primary text-white">
                                        <i class="fas fa-laptop"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title mb-1">Total Produk</h6>
                                    <h3 class="mb-0"><?= $totalProducts ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Rooms -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="stats-icon bg-success text-white">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title mb-1">Total Ruangan</h6>
                                    <h3 class="mb-0"><?= $totalRooms ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Bookings -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="stats-icon bg-warning text-white">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title mb-1">Peminjaman Aktif</h6>
                                    <h3 class="mb-0"><?= $totalBookings ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="stats-icon bg-info text-white">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title mb-1">Total Pengguna</h6>
                                    <h3 class="mb-0"><?= $totalUsers ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Bookings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Peminjaman Menunggu Persetujuan</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($pendingBookings)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pengguna</th>
                                        <th>Item</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingBookings as $booking): ?>
                                        <tr>
                                            <td>#<?= $booking['id'] ?></td>
                                            <td><?= htmlspecialchars($booking['user_name']) ?></td>
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
                                                <span class="badge bg-warning">Menunggu</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-success"
                                                            onclick="approveBooking(<?= $booking['id'] ?>)">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="rejectBooking(<?= $booking['id'] ?>)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted my-3">Tidak ada peminjaman yang menunggu persetujuan.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Low Stock Products -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Produk Stok Menipis</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($lowStockProducts)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Stok Tersedia</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lowStockProducts as $product): ?>
                                        <tr>
                                            <td>#<?= $product['id'] ?></td>
                                            <td><?= htmlspecialchars($product['name']) ?></td>
                                            <td><?= htmlspecialchars($product['category']) ?></td>
                                            <td>
                                                <span class="badge bg-danger"><?= $product['quantity'] ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/admin/products/edit/<?= $product['id'] ?>" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Update Stok
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted my-3">Tidak ada produk dengan stok menipis.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengaturan Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="settingsForm">
                    <div class="mb-3">
                        <label class="form-label">Tampilkan Statistik</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showProducts" checked>
                            <label class="form-check-label" for="showProducts">
                                Produk
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showRooms" checked>
                            <label class="form-check-label" for="showRooms">
                                Ruangan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showBookings" checked>
                            <label class="form-check-label" for="showBookings">
                                Peminjaman
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showUsers" checked>
                            <label class="form-check-label" for="showUsers">
                                Pengguna
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="refreshInterval" class="form-label">Interval Refresh Data (detik)</label>
                        <input type="number" class="form-control" id="refreshInterval" value="30" min="10">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveSettings()">Simpan</button>
            </div>
        </div>
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

    .stats-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
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
    // Approve booking
    function approveBooking(id) {
        if (confirm('Apakah Anda yakin ingin menyetujui peminjaman ini?')) {
            window.location.href = `<?= BASE_URL ?>/admin/bookings/approve/${id}`;
        }
    }

    // Reject booking
    function rejectBooking(id) {
        if (confirm('Apakah Anda yakin ingin menolak peminjaman ini?')) {
            window.location.href = `<?= BASE_URL ?>/admin/bookings/reject/${id}`;
        }
    }

    // Export to Excel
    function exportToExcel() {
        // Implementation for exporting data to Excel
        alert('Export to Excel functionality will be implemented here');
    }

    // Save dashboard settings
    function saveSettings() {
        // Implementation for saving dashboard settings
        alert('Settings saved successfully');
        $('#settingsModal').modal('hide');
    }

    // Auto refresh data
    let refreshInterval = 30000; // 30 seconds default
    let refreshTimer;

    function startAutoRefresh() {
        clearInterval(refreshTimer);
        refreshTimer = setInterval(() => {
            location.reload();
        }, refreshInterval);
    }

    // Update refresh interval
    document.getElementById('refreshInterval').addEventListener('change', function() {
        refreshInterval = this.value * 1000;
        startAutoRefresh();
    });

    // Start auto refresh when page loads
    startAutoRefresh();
</script>
