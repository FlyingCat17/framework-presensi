<?php

namespace App\Controllers;

use App\Config\Session;
use Riyu\Http\Request;
use App\Models\Informasi;
use App\Models\User;
use App\Models\Admin as ModelsAdmin;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Tahun_Ajaran;
use App\Models\Kelas_Ajaran;
use Riyu\Validation\Validation;
use Throwable;
use Utils\Flasher;

class Admin extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url . 'auth/login');
            exit();
        }
        if (Session::get('type') == "guru") {
            header('Location: ' . base_url . 'dashboard/guru');
            exit();
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $tahun_ajaran = Tahun_Ajaran::where('isActive', '1')->first();
        $data['kelas'] = Kelas_Ajaran::select('COUNT(id_kelas_ajaran) AS jumlah_kelas')
            ->where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)
            ->where('status', '1')
            ->first();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['siswa'] = Siswa::select('COUNT(nis) AS jumlah_siswa')->where('status', '1')->first();
        $data['guru'] = Guru::select('COUNT(nuptk) AS jumlah_guru')->where('isActive', '1')->first();
        $data['mapel'] = Mapel::select('COUNT(id_mapel) AS jumlah_mapel')->where('status', '1')->first();
        return view(['templates/header', 'templates/sidebar', 'home/index', 'templates/footer'], $data);
    }

    public function profil()
    {
        if (Session::get('type') == 'guru') {
            echo 'Restricted';
            exit();
        }
        $data['title'] = "Profil Saya";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view([
            'templates/header_profil',
            'admin/profil',
            'templates/footer',
        ], $data);
    }


    public function ubahProfil()
    {
        if (Session::get('type') == 'guru') {
            echo 'Restricted';
            exit();
        }
        $data['title'] = "Ubah Profil Saya";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view([
            'templates/header_profil',
            'admin/ubah_profil',
            'templates/footer'
        ], $data);
    }
    public function updateProfile(Request $request)
    {
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $idAdmin = Session::get('user');
        // if ($request->foto['error'] < 4) {

        // } else {
        //     $val_char = $this->specialChar($request);
        //     $dataAdmin = [
        //         'id_admin' => Session::get('user'),
        //         'nama_admin' => $val_char['nama_lengkap'],
        //         'notelp' => $val_char['notelp'],
        //         'alamat' => $val_char['alamat']
        //     ];
        //     $this->rule_update($request);
        //     $phone = $val_char['notelp'];
        //     if (!is_numeric($phone)) {
        //         echo 'NO TELP HARUS BERISIKAN ANGKA';
        //         exit();
        //     }
        //     try {
        //         $update = ModelsAdmin::update([
        //             'nama_admin' => $val_char['nama_lengkap'],
        //             'notelp' => $val_char['notelp'],
        //             'alamat' => $val_char['alamat']
        //         ])->where('id_admin', $dataAdmin['id_admin'])->save();
        //         if ($update) {
        //             Flasher::setFlash('Data berhasil diubah!', 'success');
        //             header('Location: ' . base_url . 'profil/admin/ubah');
        //             exit();
        //         }
        //     } catch (\Throwable $th) {

        //         throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        //     }
        // }
        switch ($request->foto['error']) {
            case '4':
                $val_char = $this->specialChar($request);
                $dataAdmin = [
                    'id_admin' => Session::get('user'),
                    'nama_admin' => $val_char['nama_lengkap'],
                    'notelp' => $val_char['notelp'],
                    'alamat' => $val_char['alamat']
                ];
                $this->rule_update($request);
                $phone = $val_char['notelp'];
                if (!is_numeric($phone)) {
                    echo 'NO TELP HARUS BERISIKAN ANGKA';
                    exit();
                }
                $update = ModelsAdmin::update([
                    'nama_admin' => $val_char['nama_lengkap'],
                    'notelp' => $val_char['notelp'],
                    'alamat' => $val_char['alamat']
                ])->where('id_admin', $dataAdmin['id_admin'])->save();
                if ($update) {
                    Flasher::setFlash('Data berhasil diubah!', 'success');
                    header('Location: ' . base_url . 'profil/admin/ubah');
                    exit();
                }
                break;
            case '0':
                $val_char = $this->specialChar($request);
                $dataAdmin = [
                    'id_admin' => Session::get('user'),
                    'nama_admin' => $val_char['nama_lengkap'],
                    'notelp' => $val_char['notelp'],
                    'alamat' => $val_char['alamat']
                ];
                $this->rule_update($request);
                $phone = $val_char['notelp'];
                if (!is_numeric($phone)) {
                    echo 'NO TELP HARUS BERISIKAN ANGKA';
                    exit();
                }
                $namaFile = $request->foto['name'];
                $sizeFile = $request->foto['size'];
                $error = $request->foto['error'];
                $tmpName = $request->foto['tmp_name'];

                $ekstensi = ['jpg', 'png', 'jpeg'];
                $ekstensiFile = pathinfo($request->foto['name'], PATHINFO_EXTENSION);
                // Check File Type
                if (!in_array($ekstensiFile, $ekstensi)) {
                    Flasher::setFlash('Gagal Upload! Ekstensi foto yang diperbolehkan : \'jpg\', \'png\', \'jpeg\'', 'danger');
                    header('Location: ' . base_url . 'profil/admin/ubah');
                    exit();
                }
                // Check File Size
                if ($sizeFile > 2097152) {
                    Flasher::setFlash('Gagal Upload! Ukuran foto terlalu besar! Maksimal 2 MB', 'danger');
                    header('Location: ' . base_url . 'profil/admin/ubah');
                    exit();
                }
                $formatFile = 'profile-' . $idAdmin . '.' . $ekstensiFile;
                $moveFile = __DIR__ . "/../../images/profile/admin/" . $formatFile;
                if (move_uploaded_file($tmpName, $moveFile)) {

                    $update = ModelsAdmin::update([
                        'nama_admin' => $val_char['nama_lengkap'],
                        'notelp' => $val_char['notelp'],
                        'alamat' => $val_char['alamat'],
                        'foto_profile' => 'admin/' . $formatFile
                    ])->where('id_admin', $dataAdmin['id_admin'])->save();
                    Flasher::setFlash('Data berhasil diubah!', 'success');
                    header('Location: ' . base_url . 'profil/admin/ubah');
                    exit();
                }
                break;
            default:
                break;
        }
        header('Location: ' . base_url . 'profil/admin/ubah');
        exit();
    }
    private function specialChar($request)
    {
        $val_char = [
            'nama_lengkap' => htmlspecialchars($request->nama_lengkap),
            'notelp' => htmlspecialchars($request->notelp),
            'alamat' => htmlspecialchars($request->alamat)
        ];
        return $val_char;
    }
    private function rule_update(Request $request)
    {
        $rule = [
            'nama_lengkap' => 'required|max:128',
            'notelp' => 'required|numeric:max:15',
            'alamat' => 'required|max:255',
        ];

        $message = [
            'required' => ':field tidak boleh kosong!',
            'numeric' => ':field harus berisi angka!',
            'max' => ':field maksimal :max karakter!',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            Flasher::setFlash('Data Gagal di Simpan! error: ' . $errors, 'danger');
            header('Location: ' . base_url . 'profil/admin/ubah');
            exit();
        }
    }

    public function ubahUsername()
    {
        $data['title'] = 'Ubah Username';
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view([
            'templates/header_profil',
            'admin/ubah_username',
            'templates/footer'
        ], $data);
    }
    public function updateUsername(Request $request)
    {
        $rule = [
            'username' => 'required|max:20|min:5',
            // 'password' => 'required'
        ];

        $message = [
            'required' => ':field tidak boleh kosong!',
            'max' => ':field maksimal :max karakter!',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            Flasher::setFlash('Data Gagal di Simpan! error: ' . $errors, 'danger');
            header('Location: ' . base_url . 'profil/admin/ubah/username');
            exit();
        }
        $checkUsername = User::where('username', trim($request->username))->first();
        $checkPassword = User::where('id_admin', Session::get('user'))
            ->where('password', trim($request->password))
            ->first();
        // header('Content-Type: application/json');
        if ($checkUsername != false) {
            Flasher::setFlash('Username sudah digunakan!', 'danger');
            header('Location: ' . base_url . 'profil/admin/ubah/username');
            exit();
        }
        if ($checkPassword == false) {
            Flasher::setFlash('Password tidak sesuai! Silahkan coba lagi', 'danger');
            header('Location: ' . base_url . 'profil/admin/ubah/username');
            exit();
        }
        $val_char = [
            'username_baru' => htmlspecialchars(trim($request->username))
        ];
        try {
            ModelsAdmin::update([
                'username' => $val_char['username_baru']
            ])->where('id_admin', Session::get('user'))->save();
            Flasher::setFlash('Username berhasil diubah!', 'success');
            header('Location: ' . base_url . 'profil/admin/ubah/username');
            exit();
        } catch (Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }
    }
    public function ubahPassword()
    {
        $data['title'] = "Ganti Password";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        return view([
            'templates/header_profil',
            'admin/ubah_password',
            'templates/footer'
        ], $data);
    }
    public function updatePassword(Request $request)
    {
        $rule = [
            'username' => 'required|max:20|min:5',
            // 'password' => 'required'
        ];

        $message = [
            'required' => ':field tidak boleh kosong!',
            'max' => ':field maksimal :max karakter!',
        ];

        $errors = Validation::message($request->all(), $rule, $message);
        $errors = Validation::first($errors);

        if ($errors) {
            Flasher::setFlash('Data Gagal di Simpan! error: ' . $errors, 'danger');
            header('Location: ' . base_url . 'profil/admin/ubah/username');
            exit();
        }
        $checkPasswordLama = ModelsAdmin::where('password', $request->password_lama)
            ->where('id_admin', Session::get('user'))
            ->first();
        if ($checkPasswordLama == false) {
            echo 'Password Lama Tidak Sesuai';
            exit();
        }
        echo 'Bisa';
        exit();
    }
}