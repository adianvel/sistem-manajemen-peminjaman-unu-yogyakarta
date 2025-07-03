<?php $pageTitle = 'Ruangan'; ?>

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
                        <a class="nav-link" href="<?= BASE_URL ?>/user/products">
                            <i class="fas fa-laptop me-2"></i> Produk Elektronik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL ?>/user/rooms">
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
                <h1 class="h2">Ruangan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
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
            </div>

            <!-- Rooms Grid -->
            <div class="row g-4">
                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $room): ?>
                        <div class="col-md-6 col-lg-4 room-card" 
                             data-capacity="<?= $room['capacity'] ?>">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="<?= BASE_URL ?>/assets/images/rooms/<?= $room['image'] ?? 'default.jpg' ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($room['name']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                                    <p class="card-text text-muted">
                                        <?= htmlspecialchars($room['description']) ?>
                                    </p>
                                    <div class="room-details">
                                        <div class="mb-2">
                                            <i class="fas fa-users text-primary"></i>
                                            <span>Kapasitas: <?= $room['capacity'] ?> orang</span>
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-tools text-primary"></i>
                                            <span>Fasilitas: <?= htmlspecialchars($room['facilities']) ?></span>
                                        </div>
                                        <div>
                                            <i class="fas fa-circle text-<?= $room['status'] === 'available' ? 'success' : 'danger' ?>"></i>
                                            <span><?= $room['status'] === 'available' ? 'Tersedia' : 'Tidak Tersedia' ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0 pt-0">
                                    <div class="d-grid">
                                        <button type="button" 
                                                class="btn btn-primary"
                                                <?= $room['status'] === 'available' ? '' : 'disabled' ?>
                                                onclick="showBookingModal(<?= $room['id'] ?>)">
                                            <i class="fas fa-calendar-plus me-1"></i> Booking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak ada ruangan yang tersedia saat ini.
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
                <h5 class="modal-title">Form Booking Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/user/book-room" method="POST" id="bookingForm">
                <div class="modal-body">
                    <input type="hidden" name="room_id" id="roomId">
                    
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Tanggal & Waktu Mulai</label>
                        <input type="datetime-local" 
                               class="form-control" 
                               id="startDate" 
                               name="start_date"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Tanggal & Waktu Selesai</label>
                        <input type="datetime-local" 
                               class="form-control" 
                               id="endDate" 
                               name="end_date"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="purpose" class="form-label">Tujuan Penggunaan</label>
                        <textarea class="form-control" 
                                  id="purpose" 
                                  name="purpose" 
                                  rows="3"
                                  required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="participants" class="form-label">Jumlah Peserta</label>
                        <input type="number" 
                               class="form-control" 
                               id="participants" 
                               name="participants"
                               min="1"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ajukan Booking</button>
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

    .room-details {
        font-size: 0.9rem;
    }

    .room-details i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
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
    function showBookingModal(roomId) {
        document.getElementById('roomId').value = roomId;
        
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

    // Filter rooms by search input
    function filterRooms() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.getElementsByClassName('room-card');

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

    // Filter rooms by capacity
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

    // Validate booking form
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        const participants = parseInt(document.getElementById('participants').value);
        
        if (endDate <= startDate) {
            e.preventDefault();
            alert('Waktu selesai harus setelah waktu mulai');
            return;
        }

        // Check if booking is within working hours (8 AM - 9 PM)
        if (startDate.getHours() < 8 || startDate.getHours() >= 21 ||
            endDate.getHours() < 8 || endDate.getHours() >= 21) {
            e.preventDefault();
            alert('Booking hanya tersedia antara jam 08:00 - 21:00');
            return;
        }

        // Validate duration (max 4 hours)
        const duration = (endDate - startDate) / (1000 * 60 * 60); // hours
        if (duration > 4) {
            e.preventDefault();
            alert('Maksimal durasi booking adalah 4 jam');
            return;
        }
    });
</script>
