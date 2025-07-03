<?php $pageTitle = 'Manajemen Ruangan'; ?>

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
                        <a class="nav-link active" href="<?= BASE_URL ?>/admin/rooms">
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
                <h1 class="h2">Manajemen Ruangan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#addRoomModal">
                        <i class="fas fa-plus me-1"></i> Tambah Ruangan
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
                               placeholder="Cari ruangan..."
                               onkeyup="filterRooms()">
                        <button class="btn btn-outline-secondary dropdown-toggle" 
                                type="button" 
                                data-bs-toggle="dropdown">
                            Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCapacity('all')">
                                    Semua Kapasitas
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCapacity('small')">
                                    < 30 Orang
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCapacity('medium')">
                                    30-50 Orang
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByCapacity('large')">
                                    > 50 Orang
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

            <!-- Rooms Grid -->
            <div class="row g-4">
                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $room): ?>
                        <div class="col-md-6 col-lg-4 room-card" 
                             data-capacity="<?= $room['capacity'] ?>"
                             data-status="<?= $room['status'] ?>">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="<?= BASE_URL ?>/assets/images/rooms/<?= $room['image'] ?? 'default.jpg' ?>" 
                                     class="card-img-top room-image" 
                                     alt="<?= htmlspecialchars($room['name']) ?>">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0"><?= htmlspecialchars($room['name']) ?></h5>
                                        <span class="badge bg-<?= $room['status'] === 'available' ? 'success' : 'warning' ?>">
                                            <?= $room['status'] === 'available' ? 'Tersedia' : 'Maintenance' ?>
                                        </span>
                                    </div>
                                    <div class="room-details mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>Kapasitas: <?= $room['capacity'] ?> orang</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-tools text-primary me-2"></i>
                                            <span>Fasilitas: <?= htmlspecialchars($room['facilities']) ?></span>
                                        </div>
                                    </div>
                                    <div class="btn-group w-100">
                                        <button type="button" 
                                                class="btn btn-info text-white"
                                                onclick="viewRoom(<?= $room['id'] ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-primary"
                                                onclick="editRoom(<?= $room['id'] ?>)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-danger"
                                                onclick="deleteRoom(<?= $room['id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak ada ruangan yang tersedia.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Ruangan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/rooms/add" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="facilities" class="form-label">Fasilitas</label>
                        <textarea class="form-control" id="facilities" name="facilities" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Ruangan</label>
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

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editRoomForm" method="POST" enctype="multipart/form-data">
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

    .room-image {
        height: 200px;
        object-fit: cover;
    }

    .card {
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
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
    // Filter rooms
    function filterRooms() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.getElementsByClassName('room-card');

        for (let card of cards) {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const facilities = card.querySelector('.room-details').textContent.toLowerCase();
            
            if (title.includes(filter) || facilities.includes(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        }
    }

    // Filter by capacity
    function filterByCapacity(size) {
        const cards = document.getElementsByClassName('room-card');
        
        for (let card of cards) {
            const capacity = parseInt(card.dataset.capacity);
            let show = false;

            switch(size) {
                case 'small':
                    show = capacity < 30;
                    break;
                case 'medium':
                    show = capacity >= 30 && capacity <= 50;
                    break;
                case 'large':
                    show = capacity > 50;
                    break;
                default:
                    show = true;
            }

            card.style.display = show ? '' : 'none';
        }
    }

    // View room details
    function viewRoom(id) {
        window.location.href = `<?= BASE_URL ?>/admin/rooms/view/${id}`;
    }

    // Edit room
    function editRoom(id) {
        fetch(`<?= BASE_URL ?>/admin/rooms/get/${id}`)
            .then(response => response.json())
            .then(room => {
                const form = document.getElementById('editRoomForm');
                form.action = `<?= BASE_URL ?>/admin/rooms/edit/${id}`;
                
                const modalBody = form.querySelector('.modal-body');
                modalBody.innerHTML = `
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="edit_name" name="name" value="${room.name}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control" id="edit_capacity" name="capacity" min="1" value="${room.capacity}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_facilities" class="form-label">Fasilitas</label>
                        <textarea class="form-control" id="edit_facilities" name="facilities" rows="3">${room.facilities}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3">${room.description}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Gambar Ruangan</label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="available" ${room.status === 'available' ? 'selected' : ''}>Tersedia</option>
                            <option value="maintenance" ${room.status === 'maintenance' ? 'selected' : ''}>Maintenance</option>
                        </select>
                    </div>
                `;
                
                new bootstrap.Modal(document.getElementById('editRoomModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data ruangan');
            });
    }

    // Delete room
    function deleteRoom(id) {
        if (confirm('Apakah Anda yakin ingin menghapus ruangan ini?')) {
            window.location.href = `<?= BASE_URL ?>/admin/rooms/delete/${id}`;
        }
    }

    // Export to Excel
    function exportToExcel() {
        window.location.href = `<?= BASE_URL ?>/admin/rooms/export/excel`;
    }

    // Export to PDF
    function exportToPDF() {
        window.location.href = `<?= BASE_URL ?>/admin/rooms/export/pdf`;
    }
</script>
