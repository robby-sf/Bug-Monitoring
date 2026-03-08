<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekBaru; 
use Illuminate\Support\Str;

class ObjekBaruController extends Controller
{
    public function create()
    {
        sleep(5); // --> Simulasi loading lama 5 detik
        return view('pendaftaranDataBaru');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'status_tanah' => 'required',
            'file_foto_ktp' => 'image|max:2048',
        ]);

        // 2. Handle Upload File
        $paths = [];
        $files = [
            'file_foto_ktp', 'file_foto_sppt', 'file_foto_sertifikat', 
            'file_foto_bangunan', 'file_imb', 'file_foto_tanah_kosong'
        ];

        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $paths[$fileKey] = $request->file($fileKey)->store('uploads', 'public');
            } else {
                $paths[$fileKey] = null;
            }
        }

        // 3. Simpan ke Database (Ganti Pengajuan jadi ObjekBaru)
        ObjekBaru::create([
            'no_pelayanan' => 'PLY-' . strtoupper(Str::random(6)),
            'status_verifikasi' => 'menunggu',
            
            // Data sesuai input form
            'nik' => $request->nik,
            'nama_wp' => $request->nama,
            'pekerjaan' => $request->pekerjaan,
            'npwp' => $request->npwp,
            'jalan_wp' => $request->jalan_wp,
            'rt_wp' => $request->rt_wp,
            'rw_wp' => $request->rw_wp,
            'kota_wp' => $request->kota,
            'status_wp' => $request->status_wp,
            'no_telp' => $request->no_telp,
            'blok_kav_no_wp' => $request->blok,
            'kelurahan_wp' => $request->kelurahan,
            'kode_pos_wp' => $request->kode_pos,
            'file_foto_ktp' => $paths['file_foto_ktp'],

            'nop_tetangga' => $request->nop_pbb_tetangga,
            'kecamatan_op' => $request->kecamatan_op,
            'kelurahan_op' => $request->kelurahan_op,
            'jalan_op' => $request->jalan_op,
            'blok_op' => $request->blok_op,
            'rt_op' => $request->rt_op,
            'rw_op' => $request->rw_op,
            'luas_tanah' => $request->luas_tanah,
            'status_tanah' => $request->status_tanah,
            'file_foto_sppt' => $paths['file_foto_sppt'],
            'file_foto_sertifikat' => $paths['file_foto_sertifikat'],

            'no_bangunan' => $request->no_bangunan,
            'jenis_bangunan' => $request->jenis_bangunan,
            'luas_bangunan' => $request->luas_bangunan,
            'jml_lantai' => $request->jml_lantai,
            'thn_dibangun' => $request->thn_bangun,
            'thn_renovasi' => $request->thn_renovasi,
            'kondisi_bangunan' => $request->kondisi_bangunan,
            'daya_listrik' => $request->daya_listrik,
            'konstruksi' => $request->konstruksi,
            'atap' => $request->atap,
            'dinding' => $request->dinding,
            'lantai' => $request->lantai,
            'langit_langit' => $request->langit_langit,
            'ac_split' => $request->ac_split,
            'ac_window' => $request->ac_window,
            'file_foto_bangunan' => $paths['file_foto_bangunan'],
            'file_imb' => $paths['file_imb'],
            'file_foto_tanah_kosong' => $paths['file_foto_tanah_kosong'],
        ]);

        return redirect('/dashboard')->with('success', 'Data pendaftaran berhasil disimpan!');
    }
}