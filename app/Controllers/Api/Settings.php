<?php
namespace App\Controllers\Api;

use Riyu\Http\Request;

class Settings extends Controller
{
    /**
     * Update profile
     * 
     * @param Request $request
     * 
     * @return void
     */
    public function updateProfile(Request $request)
    {
        $this->ruleUpdate($request);

        $username = $request->username;
        $email = $request->email;
        $tanggalLahir = $request->tanggal_lahir;

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
     * @param Request $request
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

        if (!password_verify($request->password, $user->password)) {
            return Response::json(400, 'Password salah');
        }

        $this->updatePassword($request->username, $request->new_password);

        return Response::json(200, 'Berhasil update password');
    }

    /**
     * Delete foto profile
     * 
     * @param Request $request
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
    public function foto($foto = array(), string $nis)
    {
        // Get path info
        $ekstensi = pathinfo($foto['name'], PATHINFO_EXTENSION);

        // Set format name foto
        $formatFile = $nis . "-profile." . $ekstensi;

        // set for save
        $moveFile = __DIR__ . "/../../../images/profile/" . $formatFile;

        // compress image
        $this->compress($foto['tmp_name'], $moveFile, 75);

        return base_url . 'images/profile/' . $formatFile;
    }

    
}
