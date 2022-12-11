<?php

namespace App\Controllers\Api;

use App\Models\Siswa;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

class Mail
{
    public function index(Request $request)
    {
        $this->rule($request);

        $username = $request->username;
        $email = $request->email;

        try {
            $user = Siswa::where('nis', $username)->first();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        if (!$user) {
            return Response::json(404, 'Username tidak ditemukan');
        }

        $otp = rand(1000, 9999);

        $data = [
            'username' => $username,
            'email' => $email,
            'otp' => $otp,
        ];

        try {
            Siswa::where('nis', $username)->update([
                'otp' => $otp,
                'otp_expired' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            ])->save();
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }

        $send = $this->send($data);

        if ($send) {
            return Response::json(200, 'OTP berhasil dikirim');
        } else {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function send(array $data)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://kateruriyu.my.id/send-mail.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('email' => $data['email'], 'nama' => $data['nama'], 'otp' => $data['otp']),
            ));

            $exec = curl_exec($curl);
            
            curl_close($curl);

            return $exec;
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }

    public function rule(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'email' => 'required|email',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'email' => ':field harus berupa email',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }
    }
}
