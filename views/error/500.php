<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error | UNU Yogyakarta</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
        }

        .error-icon {
            width: 150px;
            height: 150px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse 2s infinite;
        }

        .error-icon i {
            font-size: 4rem;
            color: #dc2626;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .text-muted {
            color: #7f8c8d !important;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-outline-secondary {
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0);
            }
        }

        .error-details {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: left;
            display: none;
        }

        .error-details.show {
            display: block;
        }

        .error-details pre {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin: 0;
            overflow-x: auto;
        }

        @media (max-width: 576px) {
            .error-icon {
                width: 120px;
                height: 120px;
            }

            .error-icon i {
                font-size: 3rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-container">
            <!-- Error Icon -->
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <!-- Title & Description -->
            <h1>Internal Server Error</h1>
            <p class="text-muted mb-4">
                Maaf, terjadi kesalahan pada server kami.
                <br>Tim teknis kami sedang menangani masalah ini.
            </p>

            <!-- Action Buttons -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button onclick="window.location.reload()" class="btn btn-outline-secondary">
                    <i class="fas fa-sync-alt me-2"></i> Muat Ulang
                </button>
                <a href="<?= BASE_URL ?>" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                </a>
            </div>

            <!-- Error Details (Only shown in debug mode) -->
            <?php if (defined('DEBUG_MODE') && DEBUG_MODE): ?>
                <div class="error-details">
                    <h6 class="mb-3">Error Details:</h6>
                    <pre><?= isset($errorMessage) ? htmlspecialchars($errorMessage) : 'No error details available.' ?></pre>
                    <?php if (isset($errorTrace)): ?>
                        <h6 class="mt-3 mb-2">Stack Trace:</h6>
                        <pre><?= htmlspecialchars($errorTrace) ?></pre>
                    <?php endif; ?>
                </div>
                <p class="mt-3">
                    <button class="btn btn-sm btn-outline-secondary" onclick="toggleErrorDetails()">
                        <i class="fas fa-code me-1"></i> Toggle Error Details
                    </button>
                </p>
            <?php endif; ?>

            <!-- Contact Information -->
            <div class="mt-4">
                <p class="text-muted mb-2">
                    Jika masalah berlanjut, silakan hubungi tim support:
                </p>
                <p class="mb-0">
                    <a href="mailto:support@unu-jogja.ac.id" class="text-decoration-none">
                        <i class="fas fa-envelope me-2"></i>support@unu-jogja.ac.id
                    </a>
                </p>
            </div>

            <!-- Error ID -->
            <?php if (isset($errorId)): ?>
                <p class="mt-4 mb-0">
                    <small class="text-muted">Error ID: <?= htmlspecialchars($errorId) ?></small>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Toggle error details visibility
        function toggleErrorDetails() {
            const details = document.querySelector('.error-details');
            details.classList.toggle('show');
        }

        // Auto-reload after 5 minutes if debug mode is off
        <?php if (!defined('DEBUG_MODE') || !DEBUG_MODE): ?>
            setTimeout(function() {
                window.location.reload();
            }, 300000);
        <?php endif; ?>
    </script>
</body>
</html>
