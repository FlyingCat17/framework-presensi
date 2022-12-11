<?php

namespace App\Controllers\Api;

use App\Models\Siswa;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class Settings
{
    public function updateProfile(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'email' => ':field harus berupa email',
            'date' => ':field harus berupa tanggal'
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;
        $email = $request->email;
        $tanggalLahir = $request->tanggal_lahir;

        if (isset($request->foto) || !empty($request->foto) || $request->foto != null) {
            $foto = $request->foto;
        } else {
            $foto = null;
        }

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username salah');
        }

        if ($foto == null) {
            $foto = $user->foto_profil;
        } else {
            $foto = $this->foto($foto, $username);
        }

        try {
            Siswa::where('nis', $username)->update([
                'email' => $email,
                'tanggal_lahir' => $tanggalLahir,
                'foto' => $foto
            ]);
            return Response::json(200, 'Berhasil update profile', $this->map($user));
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function changePassword(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'password' => 'required',
            'new_password' => 'required|min:8'
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'min' => ':field minimal :min karakter'
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;
        $password = $request->password;
        $newPassword = $request->new_password;

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username salah');
        }

        if (!password_verify($password, $user->password)) {
            return Response::json(400, 'Password salah');
        }

        try {
            Siswa::where('nis', $username)->update([
                'password' => password_hash($newPassword, PASSWORD_DEFAULT)
            ]);
            return Response::json(200, 'Berhasil update password');
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function deleteFoto(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka'
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);
        
        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username salah');
        }

        try {
            Siswa::where('nis', $username)->update([
                'foto' => null
            ]);
            return Response::json(200, 'Berhasil menghapus foto', $this->map($user));
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function map(object $data)
    {
        return array(
            'nis' => $data->nis,
            'nama' => $data->nama_siswa,
            'kelas' => $data->nama_kelas,
            'id_kelas' => $data->id_kelas,
            'tanggal_lahir' => $data->tgl_lahir,
            'foto' => $data->foto_profil,
            'email' => $data->email,
            'no_hp' => $data->notelp_siswa,
            'alamat' => $data->alamat_siswa,
            'isLogin' => $data->isLogin,
            'deviceId' => $data->deviceId,
            'nama_kelas' => $data->nama_kelas,
        );
    }

    public function foto($foto = array(), string $nis)
    {
        $ekstensi = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $formatFile = $nis . "-profile." . $ekstensi;
        $moveFile = "../../../image/profile/" . $formatFile;
        $this->compress($foto['tmp_name'], $moveFile, 75);
        return base_url . '/image/profile/' . $formatFile;
    }

    protected function compress($source, $destination, $quality)
    {
        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                $image = imagecreatefromjpeg($source);
        }
        imagejpeg($image, $destination, $quality);
        return $destination;
    }
}
