<?php
namespace App\Controllers\Api;

use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;

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

        $this->updateOtp($username);

        $user = $this->query($username);

        return Response::json(200, 'Kode OTP benar', $this->mapUser($user));
    }

    public function resetPassword(Request $request)
    {
        $this->ruleResetPassword($request);
        
        $user = $this->findSiswa($request->username);

        $this->verifyPassword($request->password, $user->password, 'reset');

        $this->updatePassword($request->username, $request->password);

        return Response::json(200, 'Password berhasil diubah');
    }

    public function verifyToken(Request $request)
    {
        $raw = $request->token . "==";
        $token = base64_decode($raw);
        $token = json_decode($token);

        $this->validateToken($token);

        $otp = $token->otp;
        $username = $token->username;

        $this->verifyOtp(Request::create([
            'username' => $username,
            'otp' => $otp,
        ]));
    }

    public function toUrl(Request $request)
    {
        header('Location: riyu://myapp.com/otp?token=' . $request->token);
        exit;
    }

    public function validateToken($token)
    {
        if (!isset($token->token) || $token->token == '' || $token->token == null) {
            return Response::json(404, 'Token tidak ditemukan');
        }

        if (!isset($token->username) || $token->username == '' || $token->username == null) {
            return Response::json(404, 'Token tidak ditemukan');
        }
    }
}
