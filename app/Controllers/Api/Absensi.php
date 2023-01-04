<?php

namespace App\Controllers\Api;

use Riyu\Http\Request;

class Absensi extends Controller
{
    public function log(Request $request)
    {
        $this->ruleLogAbsensi($request);

        $this->findSiswa($request->id);
        $log = $this->getLogAbsensi($request->id);

        return Response::json(200, 'Log presensi ditemukan', $log);
    }

    public function presensi(Request $request)
    {
        $this->rulePresensi($request);

        $this->findSiswa($request->nis);
        $this->findPresensi($request->idPresensi);

        $kehadiran = $request->kehadiran;

        if ($kehadiran == 1) {
            $this->insertPresensi($request);
        } else if ($kehadiran == 2 || $kehadiran == 3) {
            $this->kehadiran($request);
        } else {
            return Response::json(400, 'Kehadiran tidak valid');
        }

        return Response::json(200, 'Presensi berhasil');
    }

    private function kehadiran($request)
    {
        $bukti = null;

        if (isset($request->bukti) && !empty($request->bukti) && $request->bukti != null) {
            $bukti = $request->bukti;
        } else {
            $bukti = null;
        }

        if ($bukti == null) return Response::json(400, 'Kehadiran tidak valid');

        $bukti = $this->foto($bukti, $request->nis, $request->idPresensi, $request->kehadiran);

        $presensi = [
            'id_presensi' => $request->idPresensi,
            'nis' => $request->nis,
            'timestamp' => $request->timestamp,
            'koordinat' => $request->koordinat,
            'bukti_izin' => $bukti,
            'kehadiran' => $request->kehadiran,
        ];

        $this->createPresensi($presensi);
    }

    /**
     * Handle upload foto
     * 
     * @param array $foto
     * @param string $nis
     * @param int|string $id
     * @param int $type
     * 
     * @return string destination
     */
    private function foto($foto, $nis, $id, $type = 2)
    {
        $this->validate($foto);

        try {
            // Get path info
            $ekstensi = pathinfo($foto['name'], PATHINFO_EXTENSION);

            // get date now
            $date = date('Ymd_His');

            // Set format name foto
            $formatFile = $nis . "_" . $type . "_" . $date . "_" . $id . "." . $ekstensi;

            // set for save
            $moveFile = __DIR__ . "/../../../images/bukti_izin/" . $formatFile;

            // compress image
            $this->compress($foto['tmp_name'], $moveFile, 75);

            return 'bukti_izin/' . $formatFile;
        } catch (\Throwable $th) {
            return Response::json(500, 'Gagal mengupload foto');
        }
    }
}
