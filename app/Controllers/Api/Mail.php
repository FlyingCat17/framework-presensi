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

        $token = $this->generateToken($otp, $username);

        try {
            $token = str_replace('=', '', $token);
        } catch (\Exception $e) {
        }

        $url = base_url.'user/auth?token='.$token;

        $data = [
            'nama' => $user->nama_siswa,
            'email' => $email,
            'otp' => $otp,
            'url' => $url,
        ];

        $this->updateOtp($username, $otp);

        $send = $this->send($data);

        if ($send) {
            return Response::json(200, 'OTP berhasil dikirim');
        }

        return Response::json(500, 'Terjadi kesalahan');
    }

    private function generateToken($otp, $username)
    {
        $token = password_hash($username, PASSWORD_BCRYPT);

        $dataToken = [
            'otp' => $otp,
            'username' => $username,
            'token' => $token,
        ];

        return base64_encode(json_encode($dataToken));
    }

    public function send(array $data)
    {
        try {
            $curl = curl_init();
            $url = null;

            if (isset($data['url']) && $data['url'] != '' && $data['url'] != null) {
                $url = $data['url'];
            }

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://kateruriyu.my.id/send-mail.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('email' => $data['email'], 'nama' => $data['nama'], 'otp' => $data['otp'], 'url' => $url),
            ));

            $exec = curl_exec($curl);

            curl_close($curl);

            return $exec;
        } catch (\Throwable $th) {
            return Response::json(500, 'Terjadi kesalahan');
        }
    }
}
