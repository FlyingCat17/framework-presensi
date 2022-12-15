<?php

use App\Config\Controller;
use App\Config\Session;
use App\Controllers\Guru;
use App\Controllers\HomeController;
use App\Controllers\Kelas;
use App\Controllers\KelasAjaran;
use App\Controllers\Tahun_Ajaran;
use App\Controllers\Login;
use App\Controllers\Admin;
use App\Controllers\Siswa;
use App\Controllers\MapelController;
use Riyu\Http\Request;
use Riyu\Router\Route;



Route::get('/', function () {
    return view('landing/index');
});

Route::get('/auth/logout', [Login::class, 'logout']);

Route::get('/auth/login', [Login::class, 'index']);
Route::post('/auth/login', [Login::class, 'auth']);
Route::get('/register', [Login::class, 'register']);
Route::post('/register', [Login::class, 'authRegister']);

Route::get('/dashboard', [Admin::class, 'index']);
Route::get('/dashboard/guru', [Guru::class, 'index']);
// tahun ajaran
Route::get('/tahun_ajaran', [Tahun_Ajaran::class, 'index']);
// // Route::get('/tahun_ajaran', function () {
// //     echo 'okew';
// // });
Route::post('/tahun_ajaran', [Tahun_Ajaran::class, 'delete']);
Route::get('/tahun_ajaran/tambah', [Tahun_Ajaran::class, 'tambah']);
Route::post('/tahun_ajaran/tambah', [Tahun_Ajaran::class, 'insert']);
Route::get('/tahun_ajaran/ubah', function () {
    header('Location: ' . base_url . 'tahun_ajaran');
    exit();
});
Route::get('/tahun_ajaran/hapus', function () {
    header('Location: ' . base_url . 'tahun_ajaran');
    exit();
});
Route::get('/tahun_ajaran/ubah/{id}', [Tahun_Ajaran::class, 'ubah']);
Route::post('/tahun_ajaran/ubah/{id}', [Tahun_Ajaran::class, 'update']);
Route::post('/tahun_ajaran/hapus/{id}', [Tahun_Ajaran::class, 'delete']);
Route::post('/tahun_ajaran/setActive', [Tahun_Ajaran::class, 'setActive']);



Route::get('/profile', [HomeController::class, 'profile']);
//siswa
Route::group('/siswa', function () {
    Route::get('', [Siswa::class, 'index']);
    Route::get('/tambah', [Siswa::class, 'tambah']);
    Route::post('/tambah', [Siswa::class, 'insert']);
    Route::get(
        '/ubah',
        function () {
            header('Location: ' . base_url . 'siswa');
            exit();
        }
    );
    Route::get('/ubah/{nis}', [Siswa::class, 'ubah']);
    Route::post('/ubah/{nis}', [Siswa::class, 'update']);
    Route::post('/hapus/{nis}', [Siswa::class, 'delete']);
});

Route::group('/kelas', function () {
    Route::get('', [Kelas::class, 'index']);
    Route::get('/tambah', [Kelas::class, 'tambah']);
    Route::post('/tambah', [Kelas::class, 'insert']);
    Route::get(
        '/ubah',
        function () {
            header('Location: ' . base_url . 'kelas');
            exit();
        }
    );
    Route::get('/ubah/{id}', [Kelas::class, 'ubah']);
    Route::post('/ubah/{id}', [Kelas::class, 'update']);
    Route::get(
        '/hapus',
        function () {
            header('Location: ' . base_url . 'kelas');
            exit();
        }
    );
    Route::get(
        '/hapus/{id}',
        function () {
            header('Location: ' . base_url . 'kelas');
            exit();
        }
    );
    Route::post('/hapus/{id}', [Kelas::class, 'delete']);
    Route::get('/bagi', [KelasAjaran::class, 'index']);
    Route::get('/bagi/tambah', [KelasAjaran::class, 'tambah']);
    Route::post('/bagi/tambah/{id}', [KelasAjaran::class, 'insert']);
    Route::post('/bagi/hapus/{id}', [KelasAjaran::class, 'delete']);
    // Route::get('/bagi/check', [KelasAjaran::class, 'check']);
    Route::get(
        '/bagi/detail',
        function () {
            header('location: ' . base_url . 'kelas/bagi');
            exit();
        }
    );
    Route::get('/bagi/detail/{id}', [KelasAjaran::class, 'detail']);

});

Route::group('/guru', function () {
    Route::get('', [Guru::class, 'index']);
    Route::get('/tambah', [Guru::class, 'tambah']);
    Route::post('/tambah', [Guru::class, 'insert']);
    Route::get(
        '/ubah',
        function () {
            header('Location: ' . base_url . 'guru');
            exit();
        }
    );
    Route::get('/ubah/{nuptk}', [Guru::class, 'ubah']);
    Route::post('/ubah/{nuptk}', [Guru::class, 'update']);
    Route::post('/hapus/{nuptk}', [Guru::class, 'delete']);
});
// Route::post('/login', [Login::class, 'auth']);
// Route::get('/login', [Login::class, 'index']);
// Route::post('/logout', [Login::class, 'logout']);
// Route::get('/register', [Login::class, 'register']);
// Route::post('/register', [Login::class, 'authRegister']);
// Route::get('/me', [HomeController::class, 'profile']);
// Route::get('/form', [HomeController::class, 'form']);
// Route::post('/insert', [HomeController::class, 'save']);
// Route::put('/update', [HomeController::class, 'save']);
// Route::get('/test/{test}', [HomeController::class, 'save']);
// Route::get('/id/{id}', [HomeController::class, 'id']);
// // Route::put('/akun/{id}', [HomeController::class, 'save']);
// // Route::get('/akun/{id}', [HomeController::class, 'save']);
// // Route::post('/akun/{id}', [HomeController::class, 'save']);
// Route::get('/akun/{id}', function ($id) {
//     return view(['templates/header', 'home'], [
//         'title' => 'Home',
//         'id' => $id
//     ]);
// });
// // Route::delete('/akun/{id}', [HomeController::class, 'save']);
// Route::get('/post/{url}/where/{id}/k/{1}', function ($data) {
//     $data = json_decode(json_encode($data));
//     return view('home', [
//         'title' => 'Home',
//         'data' => $data
//     ]);
// });
// Route::group('admin', function () {
//     Route::get('/dashboard', function () {
//         echo "Dashboard";
//     });
//     Route::get('/profile', [HomeController::class, 'profile']);
// });
Route::group('/mapel', function () {
    Route::get('/', [MapelController::class, 'index']);
    Route::get('/tambah', [MapelController::class, 'tambah']);
    Route::post('/tambah', [MapelController::class, 'insert']);
    Route::get(
        '/ubah',
        function () {
            header('Location: ' . base_url . 'mapel');
            exit();
        }
    );
    Route::get('/ubah/{id}', [MapelController::class, 'ubah']);
    Route::post('/ubah/{id}', [MapelController::class, 'update']);
    Route::post('/hapus/{id}', [MapelController::class, 'delete']);
});