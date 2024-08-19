<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        return Obat::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Accept only images
            'deskripsi' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/images');
            $validatedData['foto'] = Storage::url($path); // Store the file URL
        }

        return Obat::create($validatedData);
    }

    public function show(Obat $obat)
    {
        return $obat;
    }

    public function update(Request $request, Obat $obat)
{
    // Validasi data
    $validatedData = $request->validate([
        'nama' => 'string|max:255',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Terima hanya file gambar
        'deskripsi' => 'string|max:255',
        'stok' => 'integer',
        'tanggal_kadaluarsa' => 'date',
    ]);

    // Handle file upload jika ada file gambar yang di-upload
    if ($request->hasFile('foto')) {
        // Hapus gambar lama jika ada
        if ($obat->foto) {
            Storage::delete(str_replace('/storage', 'public', $obat->foto));
        }

        // Simpan gambar baru
        $path = $request->file('foto')->store('public/images');
        $validatedData['foto'] = Storage::url($path); // Simpan URL gambar ke database
    }

    // Perbarui data obat
    $obat->update($validatedData);

    // Kembalikan data yang diperbarui atau pesan sukses
    return response()->json([
        'message' => 'Data obat berhasil diperbarui',
        'obat' => $obat,
        'status' => 'success'
    ]);
}


    public function destroy(Obat $obat)
    {
        // Hapus file gambar jika ada
        if ($obat->foto) {
            Storage::delete(str_replace('/storage', 'public', $obat->foto));
        }
    
        // Hapus data obat
        $obat->delete();
    
        // Berikan respon sukses
        return response()->json([
            'message' => 'Obat berhasil dihapus',
            'status' => 'success'
        ]);
    }
    
}
