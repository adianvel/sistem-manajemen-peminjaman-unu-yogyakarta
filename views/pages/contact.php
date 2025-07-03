<?php $pageTitle = 'Hubungi Kami'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="text-center mb-4">Hubungi Kami</h1>
                    <p class="text-muted text-center mb-5">
                        Punya pertanyaan atau masukan? Kami siap membantu Anda
                    </p>

                    <div class="row mb-5">
                        <!-- Contact Methods -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="contact-card">
                                <div class="icon-wrapper">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Email</h5>
                                <p class="mb-1">Respon dalam 24 jam</p>
                                <a href="mailto:support@unu-jogja.ac.id" class="text-decoration-none">
                                    support@unu-jogja.ac.id
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="contact-card">
                                <div class="icon-wrapper">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h5>Telepon</h5>
                                <p class="mb-1">Senin - Jumat, 08:00 - 16:00</p>
                                <a href="tel:+62274123456" class="text-decoration-none">
                                    (0274) 123456
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contact-card">
                                <div class="icon-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h5>Lokasi</h5>
                                <p class="mb-1">Gedung Administrasi Lt. 1</p>
                                <a href="#map" class="text-decoration-none">
                                    Lihat Peta
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="row">
                        <div class="col-12">
                            <form action="<?= BASE_URL ?>/contact/send" method="POST" id="contactForm" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="name" 
                                                   name="name" 
                                                   placeholder="Nama Lengkap"
                                                   required>
                                            <label for="name">Nama Lengkap</label>
                                            <div class="invalid-feedback">
                                                Nama lengkap harus diisi
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
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
                                    </div>

                                    <!-- Subject -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select class="form-select" 
                                                    id="subject" 
                                                    name="subject" 
                                                    required>
                                                <option value="">Pilih Subjek</option>
                                                <option value="general">Pertanyaan Umum</option>
                                                <option value="technical">Masalah Teknis</option>
                                                <option value="booking">Peminjaman</option>
                                                <option value="feedback">Saran/Masukan</option>
                                                <option value="other">Lainnya</option>
                                            </select>
                                            <label for="subject">Subjek</label>
                                            <div class="invalid-feedback">
                                                Silakan pilih subjek
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" 
                                                      id="message" 
                                                      name="message" 
                                                      placeholder="Pesan"
                                                      style="height: 150px"
                                                      required></textarea>
                                            <label for="message">Pesan</label>
                                            <div class="invalid-feedback">
                                                Pesan tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Attachment -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="attachment" class="form-label">Lampiran (opsional)</label>
                                            <input type="file" 
                                                   class="form-control" 
                                                   id="attachment" 
                                                   name="attachment"
                                                   accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                            <div class="form-text">
                                                Maksimal ukuran file: 5MB (JPG, PNG, PDF, DOC)
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="row mt-5" id="map">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-0">
                                    <div class="ratio ratio-16x9">
                                        <iframe 
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1675753692247!2d110.3795833!3d-7.7815556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDYnNTMuNiJTIDExMMKwMjInNDYuNSJF!5e0!3m2!1sen!2sid!4v1635825645789!5m2!1sen!2sid" 
                                            width="600" 
                                            height="450" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .contact-card {
        text-align: center;
        padding: 1.5rem;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        background: #e3f2fd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .icon-wrapper i {
        font-size: 1.5rem;
        color: #3498db;
    }

    .contact-card h5 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .contact-card p {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .contact-card a {
        color: #3498db;
    }

    .form-floating > .form-control,
    .form-floating > .form-select {
        height: calc(3.5rem + 2px);
        line-height: 1.25;
    }

    .form-floating > textarea.form-control {
        height: 150px;
    }

    .btn-primary {
        padding: 1rem 2rem;
        font-weight: 500;
    }

    .card {
        border-radius: 15px;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }
</style>

<!-- Form Validation Script -->
<script>
    // Form validation
    (function() {
        'use strict';
        
        const form = document.getElementById('contactForm');
        
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    })();

    // File size validation
    document.getElementById('attachment').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        if (file && file.size > maxSize) {
            alert('Ukuran file terlalu besar. Maksimal 5MB.');
            this.value = '';
        }
    });

    // Smooth scroll to map
    document.querySelector('a[href="#map"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#map').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
