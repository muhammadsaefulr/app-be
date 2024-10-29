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

        if($kontakPegawai->isEmpty()){
            return response()->json(new KontakPegawaiResource([],"Data Kontak Tidak ditemukan.", null), 200);
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

        return new KontakPegawaiResource(true,'Kontak Pegawai Berhasil Di update', $kontakPegawai);
    }

    public function show($nip)
    {
        $kontakPegawai = KontakPegawai::where('nip', $nip)->firstOrFail();

        return new KontakPegawaiResource(true, 'Detail kontak pegawai berhasil diambil.', $kontakPegawai);
    }

    public function update(Request $request, $nip)
    {
        $kontakPegawai = KontakPegawai::where('nip', $nip)->firstOrFail();

        $validated = $request->validate([
            'no_hp' => 'sometimes|required|string',
            'npwp' => 'sometimes|required|string',
            'email' => 'sometimes|nullable|string'
        ]);

        $kontakPegawai->update($validated);

        return new KontakPegawaiResource(true,'Kontak pegawau berhasil diupdate.', $kontakPegawai);
    }

    public function destroy($nip)
    {
        $kontakPegawai = KontakPegawai::where('nip', $nip)->firstOrFail();
        $kontakPegawai->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Kontak Berhasil Di reset.'
        ], 204);
    }
}
