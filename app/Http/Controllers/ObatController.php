<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

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
            'foto' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

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
            'foto' => 'string|max:255',
            'deskripsi' => 'string|max:255',
            'stok' => 'integer',
            'tanggal_kadaluarsa' => 'date',
        ]);

        $obat->update($validatedData);
        return $obat;
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return response()->noContent();
    }
}
