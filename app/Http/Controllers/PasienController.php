<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        return Pasien::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keluhan' => 'required|string|max:255',
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        return Pasien::create($validatedData);
    }

    public function show(Pasien $pasien)
    {
        return $pasien;
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validatedData = $request->validate([
            'keluhan' => 'string|max:255',
            'siswa_id' => 'exists:siswas,id',
        ]);

        $pasien->update($validatedData);
        return $pasien;
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return response()->noContent();
    }
}
