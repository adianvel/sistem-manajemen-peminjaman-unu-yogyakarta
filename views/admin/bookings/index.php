<?php $pageTitle = 'Manajemen Peminjaman'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
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
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Peminjaman</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="filterBookings('all')">
                            Semua
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-warning" onclick="filterBookings('pending')">
                            Menunggu
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="filterBookings('approved')">
                            Disetujui
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="filterBookings('rejected')">
                            Ditolak
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-primary" onclick="exportToExcel()">
                            <i class="fas fa-file-excel me-1"></i> Export
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control" 
                               id="searchInput" 
                               placeholder="Cari peminjaman..."
                               onkeyup="filterBookings()">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-end">
                        <div class="input-group" style="width: auto;">
                            <input type="date" class="form-control" id="startDate">
                            <span class="input-group-text">sampai</span>
                            <input type="date" class="form-control" id="endDate">
                            <button class="btn btn-outline-primary" onclick="filterByDate()">
                                Filter
                            </button>
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
                                        <tr class="booking-row" data-status="pending">
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
                                                            class="btn btn-sm btn-info text-white"
                                                            onclick="viewBooking(<?= $booking['id'] ?>)">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
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

            <!-- All Bookings -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Semua Peminjaman</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($bookings)): ?>
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
                                    <?php foreach ($bookings as $booking): ?>
                                        <tr class="booking-row" data-status="<?= $booking['status'] ?>">
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
                                                <div class="btn-group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-info text-white"
                                                            onclick="viewBooking(<?= $booking['id'] ?>)">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <?php if ($booking['status'] === 'approved'): ?>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-success"
                                                                onclick="completeBooking(<?= $booking['id'] ?>)">
                                                            <i class="fas fa-check-double"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted my-3">Tidak ada peminjaman yang tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Booking Details Modal -->
<div class="modal fade" id="bookingDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="bookingDetails">
                    <!-- Details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    @media (max-width: 767.98px) {
        .sidebar {
            position: static;
            padding-top: 0;
        }
    }
</style>

<!-- Custom Scripts -->
<script>
    // View booking details
    function viewBooking(id) {
        fetch(`<?= BASE_URL ?>/admin/bookings/details/${id}`)
            .then(response => response.json())
            .then(data => {
                const details = document.getElementById('bookingDetails');
                details.innerHTML = `
                    <dl class="row">
                        <dt class="col-sm-4">ID Peminjaman</dt>
                        <dd class="col-sm-8">#${data.id}</dd>
                        
                        <dt class="col-sm-4">Pengguna</dt>
                        <dd class="col-sm-8">${data.user_name}</dd>
                        
                        <dt class="col-sm-4">Item</dt>
                        <dd class="col-sm-8">
                            ${data.product_id ? 
                                `<span class="badge bg-primary">Produk</span> ${data.product_name}` : 
                                `<span class="badge bg-success">Ruangan</span> ${data.room_name}`}
                        </dd>
                        
                        <dt class="col-sm-4">Tanggal Mulai</dt>
                        <dd class="col-sm-8">${new Date(data.start_date).toLocaleString()}</dd>
                        
                        <dt class="col-sm-4">Tanggal Selesai</dt>
                        <dd class="col-sm-8">${new Date(data.end_date).toLocaleString()}</dd>
                        
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-${statusClass[data.status]}">
                                ${statusText[data.status]}
                            </span>
                        </dd>
                        
                        <dt class="col-sm-4">Tujuan</dt>
                        <dd class="col-sm-8">${data.purpose}</dd>
                        
                        <dt class="col-sm-4">Tanggal Pengajuan</dt>
                        <dd class="col-sm-8">${new Date(data.created_at).toLocaleString()}</dd>
                    </dl>
                `;
                
                new bootstrap.Modal(document.getElementById('bookingDetailsModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat detail peminjaman');
            });
    }

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

    // Complete booking
    function completeBooking(id) {
        if (confirm('Apakah Anda yakin ingin menandai peminjaman ini sebagai selesai?')) {
            window.location.href = `<?= BASE_URL ?>/admin/bookings/complete/${id}`;
        }
    }

    // Filter bookings
    function filterBookings(status = null) {
        const rows = document.getElementsByClassName('booking-row');
        const search = document.getElementById('searchInput').value.toLowerCase();
        
        for (let row of rows) {
            const rowStatus = row.dataset.status;
            const text = row.textContent.toLowerCase();
            
            const matchesStatus = status === null || status === 'all' || rowStatus === status;
            const matchesSearch = search === '' || text.includes(search);
            
            row.style.display = matchesStatus && matchesSearch ? '' : 'none';
        }
    }

    // Filter by date
    function filterByDate() {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        
        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
            alert('Silakan pilih tanggal yang valid');
            return;
        }
        
        if (endDate < startDate) {
            alert('Tanggal akhir harus setelah tanggal awal');
            return;
        }
        
        window.location.href = `<?= BASE_URL ?>/admin/bookings?start_date=${document.getElementById('startDate').value}&end_date=${document.getElementById('endDate').value}`;
    }

    // Export to Excel
    function exportToExcel() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        let url = `<?= BASE_URL ?>/admin/bookings/export/excel`;
        
        if (startDate && endDate) {
            url += `?start_date=${startDate}&end_date=${endDate}`;
        }
        
        window.location.href = url;
    }
</script>
