@extends('layouts.app')

@push('styles')
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons @1.11.3/font/bootstrap-icons.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css ">
@endpush

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Siswa</h3>
<a href="{{ route('siswa.create') }}" class="btn text-white" style="background-color: #ffc6c7;">
    <i class="bi bi-person-plus"></i> Tambah Siswa
</a>
    </div>

    <table class="table table-bordered" id="siswa-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js "></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js "></script>

    <script>
        $(document).ready(function () {
            $('#siswa-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siswa.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'nis', name: 'nis' },
                    { data: 'kelas', name: 'kelas' },
                    { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                    { data: 'email', name: 'email' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush