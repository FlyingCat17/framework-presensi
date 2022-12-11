<?php

namespace App\Controllers\Api;

use App\Models\Siswa;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class Auth
{
    public function login(Request $request)
    {
        $this->rule($request);

        $username = $request->username;
        $password = $request->password;
        $deviceId = $request->deviceId;

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username salah');
        }

        if (!password_verify($password, $user->password)) {
            return Response::json(403, 'Password salah');
        }

        if ($user->isLogin == 0) {
            try {
                Siswa::where('nis', $username)->update([
                    'isLogin' => 1,
                    'deviceId' => $deviceId
                ]);
                return Response::json(200, 'Berhasil login', $this->map($user));
            } catch (\Throwable $th) {
                return Response::json(500, 'Terjadi kesalahan');
            }
        }

        if ($user->isLogin == 1) {
            if ($user->deviceId == $deviceId) {
                return Response::json(200, 'Berhasil login', $this->map($user));
            } else {
                return Response::json(403, 'Akun sedang digunakan');
            }
        }
    }

    public function newLogin(Request $request)
    {
        $this->rule($request);

        $username = $request->username;
        $password = $request->password;
        $deviceId = $request->deviceId;

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username salah');
        }

        if (!password_verify($password, $user->password)) {
            return Response::json(403, 'Password salah');
        }

        try {
            Siswa::where('nis', $username)->update([
                'isLogin' => 1,
                'deviceId' => $deviceId
            ]);
            return Response::json(200, 'Berhasil login', $this->map($user));
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function logout(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'deviceId' => 'required'
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka'
        ];

        $errors = Validation::message($request->all(), $rule, $message);

        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;
        $deviceId = $request->deviceId;

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username salah');
        }

        if ($user->isLogin == 0) {
            return Response::json(403, 'Akun tidak sedang digunakan');
        }

        if ($user->isLogin == 1) {
            try {
                Siswa::where('nis', $username)->update([
                    'isLogin' => 0,
                    'deviceId' => null
                ]);
                return Response::json(200, 'Berhasil logout');
            } catch (\Throwable $th) {
                return Response::json(500, 'Terjadi kesalahan');
            }
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

    public function rule(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'password' => 'required',
            'deviceId' => 'required'
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
    }
}
