<?php

namespace App\Controllers;

use App\Models\Detail_Presensi;
use App\Models\Informasi;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Siswa;
use Riyu\Helpers\Errors\AppException;
use Riyu\Http\Request;

class Testing
{
    public function generateSiswa(Request $request)
    {
        $data = [];
        for ($i = 0; $i < $request->jumlah; $i++) {
            $nis = rand(100000, 999999);
            $data = [
                'nis' => $nis,
                'nama_siswa' => 'Siswa ' . $nis,
                'jenis_kelamin' => rand(0, 1),
                'tempat_lahir' => 'Tempat Lahir ' . $i,
                'tanggal_lahir' => date('Y-m-d', strtotime('-' . rand(10, 20) . ' years')),
                'alamat_siswa' => 'Alamat Sekarang adalah' . $i,
                'notelp_siswa' => '08' . rand(1000000000, 9999999999),
                // 'email' => 'email' . $nis . '@gmail.com',
                'password' => password_hash($nis, PASSWORD_BCRYPT),
                'status' => 1,
            ];
            try {
                Siswa::create($data);
            } catch (\Throwable $th) {
                throw new AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
            }
        }


        return view('test');
    }

    public function generatePresensi(Request $request)
    {
        $jadwal = $request->jadwal;
        Jadwal::findorfail($jadwal, 'id_jadwal', function () {
            throw new AppException("Jadwal tidak ditemukan");
        });
        $data = [];
        for ($i = 0; $i < $request->jumlah; $i++) {
            $data = [
                'id_jadwal' => $jadwal,
                'mulai_presensi' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 10) . ' days')),
                'akhir_presensi' => date('Y-m-d H:i:s', strtotime('+' . rand(1, 10) . ' days')),
            ];
            try {
                Presensi::create($data);
            } catch (\Throwable $th) {
                throw new AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
            }
        }
    }

    public function generateDetailPresensi(Request $request)
    {
        $idPresensi = Presensi::select('id_presensi')->all();
        $nis = Siswa::select('nis')->all();
        $jumlah = $request->jumlah;
        $data = [];
        for ($i = 0; $i < $jumlah; $i++) {
            foreach ($idPresensi as $id) {
                foreach ($nis as $n) {
                    $data = [
                        'id_presensi' => $id->id_presensi,
                        'nis' => $n->nis,
                        'kehadiran' => rand(1, 3),
                        'timestamp' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 10) . ' days')),
                        'koordinat' => '123.123, 123.123 ' . $i,
                    ];
                    try {
                        Detail_Presensi::create($data);
                    } catch (\Throwable $th) {
                        throw new AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
                    }
                }
            }
        }
    }

    public function generateInformasi(Request $request)
    {
        $data = [];
        for ($i = 0; $i < $request->jumlah; $i++) {
            $data = [
                'judul_informasi' => 'Judul Informasi ' . $i,
                'isi_informasi' => 'Isi Informasi ' . $i,
                'created_at' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 10) . ' days')),
            ];
            try {
                Informasi::create($data);
            } catch (\Throwable $th) {
                throw new AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
            }
        }
    }
}
