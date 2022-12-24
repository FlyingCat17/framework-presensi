<?php
namespace App\Controllers\Api\Traits;

use App\Controllers\Api\Response;
use App\Models\Detail_Presensi;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Siswa;

trait Query
{
    /**
     * @param string $username
     * 
     * @return object|void
     */
    public function findSiswa($username)
    {
        try {
            $user = Siswa::findOrFail($username, 'nis', function () {
                return Response::json(404, 'Username salah');
            });
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        return $user;
    }

    /**
     * @param string $username
     * 
     * @return object
     */
    public function query($username)
    {
        try {
            return Siswa::join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_siswa.id_kelas_ajaran')
                ->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')
                ->where('tb_siswa.nis', $username)
                ->select($this->select())
                ->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param int $isLogin
     * @param string $username
     * @param string|null $deviceId
     * 
     * @return void
     */
    public function updateLogin($isLogin, $username, ?string $deviceId)
    {
        try {
            Siswa::where('nis', $username)->update([
                'isLogin' => $isLogin,
                'deviceId' => $deviceId
            ])->save();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param string $username
     * @param array $update
     * 
     * @return void
     */
    public function queryUpdateProfile($username, $update)
    {
        try {
            Siswa::where('nis', $username)->update($update)->save();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param string $username
     * @param string $password
     * 
     * @return void
     */
    public function updatePassword($username, $password)
    {
        try {
            Siswa::where('nis', $username)->update([
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ])->save();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param string $username
     * 
     * @return void
     */
    public function deleteFotoProfile($username)
    {
        try {
            Siswa::where('nis', $username)->update([
                'foto_profil' => null
            ])->save();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param string $username
     * @param string $otp
     * 
     * @return array|void
     */
    public function updateOtp($username, $otp)
    {
        try {
            Siswa::where('nis', $username)->update([
                'otp' => $otp,
                'otp_expired' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            ])->save();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param string $username
     * 
     * @return array|void
     */
    public function getLogAbsensi(string $nis)
    {
        try {
            return Detail_Presensi::join('tb_presensi', 'tb_presensi.id_presensi', 'tb_detail_presensi.id_presensi')
                ->where('tb_detail_presensi.nis', $nis)
                ->orderby('tb_presensi.mulai_presensi', 'desc')
                ->where('tb_presensi.mulai_presensi', '<=', date('Y-m-d H:i:s'))
                // ->where('tb_presensi.akhir_presensi', '>=', date('Y-m-d H:i:s'))
                ->limit(10)
                ->get();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * @param string $username
     * 
     * @return array|void
     */
    public function getjadwalPresensi($idKelas)
    {
        try {
             return Presensi::join('tb_jadwal', 'tb_presensi.id_jadwal', 'tb_jadwal.id_jadwal')
                ->join('tb_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran')
                ->join('tb_mapel', 'tb_jadwal.id_mapel', 'tb_mapel.id_mapel')
                ->where('tb_kelas_ajaran.id_kelas_ajaran', $idKelas)
                ->orderby('tb_presensi.mulai_presensi', 'asc')
                ->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }
    
    protected function getJadwalPelajaran($idKelasAjaran)
    {
        try {
            $jadwals = Jadwal::join('tb_mapel', 'tb_jadwal.id_mapel', 'tb_mapel.id_mapel')
                ->where('tb_jadwal.id_kelas_ajaran', $idKelasAjaran)
                ->orderby('tb_jadwal.hari', 'ASC')
                ->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
        return $jadwals;
    }
}