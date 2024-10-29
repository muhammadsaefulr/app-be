<?php

namespace App\Http\Controllers;

use App\Models\UnitTugas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UnitTugasController extends Controller
{
    public function index()
    {
        try {
            $unitTugas = UnitTugas::all();

            if ($unitTugas->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Tidak ada unit tugas ditemukan.',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Daftar unit tugas berhasil diambil.',
                'data' => $unitTugas
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data unit tugas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nip' => 'required|string|unique:unit_tugas',
                'gol' => 'required|string',
                'eselon' => 'nullable|string',
                'jabatan' => 'nullable|string',
                'unit_kerja' => 'nullable|string',
            ]);

            $unitTugas = UnitTugas::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Unit tugas berhasil ditambahkan.',
                'data' => $unitTugas
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menambahkan unit tugas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($nip)
    {
        try {
            $unitTugas = UnitTugas::where('nip', $nip)->firstOrFail();

            return response()->json([
                'status' => 'success',
                'message' => 'Detail unit tugas berhasil diambil.',
                'data' => $unitTugas
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit tugas tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data unit tugas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $nip)
    {
        try {
            $unitTugas = UnitTugas::where('nip', $nip)->firstOrFail();

            $validated = $request->validate([
                'gol' => 'sometimes|required|string',
                'eselon' => 'sometimes|nullable|string',
                'jabatan' => 'sometimes|nullable|string',
                'unit_kerja' => 'sometimes|nullable|string',
            ]);

            $unitTugas->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Unit tugas berhasil diperbarui.',
                'data' => $unitTugas
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit tugas tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui unit tugas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($nip)
    {
        try {
            $unitTugas = UnitTugas::where('nip', $nip)->firstOrFail();
            $unitTugas->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Unit tugas berhasil dihapus.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit tugas tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus unit tugas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
