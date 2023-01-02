<?php
namespace App\Controllers\Api;

use Riyu\Http\Request;

class Jadwal extends Controller
{
    public function pelajaran(Request $request)
    {
        $this->ruleJadwal($request);

        $data = $this->mapJadwalPelajaran($this->getJadwalPelajaran($request->id));

        return Response::json(200, 'Jadwal ditemukan', $data);
    }

    public function ujian(Request $request)
    {
        $this->ruleJadwal($request);
        $data = [];
        // $data = $this->mapJadwalUjian($this->getJadwalUjian($request->id));
        return Response::json(200, 'Berhasil mengambil jadwal ujian', $data);
    }

    public function presensi(Request $request)
    {
        $this->ruleJadwal($request);

        $jadwal = $this->getjadwalPresensi($request->id);

        return Response::json(200, 'Jadwal ditemukan', $this->mapJadwalPresensi($jadwal));
    }
}
