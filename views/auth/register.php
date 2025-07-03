<?php $pageTitle = 'Daftar Akun'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <img src="<?= BASE_URL ?>/assets/images/logo.png" alt="UNU Yogyakarta" height="80" class="mb-3">
                        <h4 class="card-title mb-1">Daftar Akun Baru</h4>
                        <p class="text-muted">Lengkapi form di bawah untuk membuat akun</p>
                    </div>

                    <form action="<?= BASE_URL ?>/landing/processRegister" method="POST" class="needs-validation" novalidate>
                        <!-- Name Field -->
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Nama Lengkap"
                                   required
                                   autofocus>
                            <label for="name">Nama Lengkap</label>
                            <div class="invalid-feedback">
                                Nama lengkap harus diisi
                            </div>
                        </div>

                        <!-- Username Field -->
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="username" 
                                   name="username" 
                                   placeholder="Username"
                                   pattern="[a-zA-Z0-9_]{5,20}"
                                   required>
                            <label for="username">Username</label>
                            <div class="invalid-feedback">
                                Username harus terdiri dari 5-20 karakter (huruf, angka, dan underscore)
                            </div>
                            <small class="form-text text-muted">
                                Username akan digunakan untuk login
                            </small>
                        </div>

                        <!-- Email Field -->
                        <div class="form-floating mb-3">
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Email"
                                   required>
                            <label for="email">Email</label>
                            <div class="invalid-feedback">
                                Email harus valid
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating mb-3">
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Password"
                                   pattern=".{6,}"
                                   required>
                            <label for="password">Password</label>
                            <div class="invalid-feedback">
                                Password minimal 6 karakter
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-floating mb-4">
                            <input type="password" 
                                   class="form-control" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   placeholder="Konfirmasi Password"
                                   required>
                            <label for="confirm_password">Konfirmasi Password</label>
                            <div class="invalid-feedback">
                                Password tidak cocok
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="terms" 
                                   name="terms" 
                                   required>
                            <label class="form-check-label text-muted" for="terms">
                                Saya menyetujui <a href="<?= BASE_URL ?>/terms" class="text-decoration-none">Syarat & Ketentuan</a> 
                                dan <a href="<?= BASE_URL ?>/privacy" class="text-decoration-none">Kebijakan Privasi</a>
                            </label>
                            <div class="invalid-feedback">
                                Anda harus menyetujui syarat dan ketentuan
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i> Daftar
                            </button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <p class="mb-0">
                            Sudah punya akun? 
                            <a href="<?= BASE_URL ?>/landing/login" class="text-primary text-decoration-none">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Register Page -->
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

    .password-strength {
        height: 5px;
        margin-top: 5px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
</style>

<!-- Form Validation and Password Strength Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const form = document.querySelector('.needs-validation');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Check if passwords match
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Passwords do not match');
                event.preventDefault();
                event.stopPropagation();
            } else {
                confirmPassword.setCustomValidity('');
            }

            form.classList.add('was-validated');
        }, false);

        // Password strength indicator
        function createPasswordStrengthIndicator() {
            const strengthDiv = document.createElement('div');
            strengthDiv.className = 'password-strength';
            password.parentElement.appendChild(strengthDiv);

            password.addEventListener('input', function() {
                const strength = calculatePasswordStrength(this.value);
                updateStrengthIndicator(strengthDiv, strength);
            });
        }

        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            return strength;
        }

        function updateStrengthIndicator(element, strength) {
            element.style.width = strength + '%';
            
            if (strength < 25) {
                element.style.backgroundColor = '#dc3545';
            } else if (strength < 50) {
                element.style.backgroundColor = '#ffc107';
            } else if (strength < 75) {
                element.style.backgroundColor = '#17a2b8';
            } else {
                element.style.backgroundColor = '#28a745';
            }
        }

        // Password visibility toggle
        function createPasswordToggle(inputElement) {
            const toggleButton = document.createElement('button');
            toggleButton.type = 'button';
            toggleButton.className = 'btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y me-2';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
            toggleButton.style.zIndex = '10';
            
            toggleButton.addEventListener('click', function() {
                const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
                inputElement.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });

            inputElement.parentElement.style.position = 'relative';
            inputElement.parentElement.appendChild(toggleButton);
        }

        // Initialize features
        createPasswordStrengthIndicator();
        createPasswordToggle(password);
        createPasswordToggle(confirmPassword);

        // Real-time password match validation
        confirmPassword.addEventListener('input', function() {
            if (this.value === password.value) {
                this.setCustomValidity('');
            } else {
                this.setCustomValidity('Passwords do not match');
            }
        });
    });
</script>
