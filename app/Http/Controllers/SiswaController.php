<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        return Siswa::all();
    }

    public function store(Request $request)
    {
        // Handle file upload
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/images');
            $fotoPath = Storage::url($fotoPath);
        }

        // Simpan data siswa ke database
        $siswa = Siswa::create([
            'nama' => $request->input('nama'),
            'foto' => $fotoPath,
            'kelas' => $request->input('kelas'),
            'absen' => $request->input('absen'),
        ]);

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan',
            'siswa' => $siswa,
            'status' => 'success'
        ]);
    }

    public function show(Siswa $siswa)
    {
        return $siswa;
    }

    public function update(Request $request, Siswa $siswa)
    {
        // Handle file upload jika ada file gambar yang di-upload
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($siswa->foto) {
                Storage::delete(str_replace('/storage', 'public', $siswa->foto));
            }

            // Simpan gambar baru
            $path = $request->file('foto')->store('public/images');
            $fotoUrl = Storage::url($path); // Simpan URL gambar baru ke database
        } else {
            // Gunakan foto lama jika tidak ada file baru
            $fotoUrl = $siswa->foto;
        }

        // Perbarui data siswa
        $siswa->update([
            'nama' => $request->input('nama', $siswa->nama),
            'foto' => $fotoUrl,
            'kelas' => $request->input('kelas', $siswa->kelas),
            'absen' => $request->input('absen', $siswa->absen),
        ]);

        // Kembalikan data yang diperbarui atau pesan sukses
        return response()->json([
            'message' => 'Data siswa berhasil diperbarui',
            'siswa' => $siswa,
            'status' => 'success'
        ]);
    }

    public function destroy(Siswa $siswa)
    {
        // Hapus file gambar jika ada
        if ($siswa->foto) {
            Storage::delete(str_replace('/storage', 'public', $siswa->foto));
        }

        // Hapus data siswa dari database
        $siswa->delete();

        // Berikan respon sukses
        return response()->json([
            'message' => 'Siswa berhasil dihapus',
            'status' => 'success'
        ]);
    }
}
