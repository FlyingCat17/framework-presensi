<?php

namespace App\Controllers;

use App\Models\Guru as ModelsGuru;
use App\Models\User;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use App\Controllers\Controller;
use App\Config\Session;
use Utils\Flasher;
use Riyu\Validation\Validation;

class Guru extends Controller
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
    public function index(Request $request)
    {
        // $data['title'] = "Guru";
        // $data['guru'] = ModelsGuru::where('isActive', '1')->all();
        // $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        try {
            $data['title'] = "Guru";
            $data['jumlah_data'] = ModelsGuru::where('isActive', '1')->count();
            $data['guru'] = ModelsGuru::where('isActive', '1')->orderby('nama_guru', 'asc')->paginate($request->page);
            $data['admin'] = User::where('id_admin', Session::get('user'))->first();
            $data['halaman_aktif'] = $request->page;
            $data['jumlah_halaman'] = ceil($data['jumlah_data'] / 10);
            $data['halaman_akhir'] = $data['jumlah_halaman'];
            return view(['templates/header', 'templates/sidebar', 'guru/index', 'templates/footer'], $data);
        } catch (\Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }
        // return $this->view('guru/index', $data);
    }

    public function aksiCari(Request $request)
    {
        // echo $request->keyword;
        if ($request->keyword == "") {
            Flasher::setFlash('Masukkan keyword pencarian', 'danger');
            header('Location: ' . base_url . 'guru');
            exit();
        }
        header('Location: ' . base_url . 'guru/cari/' . trim($request->keyword) . '/p/1');
        exit();
    }
    public function cari(Request $request)
    {
        try {
            $data['title'] = "Hasil Pencarian Guru";
            $data['keyword'] = $request->keyword;
            $data['jumlah_data'] = ModelsGuru::where('isActive', '1')
                ->where('tb_guru.nama_guru', 'LIKE', '%' . $request->keyword . '%')
                ->where('tb_guru.nuptk', 'LIKE', '%' . $request->keyword . '%')
                ->count();
            $data['guru'] = ModelsGuru::where('isActive', '1')
                ->where('nama_guru', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('nuptk', 'LIKE', '%' . $request->keyword . '%')
                ->orderby('nama_guru', 'asc')->paginate($request->page);
            $data['admin'] = User::where('id_admin', Session::get('user'))->first();
            $data['halaman_aktif'] = $request->page;
            $data['jumlah_halaman'] = ceil($data['jumlah_data'] / 10);
            $data['halaman_akhir'] = $data['jumlah_halaman'];
            return view(['templates/header', 'templates/sidebar', 'guru/cari', 'templates/footer'], $data);
        } catch (\Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }
    }
    public function tambah()
    {
        $data['title'] = "Guru";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        return $this->view('guru/tambah', $data);
    }

    public function insert(Request $request)
    {
        $check = ModelsGuru::where('nuptk', $request->nuptk)->first();
        if ($check) {
            $this->rule($request);

            $val_char = $this->specialChar($request);

            $phone = $val_char['telepon'];
            // echo $phone;
            if (!is_numeric($phone)) {
                Flasher::setFlash('Gagal Ditambahkan! Nomor Telepon harus berisikan angka!', 'danger');
                header('location: ' . base_url . 'guru/tambah');
                exit();
            }
            ModelsGuru::update([
                'nuptk' => $val_char['nuptk'],
                'nama_guru' => $val_char['nama'],
                'tempat_lahir' => $val_char['tempat_lahir'],
                'tanggal_lahir' => $val_char['tgl_lahir'],
                'alamat_guru' => $val_char['alamat'],
                'notelp_guru' => $val_char['telepon'],
                'status_kepegawaian' => $val_char['status'],
                'isActive' => '1'
            ])->where('nuptk', $request->nuptk)->save();
            Flasher::setFlash('Berhasil Diubah!', 'success');
            header('location: ' . base_url . 'guru/tambah');
            exit();
        }

        $this->rule($request);

        $val_char = $this->specialChar($request);

        $phone = $val_char['telepon'];
        // echo $phone;
        if (!is_numeric($phone)) {
            Flasher::setFlash('Gagal Ditambahkan! Nomor Telepon harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'guru/tambah');
            exit();
        }
        ModelsGuru::insert([
            'nuptk' => $val_char['nuptk'],
            'nama_guru' => $val_char['nama'],
            'tempat_lahir' => $val_char['tempat_lahir'],
            'tanggal_lahir' => $val_char['tgl_lahir'],
            'alamat_guru' => $val_char['alamat'],
            'notelp_guru' => $val_char['telepon'],
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'status_kepegawaian' => $val_char['status'],
            'isActive' => '1'
        ])->save();
        Flasher::setFlash('Berhasil Ditambahkan! Password default = 123456', 'success');
        header('location: ' . base_url . 'guru/tambah');
        exit();
    }

    public function ubah(Request $request)
    {
        $data['guru'] = ModelsGuru::where('nuptk', $request->nuptk)->first();

        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        if (!$data['guru']) {
            header('location: ' . base_url . 'guru');
            exit();
        }
        $data['title'] = "Guru";

        return $this->view('guru/edit', $data);
    }

    public function update(Request $request)
    {
        $this->rule($request);

        $val_char = $this->specialChar($request);

        $phone = $val_char['telepon'];
        // echo $phone;
        if (!is_numeric($phone)) {
            Flasher::setFlash('Gagal Diubah! Nomor Telepon harus berisikan angka!', 'danger');
            header('location: ' . base_url . 'guru/ubah/' . $request->nuptk);
            exit();
        }
        ModelsGuru::update([
            'nuptk' => $val_char['nuptk'],
            'nama_guru' => $val_char['nama'],
            'tempat_lahir' => $val_char['tempat_lahir'],
            'tanggal_lahir' => $val_char['tgl_lahir'],
            'alamat_guru' => $val_char['alamat'],
            'notelp_guru' => $val_char['telepon'],
            'status_kepegawaian' => $val_char['status'],
            'isActive' => '1'
        ])->where('nuptk', $request->nuptk)->save();
        Flasher::setFlash('Berhasil Diubah!', 'success');
        header('location: ' . base_url . 'guru/ubah/' . $request->nuptk);
        exit();
    }

    public function delete(Request $request)
    {
        ModelsGuru::update([
            'isActive' => 0
        ])->where('nuptk', $request->nuptk)->save();
        Flasher::setFlash('Berhasil Dihapus', 'success');
        header('location: ' . base_url . 'guru');
        exit();
    }

    private function specialChar($request)
    {
        $val_char = [
            'tempat_lahir' => htmlspecialchars($request->tempat_lahir),
            'tgl_lahir' => htmlspecialchars($request->tgl_lahir),
            'telepon' => htmlspecialchars($request->telepon),
            'alamat' => htmlspecialchars($request->alamat),
            'status' => htmlspecialchars($request->status),
            'nuptk' => htmlspecialchars($request->nuptk),
            'nama' => htmlspecialchars($request->nama),
        ];
        return $val_char;
    }

    private function rule(Request $request)
    {
        $rule = [
            'tempat_lahir' => 'required|max:128',
            'tgl_lahir' => 'required|max:15',
            'telepon' => 'required|numeric:max:15',
            'alamat' => 'required|max:255',
            'status' => 'required|max:20',
            'nuptk' => 'required|max:25',
            'nama' => 'required|max:128',
        ];

        $messages = [
            'required' => ':field tidak boleh kosong',
            'numeric' => ':field harus berupa angka',
            'max' => ':field maksimal :max karakter',
        ];

        $errors = Validation::message($request->all(), $rule, $messages);
        $errors = Validation::first($errors);

        if ($errors) {
            $errors = $this->replace($errors);

            Flasher::setFlash('Data Gagal Ditambahkan! ' . $errors, 'danger');
            header('Location: ' . base_url . 'guru/tambah');
            exit();
        }
    }

    private function replace($errors)
    {
        $errors = str_replace('tgl_lahir', 'Tanggal Lahir', $errors);
        $errors = str_replace('tempat_lahir', 'Tempat Lahir', $errors);
        $errors = str_replace('telepon', 'Nomor Telepon', $errors);
        $errors = str_replace('status', 'Status Kepegawaian', $errors);
        $errors = str_replace('alamat', 'Alamat', $errors);
        $errors = str_replace('nuptk', 'NUPTK', $errors);
        $errors = str_replace('nama', 'Nama Guru', $errors);
        return $errors;
    }

    private function view(string $view, array $data = [])
    {
        return view(['templates/header', 'templates/sidebar', $view, 'templates/footer'], $data);
    }
}