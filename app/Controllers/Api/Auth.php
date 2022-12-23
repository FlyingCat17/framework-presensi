<?php

namespace App\Controllers\Api;

use Riyu\Http\Request;

class Auth extends Controller
{
    public function login(Request $request)
    {
        $this->ruleLogin($request);

        $user = $this->findSiswa($request->username);

        if (!password_verify($request->password, $user->password)) {
            return Response::json(403, 'Password salah');
        }

        if ($user->isLogin == 0) {
            $this->updateLogin(1, $request->username, $request->deviceId);
            $user = $this->query($request->username);

            return Response::json(200, 'Berhasil login', $this->mapUser($user));
        }

        if ($user->isLogin == 1) {
            if ($user->deviceId == $request->deviceId) {
                $user = $this->query($request->username);
                return Response::json(200, 'Berhasil login', $this->mapUser($user));
            }

            return Response::json(403, 'Akun sedang digunakan');
        }
    }

    public function newLogin(Request $request)
    {
        $this->ruleLogin($request);

        $user = $this->findSiswa($request->username);

        if (!password_verify($request->password, $user->password)) {
            return Response::json(403, 'Password salah');
        }

        $this->updateLogin(1, $request->username, $request->deviceId);
        $user = $this->query($request->username);

        return Response::json(200, 'Berhasil login', $this->mapUser($user));
    }

    public function logout(Request $request)
    {
        $this->ruleLogout($request);

        $user = $this->findSiswa($request->username);

        if ($user->isLogin == 0) {
            return Response::json(403, 'Akun tidak sedang digunakan');
        }

        if ($user->isLogin == 1) {
            $this->updateLogin(0, $request->username, null);
            return Response::json(200, 'Berhasil logout');
        }
    }
}
