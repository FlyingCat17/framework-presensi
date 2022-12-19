<?php

namespace App\Controllers;


use App\Config\Session;
use App\Models\User;
use App\Models\Guru;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Utils\Flasher;

class Login
{
    

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'dashboard');
            exit();
        }
        return view(['auth/login']);
    }

    public function register()
    {
        return view('auth/register', [
            'title' => 'Register',
            'name' => 'Riyu'
        ]);
    }

    public function auth(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (empty($username) || empty($password)) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
        if ((Session::get('user') != null) && (Session::get('user') != '')) {
            return redirect(base_url);
        }


        try {
            $errors = Validation::make($request->all(), [
                'username' => 'required|min:4|max:20',
                'password' => 'required|min:4|max:20',
            ]);
            $errors = Validation::customMessage($errors, [
                'username' => 'Username tidak boleh kosong',
                'password' => 'Password tidak boleh kosong',
            ]);
            $data = [
                'title' => 'Login',
                'name' => 'Riyu',
                'username' => $username,
                'errors' => json_decode(json_encode($errors)),
            ];
            if ($errors) {
                if (isset($errors['username'][0]) && $errors['username'][0] != '') {
                    Flasher::setFlash($errors['username'][0], 'danger');
                } else {
                    Flasher::setFlash($errors['password'][0], 'danger');
                }
                return redirect();
            }
        } catch (\Throwable $th) {
            return ViewError::code(404);
        }

        try {
            $user = User::where('username', $username)->first();
        } catch (\Throwable $th) {
            return ViewError::code(500);
        }

        try {
            $guru = Guru::where('nuptk', $username)->first();
        } catch (\Throwable $th) {
            return ViewError::code(500);
        }
        if ($user) {
            if ($password == $user->password) {
                $_SESSION['user'] = $user->id_admin;
                $_SESSION['type'] = $user->jabatan;
                // Session::set('user', $user->id_admin);
                // Session::set('type', $user->jabatan);
                return redirect(base_url . 'dashboard');
                // echo 'LOGIN ADMIN';
            } else {
                Flasher::setFlash('Username atau password salah', 'danger');
                return redirect();
            }
            // if (password_verify($password, $user->password)) {
            //     Session::set('user', $user->id);
            //     print_r($_SESSION);
            //     return redirect('');
            // }
        } else if ($guru) {
            if ($password == $guru->password) {
                echo 'LOGIN GURU';
            } else {
                Flasher::setFlash('Username atau password salah', 'danger');
                return redirect();
            }
        } else {
            Flasher::setFlash('Username atau password salah', 'danger');
            return redirect();
        }
    }



    public function logout()
    {
        // Session::unset('user');
        // Session::unset('type');
        // Session::destroyAll();
        // print_r($_SESSION);
        // session_destroy();
        // unset($_SESSION['user']);
        // unset($_SESSION['type']);
        // var_dump($_SESSION);
        unset($_SESSION['user']);
        unset($_SESSION['type']);
        session_destroy();
        header("Location: " . base_url . 'auth/login');
        exit();
        // return redirect(base_url . 'auth/login');
    }
}