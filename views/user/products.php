<?php $pageTitle = 'Produk Elektronik'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/user">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL ?>/user/products">
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
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Produk Elektronik</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control" 
                               id="searchInput" 
                               placeholder="Cari produk..."
                               onkeyup="filterProducts()">
                        <button class="btn btn-outline-secondary dropdown-toggle" 
                                type="button" 
                                data-bs-toggle="dropdown">
                            Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCategory('all')">
                                    Semua Kategori
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCategory('audio')">
                                    Audio
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCategory('video')">
                                    Video
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCategory('komputer')">
                                    Komputer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row g-4">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 product-card" 
                             data-category="<?= htmlspecialchars($product['category']) ?>">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="<?= BASE_URL ?>/assets/images/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($product['name']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="card-text text-muted">
                                        <?= htmlspecialchars($product['description']) ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-<?= $product['quantity'] > 0 ? 'success' : 'danger' ?>">
                                            <?= $product['quantity'] > 0 ? 'Tersedia' : 'Kosong' ?>
                                        </span>
                                        <small class="text-muted">
                                            Stok: <?= $product['quantity'] ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0 pt-0">
                                    <div class="d-grid">
                                        <button type="button" 
                                                class="btn btn-primary"
                                                <?= $product['quantity'] > 0 ? '' : 'disabled' ?>
                                                onclick="showBookingModal(<?= $product['id'] ?>)">
                                            <i class="fas fa-calendar-plus me-1"></i> Pinjam
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak ada produk yang tersedia saat ini.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/user/book-product" method="POST" id="bookingForm">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="productId">
                    
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Tanggal Mulai</label>
                        <input type="datetime-local" 
                               class="form-control" 
                               id="startDate" 
                               name="start_date"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Tanggal Selesai</label>
                        <input type="datetime-local" 
                               class="form-control" 
                               id="endDate" 
                               name="end_date"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="purpose" class="form-label">Tujuan Peminjaman</label>
                        <textarea class="form-control" 
                                  id="purpose" 
                                  name="purpose" 
                                  rows="3"
                                  required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                </div>
            </form>
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

    .card {
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 200px;
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
    // Show booking modal
    function showBookingModal(productId) {
        document.getElementById('productId').value = productId;
        
        // Set minimum date to today
        const now = new Date();
        const today = now.toISOString().split('T')[0];
        const time = now.toTimeString().split(':')[0] + ':' + now.toTimeString().split(':')[1];
        
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');
        
        startDate.min = today + 'T' + time;
        endDate.min = today + 'T' + time;
        
        // Show modal
        new bootstrap.Modal(document.getElementById('bookingModal')).show();
    }

    // Filter products by search input
    function filterProducts() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.getElementsByClassName('product-card');

        for (let card of cards) {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('.card-text').textContent.toLowerCase();
            
            if (title.includes(filter) || description.includes(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        }
    }

    // Filter products by category
    function filterByCategory(category) {
        const cards = document.getElementsByClassName('product-card');
        
        for (let card of cards) {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        }
    }

    // Validate booking dates
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        
        if (endDate <= startDate) {
            e.preventDefault();
            alert('Tanggal selesai harus setelah tanggal mulai');
        }
    });
</script>
