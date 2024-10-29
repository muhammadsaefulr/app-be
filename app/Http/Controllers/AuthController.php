<?php

namespace App\Http\Controllers;

use App\Models\AuthPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'password' => 'required|string',
        ]);

        $pegawaiAuth = AuthPegawai::where('nip', $request->nip)->first();

        if (!$pegawaiAuth) {
            return response()->json(['message' => 'NIP atau password salah'], 401);
        }

        $personalDataPegawai = Pegawai::where('nip', $request->nip)->first();

        if (!$personalDataPegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        if (!Hash::check($request->password, $pegawaiAuth->password)) {
            return response()->json(['message' => 'NIP atau password salah'], 401);
        }

        $token = $pegawaiAuth->createToken('API Token')->plainTextToken;

        return response()->json(['data' => $personalDataPegawai, 'token' => $token, 'message' => 'Login berhasil']);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }
}
