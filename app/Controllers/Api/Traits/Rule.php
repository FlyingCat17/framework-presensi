<?php
namespace App\Controllers\Api\Traits;

use App\Controllers\Api\Response;
use Riyu\Http\Request;
use Riyu\Validation\Validation;

Trait Rule
{
    /**
     * Validate errors
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleLogin(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleLogout(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleUpdate(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleChangePassword(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleDeleteFoto(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleSearch(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleVerifyOtp(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleResetPassword(Request $request)
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
     * @param Request $request
     * 
     * @return void
     */
    public function ruleMail(Request $request)
    {
        $rule = [
            'username' => 'required|numeric',
            'email' => 'required|email',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate rule for absensi
     * 
     * @param Request $request
     * 
     * @return void
     */
    public function ruleLogAbsensi(Request $request)
    {
        $rule = [
            'id' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Validate rule for jadwal
     * 
     * @param Request $request
     * 
     * @return void
     */
    public function ruleJadwal(Request $request)
    {
        $rule = [
            'id' => 'required|numeric',
        ];

        $errors = Validation::message($request->all(), $rule, $this->messages());

        $this->validate($errors);
    }

    /**
     * Verbs for all messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'email' => ':field harus berupa email',
            'date' => ':field harus berupa tanggal',
            'min' => ':field minimal :min karakter'
        ];
    }
}
