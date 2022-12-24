<?php
namespace App\Controllers\Api;

use Riyu\Http\Request;

class Mail extends Controller
{
    public function index(Request $request)
    {
        $this->ruleMail($request);

        $username = $request->username;
        $email = $request->email;

        $user = $this->findSiswa($username);

        $otp = rand(1000, 9999);

        $data = [
            'nama' => $user->nama_siswa,
            'email' => $email,
            'otp' => $otp,
        ];

        $this->updateOtp($username, $otp);

        $send = $this->send($data);

        if ($send) {
            return Response::json(200, 'OTP berhasil dikirim');
        }

        return Response::json(500, 'Terjadi kesalahan');
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
}
