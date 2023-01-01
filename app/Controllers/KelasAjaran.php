<?php
namespace App\Controllers;

use App\Config\Session;
use App\Controllers\Controller;
use App\Models\Kelas_Ajaran as ModelsKelasAjaran;
use App\Models\Tahun_Ajaran as ModelsTahunAjaran;
use App\Models\Kelas as ModelsKelas;
use App\Models\Siswa as ModelsSiswa;
use App\Models\User;
use Riyu\Http\Request;
use Utils\Flasher;

class KelasAjaran extends Controller
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
        $data['title'] = "Pembagian Kelas";
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->where('id_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)->all();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();
        $data['kelas_ajaran'] = ModelsKelasAjaran::where('tb_kelas_ajaran.id_tahun_ajaran', '=', $data['tahun_ajar']->id_tahun_ajaran)->where('tb_kelas_ajaran.status', '1')->join('tb_kelas', 'tb_kelas_ajaran.id_kelas', 'tb_kelas.id_kelas')->orderby('tb_kelas.nama_kelas', 'asc')->all();
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        // header('Content-Type: application/json');
        // echo json_encode($data['kelas_ajaran'], JSON_PRETTY_PRINT);
        return view(['templates/header', 'templates/sidebar', 'kelas/bagi/index', 'templates/footer'], $data);
    }

    public function tambah()
    {
        $data['title'] = "Pembagian Kelas";
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        $data['kelas'] = ModelsKelas::where('status', '1')->all();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);
        return view([
            'templates/header',
            'templates/sidebar',
            'kelas/bagi/tambah',
            'templates/footer'
        ], $data);
    }
    public function insert(Request $request)
    {
        if ($request->nama_kelas == 'null') {
            Flasher::setFlash('Harap pilih salah satu kelas', 'danger');
            header('location: ' . base_url . 'kelas/bagi/tambah');
            exit();
        }
        // echo json_encode($request->all());
        // ModelsKelasAjaran::insert([
        //     'id_kelas_ajaran' => '',
        //     'id_kelas' => $request->nama_kelas,
        //     'id_tahun_ajaran' => $request->id,
        //     'status' => '1'
        // ])->save();
        Flasher::setFlash('Berhasil Ditambahkan', 'success');
        header('location: ' . base_url . 'kelas/bagi/tambah');
        exit();
    }

    public function delete(Request $request)
    {
        ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->delete()->save();
        Flasher::setFlash('Berhasil Dihapus!', 'success');
        header('location: ' . base_url . 'kelas/bagi');
        exit();
    }
    public function check()
    {
        $data['tahun_ajar'] = ModelsTahunAjaran::where('isActive', '1')->first();
        // $data['kelas_ajaran'] = ModelsKelasAjaran::where('id_tahun_ajaran', '=', $data['tahun_ajar']->id_tahun_ajaran)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->all();
        $data['kelas_ajaran'] = ModelsKelasAjaran::where('status', '1')->all();
        header('Content-Type: application/json');
        // echo json_encode($data['tahun_ajar'], JSON_PRETTY_PRINT);
        echo json_encode($data['kelas_ajaran'], JSON_PRETTY_PRINT);
    }

    public function detail(Request $request)
    {
        $check = ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->first();
        if (!$check) {
            header('Location: ' . base_url . 'kelas/bagi');
            exit();
        }
        $data['admin'] = User::where('id_admin', Session::get('user'))->first();

        // $checkstatus = ModelsKelasAjaran::where('status', '1')->first();
        // if (!$checkstatus) {
        //     header('Location: ' . base_url . 'kelas/bagi');
        //     exit();
        // }
        $data['kelas'] = ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->first();
        $data['siswa'] = ModelsSiswa::where('id_kelas_ajaran', $request->id)->all();
        $data['title'] = "Pembagian Kelas";
        $data['id_kelas'] = $request->id;
        return view([
            'templates/header',
            'templates/sidebar',
            'kelas/bagi/detail',
            'templates/footer'
        ], $data);
    }

    public function tambah_siswa(Request $request, $id)
    {
        $check = ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->first();
        if (!$check) {
            header('Location: ' . base_url . 'kelas/bagi');
            exit();
        }
        try {
            $data['title'] = 'Pembagian Kelas';
            $data['jumlah_data'] = ModelsSiswa::where('status', '1')
                ->count();
            $data['data_siswa'] = ModelsSiswa::where('status', '1')
                ->orderby('nama_siswa', 'asc')->paginate($request->page);
            $data['kelas'] = ModelsKelasAjaran::where('id_kelas_ajaran', $id)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->first();
            $data['admin'] = User::where('id_admin', Session::get('user'))->first();
            $data['halaman_aktif'] = $request->page;
            $data['jumlah_halaman'] = ceil($data['jumlah_data'] / 10);
            $data['halaman_akhir'] = $data['jumlah_halaman'];
            return view(['templates/header', 'templates/sidebar', 'kelas/bagi/tambah/index', 'templates/footer'], $data);
        } catch (\Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }
        // $data['admin'] = User::where('id_admin', Session::get('user'))->first();
        // $data['data_siswa'] = ModelsSiswa::where('status', 1)
        //     ->orderby('tb_siswa.nama_siswa', 'asc')
        //     ->all();
        // header('Content-Type: application/json');
        // echo json_encode($data['kelas'], JSON_PRETTY_PRINT);
        // return $this->respond('kelas/bagi/tambah/index', $data);
    }
    public function aksiCariSiswa(Request $request)
    {
        if ($request->keyword == "") {
            Flasher::setFlash('Masukkan keyword pencarian', 'danger');
            header('Location: ' . base_url . 'kelas/bagi/' . $request->id . '/tambah/page/1');
            exit();
        }
        header('Location: ' . base_url . 'kelas/bagi/' . $request->id . '/tambah/cari/' . trim($request->keyword) . '/page/1');
        exit();
    }
    public function cariTambahSiswa(Request $request, $id)
    {
        $check = ModelsKelasAjaran::where('id_kelas_ajaran', $request->id)->first();
        if (!$check) {
            header('Location: ' . base_url . 'kelas/bagi');
            exit();
        }
        try {
            $data['keyword'] = $request->keyword;
            $data['title'] = 'Pembagian Kelas';
            $data['jumlah_data'] = ModelsSiswa::where('status', '1')
                ->where('nama_siswa', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('nis', 'LIKE', '%' . $request->keyword . '%')
                ->count();
            $data['data_siswa'] = ModelsSiswa::where('status', '1')
                ->where('nama_siswa', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('nis', 'LIKE', '%' . $request->keyword . '%')
                ->orderby('nama_siswa', 'asc')->paginate($request->page);
            $data['kelas'] = ModelsKelasAjaran::where('id_kelas_ajaran', $id)->join('tb_kelas', 'tb_kelas.id_kelas', 'tb_kelas_ajaran.id_kelas')->first();
            $data['admin'] = User::where('id_admin', Session::get('user'))->first();
            $data['halaman_aktif'] = $request->page;
            $data['jumlah_halaman'] = ceil($data['jumlah_data'] / 10);
            $data['halaman_akhir'] = $data['jumlah_halaman'];
            return view(['templates/header', 'templates/sidebar', 'kelas/bagi/tambah/cari', 'templates/footer'], $data);
        } catch (\Throwable $th) {
            throw new \riyu\Helpers\Errors\AppException($th->getMessage(), $th->getCode(), $th->getPrevious());
        }
    }
    public function insert_siswa(Request $request, $id)
    {
        $update = ModelsSiswa::update([
            'id_kelas_ajaran' => $id
        ])->where('nis', $request->nis_siswa)->save();
        Flasher::setFlash('Berhasil Ditambahkan', 'success');
        header('location: ' . base_url . 'kelas/bagi/' . $id);
        exit();
    }
}