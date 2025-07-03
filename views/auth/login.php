<?php $pageTitle = 'Login'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <img src="<?= BASE_URL ?>/assets/images/logo.png" alt="UNU Yogyakarta" height="80" class="mb-3">
                        <h4 class="card-title mb-1">Selamat Datang Kembali!</h4>
                        <p class="text-muted">Silakan login untuk melanjutkan</p>
                    </div>

                    <form action="<?= BASE_URL ?>/landing/processLogin" method="POST" class="needs-validation" novalidate>
                        <!-- Username Field -->
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="username" 
                                   name="username" 
                                   placeholder="Username"
                                   required
                                   autofocus>
                            <label for="username">Username</label>
                            <div class="invalid-feedback">
                                Username harus diisi
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating mb-4">
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Password"
                                   required>
                            <label for="password">Password</label>
                            <div class="invalid-feedback">
                                Password harus diisi
                            </div>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label text-muted" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </div>
                    </form>

                    <!-- Links -->
                    <div class="text-center mt-4">
                        <p class="mb-2">
                            <a href="<?= BASE_URL ?>/landing/forgotPassword" class="text-muted text-decoration-none">
                                <i class="fas fa-lock me-1"></i> Lupa password?
                            </a>
                        </p>
                        <p class="mb-0">
                            Belum punya akun? 
                            <a href="<?= BASE_URL ?>/landing/register" class="text-primary text-decoration-none">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="text-center mt-4">
                <p class="text-muted small mb-0">
                    Dengan login, Anda menyetujui 
                    <a href="<?= BASE_URL ?>/terms" class="text-decoration-none">Syarat & Ketentuan</a> 
                    dan 
                    <a href="<?= BASE_URL ?>/privacy" class="text-decoration-none">Kebijakan Privasi</a> 
                    kami.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Login Page -->
<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 10px;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #3498db;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }

    .form-check-input:checked {
        background-color: #3498db;
        border-color: #3498db;
    }

    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        padding: 12px;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
</style>

<!-- Form Validation Script -->
<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Password visibility toggle
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.createElement('button');
        togglePassword.type = 'button';
        togglePassword.className = 'btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y me-2';
        togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
        togglePassword.style.zIndex = '10';
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });

        passwordInput.parentElement.style.position = 'relative';
        passwordInput.parentElement.appendChild(togglePassword);
    });
</script>
