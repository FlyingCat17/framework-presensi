<?php
namespace App\Controllers\Api;

use App\Models\Siswa;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class ForgotPassword
{
    public function search(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;

        try {
            $user = Siswa::findorfail($username, 'nis', function () {
                return Response::json(404, 'Username salah');
            });
            return Response::json(200, 'Username ditemukan', $this->map($user));
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function verifyOtp(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'otp' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;
        $otp = $request->otp;

        try {
            $user = Siswa::findorfail($username, 'nis', function () {
                return Response::json(404, 'Username salah');
            });
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if ($user->otp != $otp) {
            return Response::json(400, 'Kode OTP salah');
        }

        if ($user->otp_expired < date('Y-m-d H:i:s', strtotime('+1 minutes'))) {
            return Response::json(400, 'Kode OTP sudah kadaluarsa');
        }

        return Response::json(200, 'Kode OTP benar', $this->map($user));
    }

    public function resetPassword(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'password' => 'required|min:8',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'min' => ':field minimal :min karakter',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }

        $username = $request->username;
        $password = $request->password;

        try {
            $user = Siswa::findordail($username, 'nis', function () {
                return Response::json(404, 'Username salah');
            });
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        try {
            Siswa::where('nis', $username)->update([
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'otp' => null,
                'otp_expired' => null,
            ]);
            return Response::json(200, 'Password berhasil diubah');
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function map(object $data)
    {
        return array(
            'nis' => $data->nis,
            'nama' => $data->nama_siswa,
            'foto' => $data->foto_profil,
            'email' => $data->email,
            'kelas' => $data->nama_kelas,
            'no_hp' => $data->notelp_siswa,
            'alamat' => $data->alamat_siswa,
            'isLogin' => $data->isLogin,
            'id_kelas' => $data->id_kelas,
            'deviceId' => $data->deviceId,
            'nama_kelas' => $data->nama_kelas,
            'tanggal_lahir' => $data->tgl_lahir,
        );
    }
}