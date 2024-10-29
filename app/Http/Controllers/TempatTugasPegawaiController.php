<?php

namespace App\Http\Controllers;

use App\Models\TempatTugasPegawai;
use Illuminate\Http\Request;

class TempatTugasPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tempatTugasPegawai = TempatTugasPegawai::all();
        return response()->json($tempatTugasPegawai);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|string|exists:pegawai,nip|unique:tempat_tugas_pegawais,nip',
            'tempat_tugas' => 'required|string',
        ]);

        $tempatTugasPegawai = TempatTugasPegawai::create($validatedData);
        return response()->json($tempatTugasPegawai, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tempatTugasPegawai = TempatTugasPegawai::find($id);

        if (!$tempatTugasPegawai) {
            return response()->json(['message' => 'Data tidak ditemukan'], 200);
        }

        return response()->json($tempatTugasPegawai);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nip' => 'required|string|exists:pegawai,nip|unique:tempat_tugas_pegawais,nip,' . $id,
            'tempat_tugas' => 'required|string',
        ]);

        $tempatTugasPegawai = TempatTugasPegawai::find($id);

        if (!$tempatTugasPegawai) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tempatTugasPegawai->update($validatedData);
        return response()->json($tempatTugasPegawai);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tempatTugasPegawai = TempatTugasPegawai::find($id);

        if (!$tempatTugasPegawai) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tempatTugasPegawai->delete();
        return response()->json(['message' => 'Tempat tugas pegawai berhasil dihapus']);
    }
}
