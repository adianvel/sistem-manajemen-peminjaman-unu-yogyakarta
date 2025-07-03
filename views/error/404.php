<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | UNU Yogyakarta</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
        }
        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: #3498db;
            line-height: 1;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 2rem;
        }
        .home-button {
            background-color: #3498db;
            border-color: #3498db;
            padding: 12px 30px;
            font-weight: 500;
        }
        .home-button:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-container">
            <div class="error-code">404</div>
            <h1 class="error-message">Halaman Tidak Ditemukan</h1>
            <p class="text-muted mb-4">
                Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
                <br>Silakan kembali ke halaman utama.
            </p>
            <div class="d-grid gap-2 d-md-block">
                <a href="<?= BASE_URL ?>" class="btn btn-primary home-button">
                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                </a>
                <button onclick="history.back()" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </button>
            </div>
            <div class="mt-4">
                <a href="<?= BASE_URL ?>/contact" class="text-muted text-decoration-none me-3">
                    <i class="fas fa-envelope me-1"></i> Hubungi Kami
                </a>
                <a href="<?= BASE_URL ?>/help" class="text-muted text-decoration-none">
                    <i class="fas fa-question-circle me-1"></i> Bantuan
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        console.log('404 Error: Page not found - ' + window.location.pathname);
        setTimeout(function() {
            window.location.href = '<?= BASE_URL ?>';
        }, 60000);
    </script>
</body>
</html>
