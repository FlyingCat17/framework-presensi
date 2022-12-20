<?php

namespace App\Controllers\Api;

use App\Models\Siswa;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class ForgotPassword extends Controller
{
    public function search(Request $request)
    {
        $this->ruleSearch($request);

        $user = $this->findSiswa($request->username);

        $user = $this->query($request->username);

        return Response::json(200, 'Username ditemukan', $this->mapUser($user));
    }

    public function verifyOtp(Request $request)
    {
        $this->ruleVerifyOtp($request);

        $username = $request->username;
        $otp = $request->otp;

        $user = $this->findSiswa($username);

        if ($user->otp != $otp) {
            return Response::json(401, 'Kode OTP salah');
        }

        if ($user->otp_expired < date('Y-m-d H:i:s', strtotime('+1 minutes'))) {
            return Response::json(410, 'Kode OTP sudah kadaluarsa');
        }

        $user = $this->query($username);

        return Response::json(200, 'Kode OTP benar', $this->mapUser($user));
    }

    public function resetPassword(Request $request)
    {
        $this->ruleResetPassword($request);
        
        $user = $this->findSiswa($request->username);

        if (password_verify($request->password, $user->password)) {
            return Response::json(400, 'Password baru tidak boleh sama dengan password lama');
        }

        $this->updatePassword($request->username, $request->password);

        return Response::json(200, 'Password berhasil diubah');
    }
}
