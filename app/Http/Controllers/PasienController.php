<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DiagnosaModel;
use App\Models\ProsedurModel;
use App\Models\PenyakitModel;
use Illuminate\Http\Response;
use App\Models\RegistrasiPeriksaModel;

class PasienController extends Controller
{
    public function index()
    {
        $kdDokter = request()->session()->get('kdDokter');
        $listPasien = RegistrasiPeriksaModel::with(['pasien'])
            ->where('kd_dokter', $kdDokter)
            ->where('tgl_registrasi', '>=', '2023-06-02')
            ->where('tgl_registrasi', '<=', '2024-07-29')
            ->get();
        $data = [
            'dokter' => $kdDokter,
            'header' => 'Daftar Pasien Rawat Jalan',
            'pasien' => $listPasien
        ];
        return view('pasien.index', $data);
    }

    public function detail(string $noRawat): Response
    {
        $kdDokter = request()->session()->get('kdDokter');
        $noRawat = base64_decode($noRawat);
        $pasien = RegistrasiPeriksaModel::where("no_rawat", $noRawat)
            ->where("kd_dokter", $kdDokter)
            ->firstOrFail();

        $data = [
            'header' => 'Resume',
            'pasien' => $pasien
        ];

        return response()->view('pasien.detail', $data);
    }

    public function soapie(string $noRawat): Response
    {
        $kdDokter = request()->session()->get('kdDokter');
        $noRawat = base64_decode($noRawat);
        $pasien = RegistrasiPeriksaModel::where("no_rawat", $noRawat)
            ->where("kd_dokter", $kdDokter)
            ->firstOrFail();

        $data = [
            'header' => 'S.O.A.P.I.E.',
            'pasien' => $pasien
        ];

        return response()->view('pasien.soapie', $data);
    }

    public function diagnosa(string $noRawat): Response
    {
        $kdDokter = request()->session()->get('kdDokter');
        $noRawat = base64_decode($noRawat);
        $pasien = RegistrasiPeriksaModel::where("no_rawat", $noRawat)
            ->where("kd_dokter", $kdDokter)
            ->firstOrFail();

        $data = [
            'header' => 'Diagnosa',
            'pasien' => $pasien,
        ];

        return response()->view('pasien.diagnosa', $data);
    }

    public function SearchIcd10(Request $request)
    {
        $query = $request->input('query');

        // Ambil item dari database berdasarkan query
        $items = PenyakitModel::where('kd_penyakit', 'LIKE', "%{$query}%")->get();

        // Kembalikan hasil pencarian sebagai JSON
        return response()->json($items);
    }

    public function SearchIcd9(Request $request)
    {
        $query = $request->input('query');

        // Ambil item dari database berdasarkan query
        $items = ProsedurModel::where('kode', 'LIKE', "%{$query}%")->get();

        // Kembalikan hasil pencarian sebagai JSON
        return response()->json($items);
    }

    public function laboratorium(string $noRawat): Response
    {
        $kdDokter = request()->session()->get('kdDokter');
        $noRawat = base64_decode($noRawat);
        $pasien = RegistrasiPeriksaModel::where("no_rawat", $noRawat)
            ->where("kd_dokter", $kdDokter)
            ->firstOrFail();

        $data = [
            'header' => 'Laboratorium',
            'pasien' => $pasien
        ];

        return response()->view('pasien.laboratorium', $data);
    }

    public function radiologi(string $noRawat): Response
    {
        $kdDokter = request()->session()->get('kdDokter');
        $noRawat = base64_decode($noRawat);
        $pasien = RegistrasiPeriksaModel::where("no_rawat", $noRawat)
            ->where("kd_dokter", $kdDokter)
            ->firstOrFail();

        $data = [
            'header' => 'Radiologi',
            'pasien' => $pasien
        ];

        return response()->view('pasien.radiologi', $data);
    }
    public function eresep(string $noRawat): Response
    {
        $kdDokter = request()->session()->get('kdDokter');
        $noRawat = base64_decode($noRawat);
        $pasien = RegistrasiPeriksaModel::where("no_rawat", $noRawat)
            ->where("kd_dokter", $kdDokter)
            ->firstOrFail();

        $data = [
            'header' => 'E-Resep',
            'pasien' => $pasien
        ];

        return response()->view('pasien.eresep', $data);
    }
}
