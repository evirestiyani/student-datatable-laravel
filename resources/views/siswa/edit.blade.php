@extends('layouts.app')

@section('title', 'Edit Data Siswa')
@section('page-title', 'Edit Data Siswa')

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
    
    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: none;
        border-left: 4px solid #2196f3;
        color: #1976d2;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Alert Info -->
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Perhatian!</strong> Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan.
            </div>

            <!-- Form Section -->
            <div class="form-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-user-edit"></i>
                        Edit Data Siswa
                    </h2>
                </div>
                
                <div class="section-body">
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" id="editSiswaForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        Nama Lengkap
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-user form-icon"></i>
                                        <input type="text" 
                                               name="nama" 
                                               id="nama" 
                                               class="form-control form-control-icon @error('nama') is-invalid @enderror" 
                                               value="{{ old('nama', $siswa->nama) }}" 
                                               placeholder="Masukkan nama lengkap"
                                               required>
                                    </div>
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
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-hashtag form-icon"></i>
                                        <input type="text" 
                                               name="nis" 
                                               id="nis" 
                                               class="form-control form-control-icon @error('nis') is-invalid @enderror" 
                                               value="{{ old('nis', $siswa->nis) }}" 
                                               placeholder="Masukkan NIS"
                                               required>
                                    </div>
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
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-chalkboard form-icon"></i>
                                        <input type="text" 
                                               name="kelas" 
                                               id="kelas" 
                                               class="form-control form-control-icon @error('kelas') is-invalid @enderror" 
                                               value="{{ old('kelas', $siswa->kelas) }}" 
                                               placeholder="Contoh: XII IPA 1"
                                               required>
                                    </div>
                                    @error('kelas')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6">
                                <div class="input-group-custom">
                                    <label for="jenis_kelamin" class="form-label">
                                        <i class="fas fa-venus-mars text-info me-2"></i>
                                        Jenis Kelamin
                                    </label>
                                    <select name="jenis_kelamin" 
                                            id="jenis_kelamin" 
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                            👨 Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                            👩 Perempuan
                                        </option>
                                    </select>
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
                                    </label>
                                    <div class="position-relative">
                                        <i class="fas fa-at form-icon"></i>
                                        <input type="email" 
                                               name="email" 
                                               id="email" 
                                               class="form-control form-control-icon @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $siswa->email) }}" 
                                               placeholder="contoh@gmail.com"
                                               required>
                                    </div>
                                    @error('email')
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
                                            <i class="fas fa-undo me-2"></i>
                                            Reset
                                        </button>
                                        
                                        <button type="submit" 
                                                class="btn btn-success btn-action">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-muted">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Tips Pengisian Form
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-check text-success me-2"></i>Pastikan NIS tidak sama dengan siswa lain</li>
                        <li><i class="fas fa-check text-success me-2"></i>Format email harus valid (menggunakan @)</li>
                        <li><i class="fas fa-check text-success me-2"></i>Nama kelas sesuai dengan kurikulum yang berlaku</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan akan hilang.')) {
            document.getElementById('editSiswaForm').reset();
            
            // Reset ke nilai awal dari database
            document.getElementById('nama').value = '{{ $siswa->nama }}';
            document.getElementById('nis').value = '{{ $siswa->nis }}';
            document.getElementById('kelas').value = '{{ $siswa->kelas }}';
            document.getElementById('jenis_kelamin').value = '{{ $siswa->jenis_kelamin }}';
            document.getElementById('email').value = '{{ $siswa->email }}';
            
            // Remove validation classes
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
        }
    }

    // Form validation
    document.getElementById('editSiswaForm').addEventListener('submit', function(e) {
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
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan dengan benar.');
        }
    });

    // Real-time validation
    document.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Auto-format NIS (hanya angka)
    document.getElementById('nis').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
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
</script>
@endpush