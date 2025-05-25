<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        return view('siswa.index');
    }

    // Mengambil data untuk DataTables
    public function getData(Request $request)
    {
        $data = Siswa::select(['id', 'nama', 'nis', 'kelas', 'jenis_kelamin', 'email']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
    $editUrl = route('siswa.edit', $row->id);
    $deleteUrl = route('siswa.destroy', $row->id);

    return '
        <a href="' . $editUrl . '" class="btn btn-sm btn-info">Edit</a>
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal' . $row->id . '">Hapus</button>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal' . $row->id . '" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data siswa ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    ';
})
            
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // resources/views/siswa/index.blade.php

public function create()
{
    return view('siswa.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'nis' => 'required|unique:siswa',
        'kelas' => 'required',
        'jenis_kelamin' => 'required|in:L,P',
        'email' => 'required|email',
    ]);

    Siswa::create($request->all());

    return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
}

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswa,nis,' . $id,
            'kelas' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'required|email',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    // Menghapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
