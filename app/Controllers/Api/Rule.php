<?php

namespace App\Controllers\Api;

use Riyu\Http\Request;
use Riyu\Validation\Validation;

Trait Rule
{
    private function validate($errors)
    {
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }
    }

    public function ruleLogin(Request $request)
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

        $this->validate($errors);
    }

    public function ruleLogout(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka'
        ];

        $errors = Validation::message($request->all(), $rule, $message);

        $this->validate($errors);
    }

    public function ruleUpdate(Request $request)
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

        $this->validate($errors);
    }

    public function ruleChangePassword(Request $request)
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

        $this->validate($errors);
    }

    public function ruleDeleteFoto(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka'
        ];

        $errors = Validation::message($request->all(), $rule, $message);

        $this->validate($errors);
    }

    public function ruleSearch(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $message = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
        ];

        $errors = Validation::message($request->all(), $rule, $message);

        $this->validate($errors);
    }

    public function ruleVerifyOtp(Request $request)
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

        $this->validate($errors);
    }

    public function ruleResetPassword(Request $request)
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

        $this->validate($errors);
    }

    public function ruleMail(Request $request)
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
