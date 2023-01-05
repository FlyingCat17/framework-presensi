<?php
namespace App\Controllers\Guru;


use App\Config\Session;
use App\Controllers\Controller;
use App\Controllers\KelasAjaran;
use App\Models\User;
use App\Models\Kelas_Ajaran;
use App\Models\Tahun_Ajaran;
use App\Models\Jadwal;
use App\Models\Guru;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use Riyu\Validation\Validation;
use Throwable;
use Utils\Flasher;

class Ganti_Password extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }

        if (Session::get('type') != 'guru') {
            redirect(base_url . 'dashboard');
        }
    }

    private function getGuru()
    {
        return Guru::where('nuptk', Session::get('user'))->first();
    }

    public function index()
    {
        $data['title'] = "Ganti Password";
        $data['guru'] = $this->getGuru();

        return view([
            'guru/view/templates/header_profil',
            'guru/view/ganti/password/ganti_password',
            'guru/view/templates/footer',
        ], $data);
    }

    public function updatePassword(Request $request)
    {
        $rule = [
            'password_lama' => 'required|max:25',
            'password_baru' => 'required|max:30|min:8',
            'konfirmasi' => 'required|max:30|min:8',
        ];
        $message = [
            'required' => ':field tidak boleh kosong!',
            'max' => ':field maksimal :max karakter!',
            'min' => ':field maksimal :min karakter!',
        ];
        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);
        if ($errors) {
            $errors = str_replace('password_baru', 'Password Baru', $errors);
            Flasher::setFlash('Password gagal di simpan! error: ' . $errors, 'danger');
            header('Location: ' . base_url . 'g/ubah/password');
            exit();
        }
        $checkPasswordLama = Guru::where('nuptk', Session::get('user'))
            ->first();
        if (!password_verify(trim($request->password_lama), $checkPasswordLama->password)) {
            Flasher::setFlash('Password Lama tidak Sesuai!', 'danger');
            header('Location: ' . base_url . 'g/ubah/password');
            exit();
        }
        if (trim($request->password_baru) != trim($request->konfirmasi)) {
            Flasher::setFlash('Harap Konfirmasi Password!', 'danger');
            header('Location: ' . base_url . 'g/ubah/password');
            exit();
        }
        try {
            $update = Guru::update([
                'password' => password_hash(trim($request->konfirmasi), PASSWORD_BCRYPT)
            ])
                ->where('nuptk', Session::get('user'))
                ->save();
            if ($update) {
                Flasher::setFlash('Berhasil mengganti password!', 'success');
                header('Location: ' . base_url . 'g/ubah/password');
                exit();
            } else {
                Flasher::setFlash('Berhasil mengganti password!', 'success');
                header('Location: ' . base_url . 'g/ubah/password');
                exit();

            }
        } catch (Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }
    }
}