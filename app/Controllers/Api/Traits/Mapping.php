<?php

namespace App\Controllers\Api\Traits;

trait Mapping
{
    /**
     * Map user
     * 
     * @param object $username
     * 
     * @return object
     */
    public function mapUser(object $user)
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
            'id_kelas_ajaran' => $user->id_kelas_ajaran,
        );
    }

    /**
     * Select columns for user
     * 
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
     * @param array $jadwal
     * 
     * @return array
     */
    public function mapJadwalPresensi(array $jadwal)
    {
        $date = date('Y-m-d H:i:s');
        $data = [];

        foreach ($jadwal as $key => $value) {
            if ($value['mulai_presensi'] <= $date && $value['akhir_presensi'] >= $date) {
                $data[] = array(
                    'namaMapel' => $value['nama_mapel'],
                    'idPresensi' => $value['id_presensi'],
                    'mulaiPresensi' => $value['mulai_presensi'],
                    'akhirPresensi' => $value['akhir_presensi'],
                    'hari' => $value['hari'],
                    'jamKe' => $value['jam_ke'],
                    'idKelas' => $value['id_kelas'],
                );
            }
        }

        if ($data == null) {
            return $data = [];
        }

        return $data;
    }

    /**
     * @param array $jadwal
     * 
     * @return array
     */
    protected function mapJadwalPelajaran(array $jadwals)
    {
        $data = [];
        foreach ($jadwals as $jadwal) {
            $hari = $jadwal['hari'];
            $pelajaran = $jadwal['nama_mapel'];
            $jam_mulai = $jadwal['jam_awal'];
            $jam_selesai = $jadwal['jam_akhir'];

            $data[] = [
                'hari' => $this->daysSelector($hari),
                'pelajaran' => $pelajaran,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai
            ];
        }
        if ($data == null) return $data = [];
        return $data;
    }
}
