<?php
namespace App\Controllers\Api;

use Riyu\Http\Request;

class Settings extends Controller
{
    /**
     * Update profile
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    public function updateProfile(Request $request)
    {
        $this->ruleUpdate($request);

        $username = $request->username;
        $email = $request->email;
        $tanggalLahir = $request->tanggal_lahir;

        $date = date('Y-m-d');
        $diff = date_diff(date_create($tanggalLahir), date_create($date));
        $umur = $diff->format('%y');

        if ($umur < 15) {
            return Response::json(400, 'Umur minimal 13 tahun');
        }

        if ($umur > 18) {
            return Response::json(400, 'Umur maksimal 18 tahun');
        }

        if (isset($request->foto) && !empty($request->foto) || $request->foto != null) {
            $foto = $request->foto;
        } else {
            $foto = null;
        }

        $user = $this->findSiswa($username);

        if ($foto == null) {
            $foto = $user->foto_profil;
        } else {
            $foto = $this->foto($foto, $username);
        }

        $update = [
            'email' => $email,
            'tanggal_lahir' => $tanggalLahir,
            'foto_profil' => $foto
        ];

        $this->queryUpdateProfile($username, $update);
        $user = $this->query($username);

        return Response::json(200, 'Berhasil update profile', $this->mapUser($user));
    }

    /**
     * Change password
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    public function changePassword(Request $request)
    {
        $this->ruleChangePassword($request);

        if ($request->password == $request->new_password) {
            return Response::json(400, "Password baru tidak boleh sama dengan password lama");
        }

        $user = $this->findsiswa($request->username);

        $this->verifyPassword($request->password, $user->password);

        $this->updatePassword($request->username, $request->new_password);

        return Response::json(200, 'Berhasil update password');
    }

    /**
     * Delete foto profile
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    public function deleteFoto(Request $request)
    {
        $this->ruleDeleteFoto($request);

        $user = $this->findSiswa($request->username);

        $this->deleteFotoProfile($request->username);

        $user = $this->query($request->username);

        return Response::json(200, 'Berhasil menghapus foto', $this->mapUser($user));
    }

    /**
     * Handle upload foto
     * 
     * @param array $foto
     * @param string $nis
     * 
     * @return string destination
     */
    public function foto($foto, $nis)
    {
        try {
            // Get path info
            $ekstensi = pathinfo($foto['name'], PATHINFO_EXTENSION);
    
            // Set format name foto
            $formatFile = $nis . "-profile." . $ekstensi;
    
            // set for save
            $moveFile = __DIR__ . "/../../../images/profile/siswa/" . $formatFile;
    
            // compress image
            $this->compress($foto['tmp_name'], $moveFile, 75);
    
            return $formatFile;
        } catch (\Throwable $th) {
            return Response::json(500, 'Gagal mengupload foto');
        }
    }

    
}
