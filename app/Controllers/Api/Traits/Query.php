<?php
namespace App\Controllers\Api\Traits;

use App\Controllers\Api\Response;
use App\Models\Detail_Presensi;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\Ujian;

trait Query
{
    /**
     * Find siswa by username
     * 
     * @param string $username
     * 
     * @return object|void
     */
    protected function findSiswa($username)
    {
        try {
            return Siswa::findOrFail($username, 'nis', function () {
                return Response::json(404, 'Username salah');
            });
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * Return result for siswa login
     * 
     * @param string $username
     * 
     * @return object|void
     */
    protected function query($username)
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
     * Update isLogin and deviceId
     * 
     * @param int $isLogin
     * @param string $username
     * @param string|null $deviceId
     * 
     * @return void
     */
    protected function updateLogin($isLogin, $username, ?string $deviceId)
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
     * Update profile
     * 
     * @param string $username
     * @param array $update
     * 
     * @return void
     */
    protected function queryUpdateProfile($username, $update)
    {
        try {
            $this->uniqueEmail($update['email'], $username);

                Siswa::where('nis', $username)->update($update)->save();

        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    protected function uniqueEmail($email, $username)
    {
        try {
            $isData = Siswa::where('email', $email)->first();
            
            if ($isData == null) {
                return;
            }

            if ($isData->nis != $username) {
                print_r($isData);
                return Response::json(409, 'Email sudah digunakan');
            }
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * Update password and hash it
     * 
     * @param string $username
     * @param string $password
     * 
     * @return void
     */
    protected function updatePassword($username, $password)
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
     * Delete foto profile
     * 
     * @param string $username
     * 
     * @return void
     */
    protected function deleteFotoProfile($username)
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
     * Update otp and otp expired
     * 
     * @param string $username
     * @param string $otp
     * 
     * @return void
     */
    protected function updateOtp($username, $otp = null)
    {
        try {
            if ($otp == null) {
                Siswa::where('nis', $username)->update([
                    'otp' => null,
                    'otp_expired' => null,
                ])->save();
            } else {
                Siswa::where('nis', $username)->update([
                    'otp' => $otp,
                    'otp_expired' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
                ])->save();
            }
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * Get log absensi
     * 
     * @param string $nis
     * 
     * @return array|void
     */
    protected function getLogAbsensi(string $nis)
    {
        try {
            return Detail_Presensi::join('tb_presensi', 'tb_presensi.id_presensi', 'tb_detail_presensi.id_presensi')
                ->where('tb_detail_presensi.nis', $nis)
                ->orderby('tb_presensi.mulai_presensi', 'desc')
                ->where('tb_presensi.mulai_presensi', '<=', date('Y-m-d H:i:s'))
                // ->where('tb_presensi.akhir_presensi', '>=', date('Y-m-d H:i:s'))
                // ->limit(10)
                ->get();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * Get jadwal presensi
     * 
     * @param string $idKelas
     * 
     * @return array|void
     */
    protected function getjadwalPresensi($idKelas)
    {
        try {
             return Presensi::join('tb_jadwal', 'tb_presensi.id_jadwal', 'tb_jadwal.id_jadwal')
                ->join('tb_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran')
                ->join('tb_mapel', 'tb_jadwal.id_mapel', 'tb_mapel.id_mapel')
                ->join('tb_guru', 'tb_jadwal.nuptk', 'tb_guru.nuptk')
                ->where('tb_presensi.mulai_presensi', '<=', date('Y-m-d H:i:s'))
                ->where('tb_presensi.akhir_presensi', '>=', date('Y-m-d H:i:s'))
                ->where('tb_kelas_ajaran.id_kelas_ajaran', $idKelas)
                ->orderby('tb_presensi.akhir_presensi', 'asc')
                ->limit(20)
                ->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }
    
    /**
     * Get jadwal pelajaran
     * 
     * @param string $idKelasAjaran
     * 
     * @return array|void
     */
    protected function getJadwalPelajaran($idKelasAjaran)
    {
        try {
            return Jadwal::join('tb_mapel', 'tb_jadwal.id_mapel', 'tb_mapel.id_mapel')
                ->where('tb_jadwal.id_kelas_ajaran', $idKelasAjaran)
                ->orderby('tb_jadwal.hari', 'ASC')
                ->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * Get jadwal ujian
     * 
     * @param string $idKelasAjaran
     * 
     * @return array|void
     */
    protected function getJadwalUjian($idKelasAjaran)
    {
        try {
            return Ujian::join('tb_mapel', 'tb_ujian.id_mapel', 'tb_mapel.id_mapel')
                ->where('tb_ujian.id_kelas_ajaran', $idKelasAjaran)
                ->all();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    /**
     * Find presensi
     * 
     * @param string $idPresensi
     * 
     * @return void
     */
    protected function findPresensi($idPresensi)
    {
        Presensi::findorfail($idPresensi, 'id_presensi', function () {
            return Response::json(404, 'Presensi tidak ditemukan');
        });
    }

    /**
     * Insert presensi
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function insertPresensi($request)
    {
        try {
            $isData = Detail_Presensi::where('id_presensi', $request->idPresensi)
            ->findorfail($request->nis, 'nis', function () use ($request) {
                $presensi = new Detail_Presensi();
                $presensi->id_presensi = $request->idPresensi;
                $presensi->nis = $request->nis;
                $presensi->kehadiran = $request->kehadiran;
                $presensi->timestamp = $request->timestamp;
                $presensi->koordinat = $request->koordinat;
                $presensi->save();
            });

            if ($isData) {
                return Response::json(409, 'Anda sudah melakukan presensi pada jadwal ini');
            }

        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    protected function createPresensi(array $presensi)
    {
        try {
            $isData = Detail_Presensi::where('id_presensi', $presensi['id_presensi'])
            ->findorfail($presensi['nis'], 'nis', function () use ($presensi) {
                Detail_Presensi::insert($presensi)->save();
            });

            if ($isData) {
                return Response::json(409, 'Anda sudah melakukan presensi pada jadwal ini');
            }

        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }
}