<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : null;
    
        if ($searchQuery) {
            return Obat::where('nama', 'LIKE', '%' . $searchQuery . '%')->get();
        }

        return Obat::all();
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'deskripsi' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/images');
            $validatedData['foto'] = Storage::url($path);
        }

        return Obat::create($validatedData);
    }

    public function show(Obat $obat)
    {
        return $obat;
    }

    public function update(Request $request, Obat $obat)
{
    $validatedData = $request->validate([
        'nama' => 'string|max:255',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'deskripsi' => 'string|max:255',
        'stok' => 'integer',
        'tanggal_kadaluarsa' => 'date',
    ]);

    if ($request->hasFile('foto')) {
        if ($obat->foto) {
            Storage::delete(str_replace('/storage', 'public', $obat->foto));
        }

        $path = $request->file('foto')->store('public/images');
        $validatedData['foto'] = Storage::url($path);
    }

    $obat->update($validatedData);

    return response()->json([
        'message' => 'Data obat berhasil diperbarui',
        'obat' => $obat,
        'status' => 'success'
    ]);
}


    public function destroy(Obat $obat)
    {
        if ($obat->foto) {
            Storage::delete(str_replace('/storage', 'public', $obat->foto));
        }
    
        $obat->delete();
    
        return response()->json([
            'message' => 'Obat berhasil dihapus',
            'status' => 'success'
        ]);
    }
    
}
