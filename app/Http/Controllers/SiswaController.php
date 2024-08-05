<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return Siswa::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'absen' => 'required|integer',
        ]);

        return Siswa::create($validatedData);
    }

    public function show(Siswa $siswa)
    {
        return $siswa;
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nama' => 'string|max:255',
            'foto' => 'string|max:255',
            'kelas' => 'string|max:255',
            'absen' => 'integer',
        ]);

        $siswa->update($validatedData);
        return $siswa;
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->noContent();
    }
}
