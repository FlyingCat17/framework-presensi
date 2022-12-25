<?php
namespace App\Controllers\Api\Traits;

use App\Controllers\Api\Response;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

Trait Rule
{
    /**
     * Verbs for all messages
     * 
     * @return array
     */
    protected function messages()
    {
        return [
            'timestamp' => ':field harus berupa tanggal dan waktu (2022-12-28 15:59:45)',
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'email' => ':field harus berupa email',
            'date' => ':field harus berupa tanggal',
            'min' => ':field minimal :min karakter',
        ];
    }

    /**
     * Validate errors and return response if errors
     * 
     * @param array $errors
     * 
     * @return void
     */
    private function validate($errors)
    {
        $errors = Validation::first($errors);

        if ($errors) {
            return Response::json(400, $errors);
        }
    }

    /**
     * Validate login
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleLogin(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'password' => 'required',
            'deviceId' => 'required'
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate logout
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleLogout(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate update profile
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleUpdate(Request $request)
    {
        $rule = [
            'tanggal_lahir' => 'required|date',
            'username' => 'required|numeric',
            'email' => 'required|email',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate update password
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleChangePassword(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'password' => 'required',
            'new_password' => 'required|min:8'
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate delete foto
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleDeleteFoto(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate search account
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleSearch(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate verify otp
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleVerifyOtp(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'otp' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate reset password
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleResetPassword(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'password' => 'required|min:8',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate send mail
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleMail(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'email' => 'required|email',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate log absensi
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleLogAbsensi(Request $request)
    {
        $rule = [
            'id' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate get jadwal
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function ruleJadwal(Request $request)
    {
        $rule = [
            'id' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate insert presensi
     * 
     * @param \Riyu\Http\Request $request
     * 
     * @return void
     */
    protected function rulePresensi(Request $request)
    {
        $rule = [
            'idPresensi' => 'required|numeric',
            'nis' => 'required|numeric',
            'kehadiran' => 'required|numeric',
            'timestamp' => 'required|timestamp',
            'koordinat' => 'required'
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }
}
