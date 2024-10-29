<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitTugasResource;
use App\Models\UnitTugas;
use Illuminate\Http\Request;

class UnitTugasController extends Controller
{
    public function index()
    {
        $unitTugas = UnitTugas::all();

        if ($unitTugas->isEmpty()) {
            return response()->json(new UnitTugasResource([], 'Tidak ada unit tugas ditemukan.', null), 200);
        }

        return UnitTugasResource::collection($unitTugas)->additional([
            'status' => 'success',
            'message' => 'Daftar unit tugas berhasil diambil.',
        ]);
    }

    // Menyimpan unit tugas baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|unique:unit_tugas',
            'gol' => 'required|string',
            'eselon' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
        ]);

        $unitTugas = UnitTugas::create($validated);

        return new UnitTugasResource(true, 'Unit tugas berhasil ditambahkan.', $unitTugas);
    }

    public function show($nip)
    {
        $unitTugas = UnitTugas::where('nip', $nip)->first();

        if (!$unitTugas) {
            return response()->json(['message' => 'Unit tugas tidak ditemukan'], 404);
        }

        return new UnitTugasResource(true, 'Detail unit tugas berhasil diambil.', $unitTugas);
    }

    public function update(Request $request, $nip)
    {
        $unitTugas = UnitTugas::where('nip', $nip)->first();

        if (!$unitTugas) {
            return response()->json(['message' => 'Unit tugas tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'gol' => 'sometimes|required|string',
            'eselon' => 'sometimes|nullable|string',
            'jabatan' => 'sometimes|nullable|string',
            'unit_kerja' => 'sometimes|nullable|string',
        ]);

        $unitTugas->update($validated);

        return new UnitTugasResource(true, 'Unit tugas berhasil diperbarui.', $unitTugas);
    }

    public function destroy($nip)
    {
        $unitTugas = UnitTugas::where('nip', $nip)->first();

        if (!$unitTugas) {
            return response()->json(['message' => 'Unit tugas tidak ditemukan'], 404);
        }

        $unitTugas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Unit tugas berhasil dihapus.',
        ], 204);
    }
}
