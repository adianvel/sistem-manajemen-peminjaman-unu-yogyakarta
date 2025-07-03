<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - UNU Yogyakarta</title>
    
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

        .maintenance-container {
            text-align: center;
            max-width: 600px;
        }

        .maintenance-icon {
            width: 150px;
            height: 150px;
            background: #e3f2fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse 2s infinite;
        }

        .maintenance-icon i {
            font-size: 4rem;
            color: #3498db;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .text-muted {
            color: #7f8c8d !important;
        }

        .progress {
            height: 10px;
            border-radius: 5px;
            margin: 2rem 0;
        }

        .progress-bar {
            background-color: #3498db;
            animation: progress 2s linear infinite;
        }

        .status-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .status-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .status-item:last-child {
            margin-bottom: 0;
        }

        .status-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .status-icon.working {
            background-color: #e3f2fd;
            color: #3498db;
        }

        .status-icon.maintenance {
            background-color: #fff3cd;
            color: #ffc107;
        }

        .contact-info {
            margin-top: 2rem;
            padding: 1rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .contact-info a {
            color: #3498db;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(52, 152, 219, 0.4);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(52, 152, 219, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(52, 152, 219, 0);
            }
        }

        @keyframes progress {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .maintenance-icon {
                width: 120px;
                height: 120px;
            }

            .maintenance-icon i {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="maintenance-container">
            <!-- Maintenance Icon -->
            <div class="maintenance-icon">
                <i class="fas fa-wrench"></i>
            </div>

            <!-- Title & Description -->
            <h1>Sedang Dalam Perbaikan</h1>
            <p class="text-muted mb-4">
                Sistem sedang dalam pemeliharaan untuk meningkatkan kualitas layanan.
                <br>Mohon maaf atas ketidaknyamanannya.
            </p>

            <!-- Progress Bar -->
            <div class="progress">
                <div class="progress-bar" role="progressbar"></div>
            </div>

            <!-- Estimated Time -->
            <p class="text-muted mb-4">
                Estimasi waktu: <?= isset($estimatedTime) ? $estimatedTime : '30 menit' ?>
            </p>

            <!-- System Status -->
            <div class="status-card">
                <h5 class="mb-3">Status Sistem</h5>
                <div class="status-item">
                    <div class="status-icon maintenance">
                        <i class="fas fa-database"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">Database</h6>
                        <small class="text-warning">Maintenance</small>
                    </div>
                </div>
                <div class="status-item">
                    <div class="status-icon working">
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">Server</h6>
                        <small class="text-primary">Working</small>
                    </div>
                </div>
                <div class="status-item">
                    <div class="status-icon working">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0">Security</h6>
                        <small class="text-primary">Working</small>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h6>Butuh Bantuan?</h6>
                <p class="mb-2">
                    <i class="fas fa-envelope me-2"></i>
                    <a href="mailto:support@unu-jogja.ac.id">support@unu-jogja.ac.id</a>
                </p>
                <p class="mb-0">
                    <i class="fas fa-phone me-2"></i>
                    <a href="tel:+62274123456">(0274) 123456</a>
                </p>
            </div>

            <!-- Auto Refresh Notice -->
            <p class="text-muted mt-4 mb-0">
                <small>
                    <i class="fas fa-sync-alt me-1"></i>
                    Halaman akan diperbarui otomatis setiap 30 detik
                </small>
            </p>
        </div>
    </div>

    <!-- Auto Refresh Script -->
    <script>
        // Refresh page every 30 seconds
        setTimeout(function() {
            window.location.reload();
        }, 30000);

        // Update progress bar width randomly between 70-90%
        document.addEventListener('DOMContentLoaded', function() {
            const progress = Math.floor(Math.random() * (90 - 70 + 1)) + 70;
            document.querySelector('.progress-bar').style.width = progress + '%';
        });
    </script>
</body>
</html>
