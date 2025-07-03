<?php $pageTitle = 'Manajemen Produk'; ?>

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
                        <a class="nav-link active" href="<?= BASE_URL ?>/admin/products">
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
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Produk</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#addProductModal">
                        <i class="fas fa-plus me-1"></i> Tambah Produk
                    </button>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="row mb-4">
                <div class="col-md-8">
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
                                <a class="dropdown-item" href="#" onclick="filterByStatus('all')">
                                    Semua Status
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByStatus('available')">
                                    Tersedia
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByStatus('maintenance')">
                                    Maintenance
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary me-2" onclick="exportToExcel()">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </button>
                        <button class="btn btn-outline-danger" onclick="exportToPDF()">
                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr class="product-row" data-status="<?= $product['status'] ?>">
                                            <td>#<?= $product['id'] ?></td>
                                            <td>
                                                <img src="<?= BASE_URL ?>/assets/images/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                                                     alt="<?= htmlspecialchars($product['name']) ?>"
                                                     class="product-thumbnail">
                                            </td>
                                            <td><?= htmlspecialchars($product['name']) ?></td>
                                            <td><?= htmlspecialchars($product['category']) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $product['quantity'] > 0 ? 'success' : 'danger' ?>">
                                                    <?= $product['quantity'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $product['status'] === 'available' ? 'success' : 'warning' ?>">
                                                    <?= $product['status'] === 'available' ? 'Tersedia' : 'Maintenance' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-info text-white"
                                                            onclick="viewProduct(<?= $product['id'] ?>)">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-primary"
                                                            onclick="editProduct(<?= $product['id'] ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="deleteProduct(<?= $product['id'] ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada produk yang tersedia.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/products/add" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="audio">Audio</option>
                            <option value="video">Video</option>
                            <option value="komputer">Komputer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="available">Tersedia</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Form fields will be populated dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

    .product-thumbnail {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
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
    // Filter products
    function filterProducts() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const rows = document.getElementsByClassName('product-row');

        for (let row of rows) {
            const name = row.cells[2].textContent.toLowerCase();
            const category = row.cells[3].textContent.toLowerCase();
            
            if (name.includes(filter) || category.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    // Filter by status
    function filterByStatus(status) {
        const rows = document.getElementsByClassName('product-row');
        
        for (let row of rows) {
            if (status === 'all' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    // View product details
    function viewProduct(id) {
        window.location.href = `<?= BASE_URL ?>/admin/products/view/${id}`;
    }

    // Edit product
    function editProduct(id) {
        fetch(`<?= BASE_URL ?>/admin/products/get/${id}`)
            .then(response => response.json())
            .then(product => {
                const form = document.getElementById('editProductForm');
                form.action = `<?= BASE_URL ?>/admin/products/edit/${id}`;
                
                const modalBody = form.querySelector('.modal-body');
                modalBody.innerHTML = `
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="edit_name" name="name" value="${product.name}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Kategori</label>
                        <select class="form-select" id="edit_category" name="category" required>
                            <option value="audio" ${product.category === 'audio' ? 'selected' : ''}>Audio</option>
                            <option value="video" ${product.category === 'video' ? 'selected' : ''}>Video</option>
                            <option value="komputer" ${product.category === 'komputer' ? 'selected' : ''}>Komputer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3">${product.description}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="edit_quantity" name="quantity" min="0" value="${product.quantity}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="available" ${product.status === 'available' ? 'selected' : ''}>Tersedia</option>
                            <option value="maintenance" ${product.status === 'maintenance' ? 'selected' : ''}>Maintenance</option>
                        </select>
                    </div>
                `;
                
                new bootstrap.Modal(document.getElementById('editProductModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data produk');
            });
    }

    // Delete product
    function deleteProduct(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            window.location.href = `<?= BASE_URL ?>/admin/products/delete/${id}`;
        }
    }

    // Export to Excel
    function exportToExcel() {
        window.location.href = `<?= BASE_URL ?>/admin/products/export/excel`;
    }

    // Export to PDF
    function exportToPDF() {
        window.location.href = `<?= BASE_URL ?>/admin/products/export/pdf`;
    }
</script>
