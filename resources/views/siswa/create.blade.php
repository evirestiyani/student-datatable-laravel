@extends('layouts.app')

@section('title', 'Tambah Data Siswa')
@section('page-title', 'Tambah Data Siswa')

@push('styles')
<style>
    .form-floating label {
        color: var(--text-secondary);
        font-weight: 500;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #ffc6c7;
        box-shadow: 0 0 0 0.25rem rgba(255, 198, 199, 0.25);
    }
    
    .form-control,
    .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }
    
    .form-control:hover,
    .form-select:hover {
        border-color: #cbd5e0;
    }
    
    .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        margin-top: 8px;
        padding-left: 16px;
    }
    
    .is-invalid {
        border-color: #f56565 !important;
        box-shadow: 0 0 0 0.25rem rgba(245, 101, 101, 0.25) !important;
    }
    
    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 20px;
    }
    
    .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: #5a67d8;
        text-decoration: underline;
    }
    
    .breadcrumb-item.active {
        color: var(--text-secondary);
    }
    
    .form-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        z-index: 10;
    }
    
    .form-control-icon {
        padding-left: 45px;
    }
    
    .input-group-custom {
        position: relative;
        margin-bottom: 24px;
    }
    
    .btn-action {
        min-width: 120px;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .form-section {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .section-header {
        background: linear-gradient(135deg, #ffc6c7 0%, #ff8ba7 100%);
        color: white;
        padding: 20px 30px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .section-title {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .section-body {
        padding: 30px;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
        border: none;
        border-left: 4px solid #4caf50;
        color: #2e7d32;
        border-radius: 8px;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: var(--border-radius);
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
    }
    
    .welcome-card h4 {
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .welcome-card p {
        margin: 0;
        opacity: 0.9;
    }
    
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        gap: 20px;
    }
    
    .step {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #f7fafc;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #4a5568;
    }
    
    .step.active {
        background: linear-gradient(135deg, #ffc6c7 0%, #ff8ba7 100%);
        color: white;
    }
    
    .form-help {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 4px;
    }
    
    .required-asterisk {
        color: #ef4444;
        margin-left: 4px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
                <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active">
                    <i class="fas fa-user-plus"></i>
                    <span>Input Data</span>
                </div>
                <div class="step">
                    <i class="fas fa-check"></i>
                    <span>Verifikasi</span>
                </div>
                <div class="step">
                    <i class="fas fa-save"></i>
                    <span>Simpan</span>
                </div>
            </div>

            <!-- Success Alert (jika ada session success) -->
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            @endif

            <!-- Form Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-user-graduate"></i>
                        Data Siswa Baru
                    </h2>
                </div>
                
                <div class="section-body">
                    <form action="{{ route('siswa.store') }}" method="POST" id="createSiswaForm">
                        @csrf

                        <div class="row">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        Nama Lengkap
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-user form-icon"></i>
                                        <input type="text" 
                                               name="nama" 
                                               id="nama" 
                                               class="form-control form-control-icon @error('nama') is-invalid @enderror" 
                                               value="{{ old('nama') }}" 
                                               placeholder="Masukkan nama lengkap siswa"
                                               required>
                                    </div>
                                    <div class="form-help">Masukkan nama lengkap sesuai dokumen resmi</div>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- NIS -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="nis" class="form-label">
                                        <i class="fas fa-id-card text-success me-2"></i>
                                        NIS (Nomor Induk Siswa)
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-hashtag form-icon"></i>
                                        <input type="text" 
                                               name="nis" 
                                               id="nis" 
                                               class="form-control form-control-icon @error('nis') is-invalid @enderror" 
                                               value="{{ old('nis') }}" 
                                               placeholder="Contoh: 1234567890"
                                               maxlength="10"
                                               required>
                                    </div>
                                    <div class="form-help">NIS harus unik dan tidak boleh sama dengan siswa lain</div>
                                    @error('nis')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kelas -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="kelas" class="form-label">
                                        <i class="fas fa-school text-warning me-2"></i>
                                        Kelas
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-chalkboard form-icon"></i>
                                        <input type="text" 
                                               name="kelas" 
                                               id="kelas" 
                                               class="form-control form-control-icon @error('kelas') is-invalid @enderror" 
                                               value="{{ old('kelas') }}" 
                                               placeholder="Contoh: XII IPA 1"
                                               required>
                                    </div>
                                    <div class="form-help">Format: Tingkat + Jurusan + Nomor Kelas</div>
                                    @error('kelas')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="jenis_kelamin" class="form-label">
                                        <i class="fas fa-venus-mars text-info me-2"></i>
                                        Jenis Kelamin
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <select name="jenis_kelamin" 
                                            id="jenis_kelamin" 
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'Laki-laki ' ? 'selected' : '' }}>
                                            👨 Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                            👩 Perempuan
                                        </option>
                                    </select>
                                    <div class="form-help">Pilih jenis kelamin siswa</div>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-12">
                                <div class="input-group-custom">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope text-danger me-2"></i>
                                        Email
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-at form-icon"></i>
                                        <input type="email" 
                                               name="email" 
                                               id="email" 
                                               class="form-control form-control-icon @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" 
                                               placeholder="contoh@gmail.com"
                                               required>
                                    </div>
                                    <div class="form-help">Email akan digunakan untuk komunikasi dan login sistem</div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Lahir (Optional) -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="tanggal_lahir" class="form-label">
                                        <i class="fas fa-calendar text-purple me-2"></i>
                                        Tanggal Lahir
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-calendar-alt form-icon"></i>
                                        <input type="date" 
                                               name="tanggal_lahir" 
                                               id="tanggal_lahir" 
                                               class="form-control form-control-icon @error('tanggal_lahir') is-invalid @enderror" 
                                               value="{{ old('tanggal_lahir') }}">
                                    </div>
                                    <div class="form-help">Opsional - untuk data lengkap siswa</div>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- No. Telepon (Optional) -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="no_telepon" class="form-label">
                                        <i class="fas fa-phone text-teal me-2"></i>
                                        No. Telepon
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-phone form-icon"></i>
                                        <input type="tel" 
                                               name="no_telepon" 
                                               id="no_telepon" 
                                               class="form-control form-control-icon @error('no_telepon') is-invalid @enderror" 
                                               value="{{ old('no_telepon') }}" 
                                               placeholder="08xxxxxxxxxx">
                                    </div>
                                    <div class="form-help">Opsional - untuk kontak darurat</div>
                                    @error('no_telepon')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('siswa.index') }}" 
                                       class="btn btn-secondary btn-action">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Kembali
                                    </a>
                                    
                                    <div class="d-flex gap-3">
                                        <button type="button" 
                                                class="btn btn-warning btn-action" 
                                                onclick="resetForm()">
                                            <i class="fas fa-broom me-2"></i>
                                            Bersihkan
                                        </button>
                                        
                                        <button type="submit" 
                                                class="btn btn-success btn-action">
                                            <i class="fas fa-plus me-2"></i>
                                            Tambah Siswa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-muted">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Tips Pengisian
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-check text-success me-2"></i>Periksa kembali NIS agar tidak duplikat</li>
                                <li><i class="fas fa-check text-success me-2"></i>Gunakan email yang valid dan aktif</li>
                                <li><i class="fas fa-check text-success me-2"></i>Format nama: Nama Depan Nama Belakang</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-muted">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Informasi
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-star text-warning me-2"></i>Field dengan tanda (*) wajib diisi</li>
                                <li><i class="fas fa-star text-warning me-2"></i>Data dapat diedit setelah disimpan</li>
                                <li><i class="fas fa-star text-warning me-2"></i>Sistem akan validasi otomatis</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin membersihkan semua form?')) {
            document.getElementById('createSiswaForm').reset();
            
            // Remove validation classes
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            
            // Reset step indicator
            updateStepIndicator(1);
        }
    }

    function updateStepIndicator(step) {
        const steps = document.querySelectorAll('.step');
        steps.forEach((stepEl, index) => {
            if (index < step) {
                stepEl.classList.add('active');
            } else {
                stepEl.classList.remove('active');
            }
        });
    }

    // Form validation
    document.getElementById('createSiswaForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        // Check required fields
        const requiredFields = ['nama', 'nis', 'kelas', 'jenis_kelamin', 'email'];
        
        requiredFields.forEach(field => {
            const input = document.getElementById(field);
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value && !emailRegex.test(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        }
        
        // NIS validation (must be unique - handle in backend)
        const nis = document.getElementById('nis');
        if (nis.value.length < 4) {
            nis.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan dengan benar.');
            updateStepIndicator(1);
        } else {
            updateStepIndicator(2);
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
        }
    });

    // Real-time validation
    document.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
            
            // Check if all required fields are filled
            const requiredFields = ['nama', 'nis', 'kelas', 'jenis_kelamin', 'email'];
            const allFilled = requiredFields.every(field => 
                document.getElementById(field).value.trim() !== ''
            );
            
            if (allFilled) {
                updateStepIndicator(2);
            } else {
                updateStepIndicator(1);
            }
        });
    });

    // Auto-format NIS (hanya angka)
    document.getElementById('nis').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Real-time NIS length validation
        if (this.value.length >= 4) {
            this.classList.remove('is-invalid');
        }
    });

    // Auto-capitalize nama
    document.getElementById('nama').addEventListener('input', function() {
        let words = this.value.split(' ');
        for (let i = 0; i < words.length; i++) {
            if (words[i].length > 0) {
                words[i] = words[i][0].toUpperCase() + words[i].substr(1).toLowerCase();
            }
        }
        this.value = words.join(' ');
    });

    // Auto-format phone number
    document.getElementById('no_telepon').addEventListener('input', function() {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Ensure it starts with 08
        if (this.value.length > 0 && !this.value.startsWith('08')) {
            if (this.value.startsWith('8')) {
                this.value = '0' + this.value;
            }
        }
        
        // Limit length
        if (this.value.length > 13) {
            this.value = this.value.substring(0, 13);
        }
    });

    // Set max date for birth date (today)
    document.getElementById('tanggal_lahir').max = new Date().toISOString().split('T')[0];
    
    // Set min date for birth date (100 years ago)
    const hundredYearsAgo = new Date();
    hundredYearsAgo.setFullYear(hundredYearsAgo.getFullYear() - 100);
    document.getElementById('tanggal_lahir').min = hundredYearsAgo.toISOString().split('T')[0];
</script>
@endpush