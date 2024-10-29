<?php

namespace App\Http\Controllers;

use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('unitTugas', 'kontakPegawai')->get();

        if ($pegawai->isEmpty()) {
            return response()->json(new PegawaiResource([], 'Tidak ada pegawai ditemukan.', null), 200);
        }

        return new PegawaiResource('success', 'Daftar pegawai berhasil diambil.', $pegawai);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nip' => 'required|string|unique:pegawai',
                'nama' => 'required|string',
                'tempat_lahir' => 'required|string',
                'tgl_lahir' => 'required|date',
                'alamat' => 'required|string',
                'gender' => 'required|string|size:1',
                'agama' => 'required|string',
                'foto_pegawai' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi foto
            ]);

            if ($request->hasFile('foto_pegawai')) {
                $filePath = $request->file('foto_pegawai')->store('foto_pegawai', 'public');
                $validated['foto_pegawai'] = $filePath;
            }

            $pegawai = Pegawai::create($validated);
            return new PegawaiResource(true, 'Pegawai berhasil ditambahkan.', $pegawai);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->validator->errors(),
            ], 400);
        }
    }

    public function update(Request $request, $nip)
    {
        $pegawai = Pegawai::where('nip', $nip)->first();

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        try {
            $validated = $request->validate([
                'nama' => 'sometimes|required|string',
                'tempat_lahir' => 'sometimes|required|string',
                'tgl_lahir' => 'sometimes|required|date',
                'alamat' => 'sometimes|required|string',
                'gender' => 'sometimes|required|string|size:1',
                'agama' => 'sometimes|required|string',
                'foto_pegawai' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('foto_pegawai')) {
                if ($pegawai->foto_pegawai) {
                    Storage::disk('public')->delete($pegawai->foto_pegawai);
                }

                $filePath = $request->file('foto_pegawai')->store('foto_pegawai', 'public');
                $validated['foto_pegawai'] = $filePath;
            }

            $pegawai->update($validated);
            return new PegawaiResource(true, 'Pegawai berhasil diperbarui.', $pegawai);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->validator->errors(),
            ], 400);
        }
    }

    public function show($data)
    {
        $pegawai = Pegawai::where('nip', $data)->first();

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        return response()->json($pegawai);
    }

    public function destroy($nip)
    {
        $pegawai = Pegawai::where('nip', $nip)->first();

        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        $pegawai->delete();
        return response()->json([
            'success' => true,
            'message' => 'Pegawai berhasil dihapus.'
        ], 204);
    }
}
