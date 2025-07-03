<?php $pageTitle = 'Laporan'; ?>

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
                        <a class="nav-link active" href="<?= BASE_URL ?>/admin/reports">
                            <i class="fas fa-chart-bar me-2"></i> Laporan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Laporan</h1>
            </div>

            <!-- Report Generator -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Generator Laporan</h5>
                </div>
                <div class="card-body">
                    <form id="reportForm" onsubmit="generateReport(event)">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="reportType" class="form-label">Jenis Laporan</label>
                                <select class="form-select" id="reportType" name="report_type" required>
                                    <option value="">Pilih Jenis Laporan</option>
                                    <option value="bookings">Peminjaman</option>
                                    <option value="products">Produk</option>
                                    <option value="rooms">Ruangan</option>
                                    <option value="users">Pengguna</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="startDate" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="startDate" name="start_date" required>
                            </div>
                            <div class="col-md-4">
                                <label for="endDate" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="endDate" name="end_date" required>
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-file-alt me-1"></i> Generate Laporan
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-download me-1"></i> Export
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="exportReport('excel')">
                                                    <i class="fas fa-file-excel me-2"></i> Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="exportReport('pdf')">
                                                    <i class="fas fa-file-pdf me-2"></i> PDF
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Results -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Hasil Laporan</h5>
                </div>
                <div class="card-body">
                    <div id="reportResults">
                        <!-- Report content will be loaded here -->
                        <div class="text-center text-muted my-5">
                            <i class="fas fa-chart-bar fa-3x mb-3"></i>
                            <p>Pilih jenis laporan dan rentang tanggal untuk melihat hasil</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mt-4">
                <!-- Booking Trends -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">Tren Peminjaman</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="bookingTrendsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Popular Items -->
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0">Item Terpopuler</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="popularItemsChart"></canvas>
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

    @media (max-width: 767.98px) {
        .sidebar {
            position: static;
            padding-top: 0;
        }
    }

    .loading {
        position: relative;
        min-height: 200px;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        margin: -20px 0 0 -20px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom Scripts -->
<script>
    // Initialize charts
    let bookingTrendsChart;
    let popularItemsChart;

    function initCharts() {
        // Booking Trends Chart
        const bookingTrendsCtx = document.getElementById('bookingTrendsChart').getContext('2d');
        bookingTrendsChart = new Chart(bookingTrendsCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: [],
                    borderColor: '#3498db',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Popular Items Chart
        const popularItemsCtx = document.getElementById('popularItemsChart').getContext('2d');
        popularItemsChart = new Chart(popularItemsCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: [],
                    backgroundColor: '#3498db'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Generate report
    function generateReport(event) {
        event.preventDefault();
        
        const form = event.target;
        const formData = new FormData(form);
        const reportType = formData.get('report_type');
        const startDate = formData.get('start_date');
        const endDate = formData.get('end_date');

        // Validate dates
        if (new Date(endDate) < new Date(startDate)) {
            alert('Tanggal selesai harus setelah tanggal mulai');
            return;
        }

        // Show loading state
        const resultsDiv = document.getElementById('reportResults');
        resultsDiv.innerHTML = '';
        resultsDiv.classList.add('loading');

        // Fetch report data
        fetch(`<?= BASE_URL ?>/admin/reports/generate`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            resultsDiv.classList.remove('loading');
            
            // Update report content based on type
            switch (reportType) {
                case 'bookings':
                    displayBookingsReport(data);
                    break;
                case 'products':
                    displayProductsReport(data);
                    break;
                case 'rooms':
                    displayRoomsReport(data);
                    break;
                case 'users':
                    displayUsersReport(data);
                    break;
            }

            // Update charts
            updateCharts(data);
        })
        .catch(error => {
            console.error('Error:', error);
            resultsDiv.classList.remove('loading');
            resultsDiv.innerHTML = `
                <div class="alert alert-danger">
                    Gagal memuat laporan. Silakan coba lagi.
                </div>
            `;
        });
    }

    // Display bookings report
    function displayBookingsReport(data) {
        const resultsDiv = document.getElementById('reportResults');
        resultsDiv.innerHTML = `
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Total Peminjaman</h6>
                            <h3 class="card-title mb-0">${data.total_bookings}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Peminjaman Disetujui</h6>
                            <h3 class="card-title mb-0">${data.approved_bookings}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Peminjaman Ditolak</h6>
                            <h3 class="card-title mb-0">${data.rejected_bookings}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Rata-rata Durasi</h6>
                            <h3 class="card-title mb-0">${data.average_duration} jam</h3>
                        </div>
                    </div>
                </div>
            </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        ${data.bookings.map(booking => `
                            <tr>
                                <td>#${booking.id}</td>
                                <td>${booking.user_name}</td>
                                <td>
                                    ${booking.product_id ? 
                                        `<span class="badge bg-primary">Produk</span> ${booking.product_name}` : 
                                        `<span class="badge bg-success">Ruangan</span> ${booking.room_name}`}
                                </td>
                                <td>${new Date(booking.start_date).toLocaleString()}</td>
                                <td>${new Date(booking.end_date).toLocaleString()}</td>
                                <td>
                                    <span class="badge bg-${getStatusClass(booking.status)}">
                                        ${getStatusText(booking.status)}
                                    </span>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    }

    // Display products report
    function displayProductsReport(data) {
        const resultsDiv = document.getElementById('reportResults');
        resultsDiv.innerHTML = `
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Total Produk</h6>
                            <h3 class="card-title mb-0">${data.total_products}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Produk Tersedia</h6>
                            <h3 class="card-title mb-0">${data.available_products}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Produk Maintenance</h6>
                            <h3 class="card-title mb-0">${data.maintenance_products}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Total Peminjaman</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.products.map(product => `
                            <tr>
                                <td>#${product.id}</td>
                                <td>${product.name}</td>
                                <td>${product.category}</td>
                                <td>${product.quantity}</td>
                                <td>${product.total_bookings}</td>
                                <td>
                                    <span class="badge bg-${product.status === 'available' ? 'success' : 'warning'}">
                                        ${product.status === 'available' ? 'Tersedia' : 'Maintenance'}
                                    </span>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    }

    // Helper functions
    function getStatusClass(status) {
        const classes = {
            'pending': 'warning',
            'approved': 'success',
            'rejected': 'danger',
            'completed': 'info'
        };
        return classes[status] || 'secondary';
    }

    function getStatusText(status) {
        const texts = {
            'pending': 'Menunggu',
            'approved': 'Disetujui',
            'rejected': 'Ditolak',
            'completed': 'Selesai'
        };
        return texts[status] || status;
    }

    // Update charts
    function updateCharts(data) {
        // Update Booking Trends Chart
        if (data.booking_trends) {
            bookingTrendsChart.data.labels = data.booking_trends.map(item => item.date);
            bookingTrendsChart.data.datasets[0].data = data.booking_trends.map(item => item.count);
            bookingTrendsChart.update();
        }

        // Update Popular Items Chart
        if (data.popular_items) {
            popularItemsChart.data.labels = data.popular_items.map(item => item.name);
            popularItemsChart.data.datasets[0].data = data.popular_items.map(item => item.count);
            popularItemsChart.update();
        }
    }

    // Export report
    function exportReport(format) {
        const form = document.getElementById('reportForm');
        const formData = new FormData(form);
        
        const queryString = new URLSearchParams(formData).toString();
        window.location.href = `<?= BASE_URL ?>/admin/reports/export/${format}?${queryString}`;
    }

    // Initialize charts when page loads
    document.addEventListener('DOMContentLoaded', initCharts);
</script>
