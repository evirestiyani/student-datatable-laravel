<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // Nama tabel (jika berbeda dari 'siswas')
    protected $table = 'siswa';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jenis_kelamin',
        'email',
    ];

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;
}
