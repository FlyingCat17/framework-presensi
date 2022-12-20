<?php

namespace App\Controllers\Api;

use App\Models\Siswa;

class Controller
{
    use Rule;

    /**
     * @param string $username
     * @return object
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
     * @param object $username
     * @return object
     */
    public function mapUser($user)
    {
        return array(
            'nis' => $user->nis,
            'nama' => $user->nama_siswa,
            'kelas' => $user->nama_kelas,
            'id_kelas' => $user->id_kelas,
            'tanggal_lahir' => $user->tanggal_lahir,
            'foto' => $user->foto_profil,
            'email' => $user->email,
            'no_hp' => $user->notelp_siswa,
            'alamat' => $user->alamat_siswa,
            'isLogin' => $user->isLogin,
            'deviceId' => $user->deviceId,
            'nama_kelas' => $user->nama_kelas,
        );
    }

    /**
     * @return array $columns
     */
    public function select()
    {
        return [
            "tb_kelas_ajaran.id_kelas_ajaran",
            "tb_kelas_ajaran.id_kelas",
            "tb_kelas.id_kelas",
            "tb_kelas.nama_kelas",
            "tb_siswa.nis",
            "tb_siswa.nama_siswa",
            "tb_siswa.email",
            "tb_siswa.tanggal_lahir",
            "tb_siswa.foto_profil",
            "tb_siswa.deviceId",
            "tb_siswa.isLogin",
            "tb_siswa.notelp_siswa",
            "tb_siswa.alamat_siswa",
        ];
    }

    /**
     * @param string $username
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
     * @return object
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
     * @return
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
     * @return
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
     * @return
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

    public function updateOtp($username, $otp)
    {
        try {
            Siswa::where('nis', $username)->update([
                'otp' => $otp,
                'otp_expired' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            ])->save();
        } catch (\Throwable $th) {
            echo $th;
            return Response::json(500, 'Terjadi kesalahan');
        }
    }
}
