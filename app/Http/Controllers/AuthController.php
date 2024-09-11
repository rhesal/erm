<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\PegawaiModel;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index(): Response
    {
        return response()->view('auth.index');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $userKey = env('USER_KEY');
        $passwordKey = env('PASSWORD_KEY');

        $cekUser = DB::table('user')
            ->select(DB::raw('AES_DECRYPT(id_user, ?) as kd_dokter'))
            ->where('id_user', DB::raw('AES_ENCRYPT(?,?)'))
            ->where('password', DB::raw('AES_ENCRYPT(?,?)'))
            ->setBindings([$userKey, $data['username'], $userKey, $data['password'], $passwordKey])
            ->first();

        if (!$cekUser) {
            Log::error('Gagal login dengan username: {username}', ['username' => $request['username']]);
            throw new HttpResponseException(response([
                "error" => [
                    "username" => "Username atau password salah",
                    "password" => "Username atau password salah"
                ]
            ], 401));
        }

        $pegawai = PegawaiModel::where('nik', $cekUser->kd_dokter)
            ->where('stts_aktif', '!=', 'KELUAR')
            ->whereRelation('dokter', 'status', '1')
            ->first();

        if (!$pegawai) {
            Log::error('Gagal login dengan username: {username}, status tidak aktif', ['username' => $cekUser->kd_dokter]);
            throw new HttpResponseException(response([
                "error" => [
                    "username" => "Username atau password salah",
                    "password" => "Username atau password salah"
                ]
            ], 401));
        }

        $dataUser = [
            'kdDokter' => $pegawai->nik,
            'namaDokter' => $pegawai->nama,
            'foto' => "http://192.168.30.24/webapps/penggajian/" . $pegawai->photo,
        ];

        $request->session()->put($dataUser);
        Log::info('Login berhasil dengan username: {username}', ['username' => $dataUser['kdDokter']]);

        return response()->json([
            'url' => '/'
        ])->setStatusCode(200);
    }

    public function logout(): RedirectResponse
    {
        Log::info('Logout berhasil dengan username: {username}', ['username' => request()->session()->get('kdDokter')]);
        request()->session()->invalidate();
        return redirect('/');
    }
}
