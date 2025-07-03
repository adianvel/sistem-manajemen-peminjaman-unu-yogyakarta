<?php $pageTitle = 'Manajemen Pengguna'; ?>

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
                        <a class="nav-link active" href="<?= BASE_URL ?>/admin/users">
                            <i class="fas fa-users me-2"></i> Pengguna
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Pengguna</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#addUserModal">
                        <i class="fas fa-user-plus me-1"></i> Tambah Pengguna
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
                               placeholder="Cari pengguna..."
                               onkeyup="filterUsers()">
                        <button class="btn btn-outline-secondary dropdown-toggle" 
                                type="button" 
                                data-bs-toggle="dropdown">
                            Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByRole('all')">
                                    Semua Role
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByRole('admin')">
                                    Admin
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="filterByRole('user')">
                                    User
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary" onclick="exportToExcel()">
                            <i class="fas fa-file-excel me-1"></i> Export Data
                        </button>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Terdaftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr class="user-row" data-role="<?= $user['role'] ?>">
                                            <td>#<?= $user['id'] ?></td>
                                            <td><?= htmlspecialchars($user['name']) ?></td>
                                            <td><?= htmlspecialchars($user['username']) ?></td>
                                            <td><?= htmlspecialchars($user['email']) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'primary' ?>">
                                                    <?= ucfirst($user['role']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $user['active'] ? 'success' : 'secondary' ?>">
                                                    <?= $user['active'] ? 'Aktif' : 'Nonaktif' ?>
                                                </span>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-info text-white"
                                                            onclick="viewUser(<?= $user['id'] ?>)">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-primary"
                                                            onclick="editUser(<?= $user['id'] ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <?php if ($user['id'] !== $_SESSION['user']['id']): ?>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-<?= $user['active'] ? 'warning' : 'success' ?>"
                                                                onclick="toggleUserStatus(<?= $user['id'] ?>, <?= $user['active'] ?>)">
                                                            <i class="fas fa-<?= $user['active'] ? 'ban' : 'check' ?>"></i>
                                                        </button>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-danger"
                                                                onclick="deleteUser(<?= $user['id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada pengguna yang tersedia.</td>
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/users/add" method="POST" id="addUserForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST">
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

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="userDetails">
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
    // Filter users
    function filterUsers() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const rows = document.getElementsByClassName('user-row');

        for (let row of rows) {
            const name = row.cells[1].textContent.toLowerCase();
            const username = row.cells[2].textContent.toLowerCase();
            const email = row.cells[3].textContent.toLowerCase();
            
            if (name.includes(filter) || username.includes(filter) || email.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    // Filter by role
    function filterByRole(role) {
        const rows = document.getElementsByClassName('user-row');
        
        for (let row of rows) {
            if (role === 'all' || row.dataset.role === role) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    // View user details
    function viewUser(id) {
        fetch(`<?= BASE_URL ?>/admin/users/details/${id}`)
            .then(response => response.json())
            .then(data => {
                const details = document.getElementById('userDetails');
                details.innerHTML = `
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">#${data.id}</dd>
                        
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8">${data.name}</dd>
                        
                        <dt class="col-sm-4">Username</dt>
                        <dd class="col-sm-8">${data.username}</dd>
                        
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">${data.email}</dd>
                        
                        <dt class="col-sm-4">Role</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-${data.role === 'admin' ? 'danger' : 'primary'}">
                                ${data.role === 'admin' ? 'Admin' : 'User'}
                            </span>
                        </dd>
                        
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-${data.active ? 'success' : 'secondary'}">
                                ${data.active ? 'Aktif' : 'Nonaktif'}
                            </span>
                        </dd>
                        
                        <dt class="col-sm-4">Terdaftar</dt>
                        <dd class="col-sm-8">${new Date(data.created_at).toLocaleString()}</dd>
                        
                        <dt class="col-sm-4">Total Peminjaman</dt>
                        <dd class="col-sm-8">${data.total_bookings}</dd>
                    </dl>
                `;
                
                new bootstrap.Modal(document.getElementById('userDetailsModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat detail pengguna');
            });
    }

    // Edit user
    function editUser(id) {
        fetch(`<?= BASE_URL ?>/admin/users/get/${id}`)
            .then(response => response.json())
            .then(user => {
                const form = document.getElementById('editUserForm');
                form.action = `<?= BASE_URL ?>/admin/users/edit/${id}`;
                
                const modalBody = form.querySelector('.modal-body');
                modalBody.innerHTML = `
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit_name" name="name" value="${user.name}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" value="${user.email}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select class="form-select" id="edit_role" name="role" required>
                            <option value="user" ${user.role === 'user' ? 'selected' : ''}>User</option>
                            <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                    </div>
                `;
                
                new bootstrap.Modal(document.getElementById('editUserModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data pengguna');
            });
    }

    // Toggle user status
    function toggleUserStatus(id, currentStatus) {
        const action = currentStatus ? 'menonaktifkan' : 'mengaktifkan';
        if (confirm(`Apakah Anda yakin ingin ${action} pengguna ini?`)) {
            window.location.href = `<?= BASE_URL ?>/admin/users/toggle/${id}`;
        }
    }

    // Delete user
    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
            window.location.href = `<?= BASE_URL ?>/admin/users/delete/${id}`;
        }
    }

    // Export to Excel
    function exportToExcel() {
        window.location.href = `<?= BASE_URL ?>/admin/users/export/excel`;
    }

    // Form validation
    document.getElementById('addUserForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        if (password.length < 6) {
            e.preventDefault();
            alert('Password harus minimal 6 karakter');
        }
    });
</script>
