</main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="mb-3">UNU Yogyakarta</h5>
                    <p class="text-muted">
                        Sistem Manajemen Peminjaman Produk Elektronik dan Ruangan untuk kegiatan akademik dan organisasi.
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?= BASE_URL ?>" class="text-decoration-none text-muted">
                                <i class="fas fa-home"></i> Beranda
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= BASE_URL ?>/about" class="text-decoration-none text-muted">
                                <i class="fas fa-info-circle"></i> Tentang Kami
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= BASE_URL ?>/contact" class="text-decoration-none text-muted">
                                <i class="fas fa-envelope"></i> Kontak
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt"></i> Alamat: Jl. Raya Yogyakarta
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone"></i> Telepon: (0274) 123456
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope"></i> Email: info@unu-jogja.ac.id
                        </li>
                    </ul>
                    <div class="social-links mt-3">
                        <a href="#" class="text-muted me-3">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-muted me-3">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-muted me-3">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-muted">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted mb-0">
                        &copy; <?= date('Y') ?> UNU Yogyakarta. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        // Confirm delete actions
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('delete-form')) {
                if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>
</html>
