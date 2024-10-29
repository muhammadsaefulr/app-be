<?php

namespace App\Http\Controllers;

use App\Http\Resources\KontakPegawaiResource;
use App\Models\KontakPegawai;
use Illuminate\Http\Request;

class KontakPegawaiController extends Controller
{
    public function index()
    {
        $kontakPegawai = KontakPegawai::all();

        if ($kontakPegawai->isEmpty()) {
            return response()->json(new KontakPegawaiResource([], "Data Kontak Tidak ditemukan.", null), 200);
        }

        return KontakPegawaiResource::collection($kontakPegawai)->additional([
            'status' => 'success',
            'message' => 'Berhasil Untuk Mengambil Kontak Pegawai !',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|unique:kontak_pegawais',
            'no_hp' => 'required|string',
            'npwp' => 'required|string',
        ]);

        $kontakPegawai = KontakPegawai::create($validated);

        return new KontakPegawaiResource(true, 'Kontak Pegawai Berhasil Ditambahkan', $kontakPegawai);
    }

    public function show($nip)
    {
        $kontakPegawai = KontakPegawai::where('nip', $nip)->first();

        if (!$kontakPegawai) {
            return response()->json(['message' => 'Kontak pegawai tidak ditemukan'], 200);
        }

        return KontakPegawaiResource::collection($kontakPegawai)->additional([
            'status' => 'success',
            'message' => 'Berhasil Untuk Mengambil Kontak Pegawai !',
        ]);    }

    public function update(Request $request, $nip)
    {
        $kontakPegawai = KontakPegawai::where('nip', $nip)->first();

        if (!$kontakPegawai) {
            return response()->json(['message' => 'Kontak pegawai tidak ditemukan'], 200);
        }

        $validated = $request->validate([
            'no_hp' => 'sometimes|required|string',
            'npwp' => 'sometimes|required|string',
            'email' => 'sometimes|nullable|string'
        ]);

        $kontakPegawai->update($validated);

        return new KontakPegawaiResource(true, 'Kontak pegawai berhasil diperbarui.', $kontakPegawai);
    }

    public function destroy($nip)
    {
        $kontakPegawai = KontakPegawai::where('nip', $nip)->first();

        if (!$kontakPegawai) {
            return response()->json(['message' => 'Kontak pegawai tidak ditemukan'], 200);
        }

        $kontakPegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kontak Berhasil Dihapus.'
        ], 204);
    }
}
